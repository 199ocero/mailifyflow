<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailService extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id', 'name', 'email_service_type_id',
    ];

    protected $casts = [

    ];

    public function emailServiceType(): BelongsTo
    {
        return $this->belongsTo(EmailServiceType::class, 'email_service_type_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
