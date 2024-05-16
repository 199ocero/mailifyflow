<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'slug', 'timezone', 'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function campaigns(): BelongsToMany
    {
        return $this->belongsToMany(Campaign::class);
    }

    public function emailServices(): BelongsToMany
    {
        return $this->belongsToMany(EmailService::class);
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function subscriberTags(): BelongsToMany
    {
        return $this->belongsToMany(SubscriberTag::class);
    }

    public function templates(): BelongsToMany
    {
        return $this->belongsToMany(Template::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function campaignEmails(): BelongsToMany
    {
        return $this->belongsToMany(CampaignEmail::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
