<?php

use App\Enum\CampaignLogStatusType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaign_emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('campaign_id')->constrained('campaigns')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('subscriber_id')->constrained('subscribers')->onDelete('cascade');
            $table->enum('status', [
                CampaignLogStatusType::BOUNCE->value,
                CampaignLogStatusType::COMPLAINT->value,
                CampaignLogStatusType::SENT->value,
                CampaignLogStatusType::DELIVERED->value,
                CampaignLogStatusType::REJECTED->value,
                CampaignLogStatusType::FAILED->value
            ]);
            $table->longText('reason_failed')->nullable();
            $table->integer('open_count')->default('0');
            $table->integer('click_count')->default('0');
            $table->timestamp('queued_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('bounced_at')->nullable();
            $table->timestamp('unsubscribed_at')->nullable();
            $table->timestamp('complained_at')->nullable();
            $table->timestamp('opened_at')->nullable();
            $table->timestamp('clicked_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_emails');
    }
};
