<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'email',
        'first_name',
        'last_name',
        'status',
        'unsubscribe_at',
    ];

    protected $casts = [
        'unsubscribe_at' => 'datetime',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * We have allowed a duplicate email address for a subscriber
     * so each subscriber belongs to one email list
     */
    public function emailList(): BelongsTo
    {
        return $this->belongsTo(EmailList::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function campaignEmails(): HasMany
    {
        return $this->hasMany(CampaignEmail::class);
    }
}
