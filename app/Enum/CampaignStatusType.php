<?php

namespace App\Enum;

enum CampaignStatusType: string
{
    case DRAFT = 'draft';
    case QUEUED = 'queued';
    case SENDING = 'sending';
    case SENT = 'sent';
    case CANCELLED = 'cancelled';
}
