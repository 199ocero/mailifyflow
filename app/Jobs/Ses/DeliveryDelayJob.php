<?php

namespace App\Jobs\Ses;

use App\Enum\CampaignLogStatusType;
use App\Models\CampaignEmail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;

class DeliveryDelayJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public WebhookCall $webhookCall)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $message = $this->webhookCall->payload['Message'];

        $campaignId = null;
        $subscriberId = null;

        foreach ($message['mail']['headers'] as $header) {
            if ($header['name'] === 'Campaign-Id') {
                $campaignId = $header['value'];
                break;
            }
        }

        foreach ($message['mail']['headers'] as $header) {
            if ($header['name'] === 'Subscriber-Id') {
                $subscriberId = $header['value'];
                break;
            }
        }

        foreach ($message['deliveryDelay']['delayedRecipients'] as $recipient) {
            $campaignLog = CampaignEmail::query()
                ->with('subscriber')
                ->where('campaign_id', $campaignId)
                ->where('subscriber_id', $subscriberId)
                ->first();

            if ($campaignLog) {
                $campaignLog->status = CampaignLogStatusType::DELIVERY_DELAY->value;
                $campaignLog->delivery_delay_at = Carbon::parse($message['deliveryDelay']['timestamp']);
                $campaignLog->reason_failed = $recipient['diagnosticCode'];
                $campaignLog->save();
            }
        }
    }
}
