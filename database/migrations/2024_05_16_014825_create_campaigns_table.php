<?php

use App\Enum\CampaignStatusType;
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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('job_id')->nullable()->default(null);
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->string('name');
            $table->string('subject');
            $table->string('preheader');
            $table->string('from_name');
            $table->string('from_email');
            $table->foreignId('template_id')->constrained('templates')->onDelete('cascade');
            $table->foreignId('email_provider_id')->constrained('email_providers')->onDelete('cascade');
            $table->foreignId('email_list_id')->constrained('email_lists')->onDelete('cascade');
            $table->longText('campaign_content');
            $table->longText('converted_content');
            $table->enum('status', [
                CampaignStatusType::DRAFT->value,
                CampaignStatusType::QUEUED->value,
                CampaignStatusType::SENDING->value,
                CampaignStatusType::SENT->value,
                CampaignStatusType::CANCELLED->value,
                CampaignStatusType::FAILED->value,
                CampaignStatusType::SENT_WITH_FAILURE->value,
            ])->default(CampaignStatusType::DRAFT->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
