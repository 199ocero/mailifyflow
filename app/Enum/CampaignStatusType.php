<?php

namespace App\Enum;

enum CampaignStatusType: string
{
    case DRAFT = 'draft';
    case QUEUED = 'queued';
    case SENDING = 'sending';
    case SENT = 'sent';
    case CANCELLED = 'cancelled';
    case FAILED = 'failed';
    case SENT_WITH_FAILURE = 'sent_with_failure';
}
