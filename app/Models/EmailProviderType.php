<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EmailProviderType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function emailProviders(): BelongsToMany
    {
        return $this->belongsToMany(EmailProvider::class);
    }
}
