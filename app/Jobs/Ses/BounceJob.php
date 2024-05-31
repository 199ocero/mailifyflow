<?php

namespace App\Jobs\Ses;

use App\Enum\CampaignLogStatusType;
use App\Enum\SubscriberStatusType;
use App\Enum\UnsubscribeEventType;
use App\Models\CampaignEmail;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Models\WebhookCall;

use function Symfony\Component\Clock\now;

class BounceJob implements ShouldQueue
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

        if (Arr::get($message, 'bounce.bounceType') !== 'Permanent') return;

        $campaignId = null;
        $subscriberId = null;

        foreach ($message["mail"]["headers"] as $header) {
            if ($header["name"] === "Campaign-Id") {
                $campaignId = $header["value"];
                break;
            }
        }

        foreach ($message["mail"]["headers"] as $header) {
            if ($header["name"] === "Subscriber-Id") {
                $subscriberId = $header["value"];
                break;
            }
        }

        foreach ($message['bounce']['bouncedRecipients'] as $recipient) {
            $campaignLog = CampaignEmail::query()
                ->with('subscriber')
                ->where('campaign_id', $campaignId)
                ->where('subscriber_id', $subscriberId)
                ->first();

            if ($campaignLog) {
                $campaignLog->status = CampaignLogStatusType::BOUNCE->value;
                $campaignLog->reason_failed = $recipient['diagnosticCode'];
                $campaignLog->bounced_at = Carbon::parse($message['bounce']['timestamp']);
                $campaignLog->unsubscribed_at = now();
                $campaignLog->save();

                $subscriber = $campaignLog->subscriber;
                $subscriber->status = SubscriberStatusType::UNSUBSCRIBED->value;
                $subscriber->unsubscribe_type = UnsubscribeEventType::BOUNCE->value;
                $subscriber->unsubscribe_at = now();
                $subscriber->save();
            }
        }
    }
}
