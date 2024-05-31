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
        'email',
        'first_name',
        'last_name',
        'status',
        'unsubscribe_type',
        'unsubscribe_at',
    ];

    protected $casts = [
        'unsubscribe_at' => 'timestamp',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function campaignEmails(): HasMany
    {
        return $this->hasMany(CampaignEmail::class);
    }

    public function emailLists(): BelongsToMany
    {
        return $this->belongsToMany(EmailList::class, 'email_list_subscriber');
    }
}
