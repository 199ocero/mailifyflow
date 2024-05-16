<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'subject',
        'from_name',
        'from_email',
        'template_id',
        'email_service_id',
        'content',
        'campaign_status_id',
    ];

    protected $casts = [];

    public function campaignStatus(): BelongsTo
    {
        return $this->belongsTo(CampaignStatus::class, 'campaign_status_id');
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function emailService(): BelongsTo
    {
        return $this->belongsTo(EmailService::class, 'email_service_id');
    }
}
