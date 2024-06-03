<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'subscriber_email',
        'subscriber_first_name',
        'subscriber_last_name',
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
        'rejected_at',
        'rendering_failure_at',
        'delivery_delay_at',
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
        'rejected_at' => 'datetime',
        'rendering_failure_at' => 'datetime',
        'delivery_delay_at' => 'datetime',
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

    public function defaultEmail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->subscriber->email ?? $this->subscriber_email,
        );
    }

    public function defaultFirstName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->subscriber->first_name ?? $this->subscriber_first_name,
        );
    }

    public function defaultLastName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->subscriber->last_name ?? $this->subscriber_last_name,
        );
    }
}
