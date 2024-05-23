<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EmailList extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'description',
        'active',
        'default',
    ];

    protected $casts = [
        'active' => 'boolean',
        'default' => 'boolean',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class);
    }
}
