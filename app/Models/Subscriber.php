<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->belongsTo(UnsubscribeEvent::class, 'unsubscribeeventtype_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
