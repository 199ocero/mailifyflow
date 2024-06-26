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

class SendJob implements ShouldQueue
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

        $campaignLog = CampaignEmail::query()
            ->with('subscriber')
            ->where('campaign_id', $campaignId)
            ->where('subscriber_id', $subscriberId)
            ->first();

        if ($campaignLog) {
            if (! in_array($campaignLog->status, [
                CampaignLogStatusType::BOUNCE->value,
                CampaignLogStatusType::COMPLAINT->value,
                CampaignLogStatusType::DELIVERED->value,
                CampaignLogStatusType::REJECTED->value,
                CampaignLogStatusType::FAILED->value,
                CampaignLogStatusType::RENDERING_FAILURE->value,
                CampaignLogStatusType::DELIVERY_DELAY->value,
            ])) {
                $campaignLog->status = CampaignLogStatusType::SENT->value;
                $campaignLog->sent_at = Carbon::parse($message['mail']['timestamp']);
                $campaignLog->save();
            }
        }
    }
}
