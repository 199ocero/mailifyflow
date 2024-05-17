<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id', 'email', 'first_name', 'last_name', 'unsubscribe_at', 'unsubscribe_event_type_id',
    ];

    protected $casts = [

    ];

    public function unsubscribeEventType(): BelongsTo
    {
        return $this->belongsTo(UnsubscribeEventType::class, 'unsubscribe_event_type_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function emailLists(): BelongsToMany
    {
        return $this->belongsToMany(EmailList::class, 'email_list_subscribers', 'subscriber_id', 'email_list_id');
    }

}
