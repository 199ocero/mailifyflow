<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'subject',
        'preheader',
        'from_name',
        'from_email',
        'template_id',
        'email_provider_id',
        'email_list_id',
        'campaign_content',
        'converted_content',
    ];

    protected $casts = [
        'campaign_content' => 'array',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function emailProvider(): BelongsTo
    {
        return $this->belongsTo(EmailProvider::class);
    }

    public function emailList(): BelongsTo
    {
        return $this->belongsTo(EmailList::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'campaign_tag');
    }
}
