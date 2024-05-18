<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'config',
        'email_provider_type_id',
    ];

    protected $casts = [];

    public function emailProviderType(): BelongsTo
    {
        return $this->belongsTo(EmailProviderType::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
