<?php

namespace App\Enum;

enum CampaignLogStatusType: string
{
    case BOUNCE = 'bounce';
    case COMPLAINT = 'complaint';
    case SENDING = 'sending';
    case SENT = 'sent';
    case DELIVERED = 'delivered';
    case REJECTED = 'rejected';
    case FAILED = 'failed';
    case RENDERING_FAILURE = 'rendering_failure';
    case DELIVERY_DELAY = 'delivery_delay';
}
