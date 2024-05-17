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
        return $this->belongsToMany(Campaign::class, 'team_campaign');
    }

    public function emailProviders(): BelongsToMany
    {
        return $this->belongsToMany(EmailProvider::class, 'team_email_provider');
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class, 'team_subscriber');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'team_tag');
    }

    public function subscriberTags(): BelongsToMany
    {
        return $this->belongsToMany(SubscriberTag::class, 'team_subscriber_tag');
    }

    public function templates(): BelongsToMany
    {
        return $this->belongsToMany(Template::class, 'team_template');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_user');
    }

    public function campaignEmails(): BelongsToMany
    {
        return $this->belongsToMany(CampaignEmail::class, 'team_campaign_email');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function emailLists(): BelongsToMany
    {
        return $this->belongsToMany(EmailList::class, 'team_email_list');
    }
}
