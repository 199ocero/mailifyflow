<?php

namespace App\Enum;

enum CampaignLogStatusType: string
{
    case BOUNCE = 'bounce';
    case COMPLAINT = 'complaint';
    case SENT = 'sent';
    case DELIVERED = 'delivered';
    case REJECTED = 'rejected';
    case FAILED = 'failed';
}
