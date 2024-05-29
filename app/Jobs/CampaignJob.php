<?php

namespace App\Jobs;

use App\Models\Campaign;
use App\Mail\CampaignMail;
use App\Models\Subscriber;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
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
     * Create a new job instance.
     */
    public function __construct(public Campaign $campaign, public Subscriber $subscriber)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
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
    }
}
