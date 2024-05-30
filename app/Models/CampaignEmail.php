<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'campaign_id',
        'subscriber_id',
        'status',
        'reason_failed',
        'open_count',
        'click_count',
        'queued_at',
        'sent_at',
        'delivered_at',
        'bounced_at',
        'unsubscribed_at',
        'complained_at',
        'opened_at',
        'clicked_at',
    ];

    protected $casts = [
        'queued_at' => 'datetime',
        'sent_at' => 'datetime',
        'delivered_at' => 'datetime',
        'bounced_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
        'complained_at' => 'datetime',
        'opened_at' => 'datetime',
        'clicked_at' => 'datetime',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
