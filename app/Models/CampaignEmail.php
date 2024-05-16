<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id', 'subscriber_id', 'subject', 'from_name', 'from_email', 'open_count', 'click_count', 'queued_at', 'sent_at', 'delivered_at', 'bounced_at', 'unsubscribed_at', 'complained_at', 'opened_at', 'clicked_at',
    ];

    protected $casts = [

    ];

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class, 'subscriber_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
