<?php

namespace App\Jobs;

use App\Enum\CampaignLogStatusType;
use Throwable;
use App\Models\Campaign;
use App\Mail\CampaignMail;
use App\Models\Subscriber;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use App\Enum\CampaignStatusType;
use App\Models\CampaignEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CampaignJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Campaign $campaign,
        public Subscriber $subscriber
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->batching() && $this->campaign->status === CampaignStatusType::QUEUED->value) {
            $this->campaign->status = CampaignStatusType::SENDING->value;
            $this->campaign->save();
        }

        $config = Crypt::decrypt($this->campaign->emailProvider->config);

        // Customize your SMTP settings here
        config([
            'mail.mailers.smtp.host' => $config['host'],
            'mail.mailers.smtp.port' => $config['port'],
            'mail.mailers.smtp.username' => $config['username'],
            'mail.mailers.smtp.password' => $config['password'],
            'mail.mailers.smtp.encryption' => $config['encryption'],
        ]);

        Mail::to($this->subscriber->email)->send(new CampaignMail($this->campaign, $this->subscriber));

        // Create campaign email record
        CampaignEmail::query()->create([
            'team_id' => $this->campaign->team_id,
            'campaign_id' => $this->campaign->id,
            'subscriber_id' => $this->subscriber->id,
            'status' => CampaignLogStatusType::SENT->value,
            'queued_at' => $this->campaign->created_at,
            'sent_at' => now(),
        ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(?Throwable $exception)
    {
        // Create campaign email record
        CampaignEmail::query()->create([
            'team_id' => $this->campaign->team_id,
            'campaign_id' => $this->campaign->id,
            'subscriber_id' => $this->subscriber->id,
            'status' => CampaignLogStatusType::FAILED->value,
            'reason_failed' => $exception->getMessage(),
            'queued_at' => $this->campaign->created_at,
            'sent_at' => now(),
        ]);
    }
}
