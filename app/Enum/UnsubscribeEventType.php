<?php

namespace App\Enum;

enum UnsubscribeEventType: string
{
    case BOUNCE = 'bounce';
    case COMPLAINT = 'complaint';
    case MANUAL_BY_ADMIN = 'manual_by_admin';
    case MANUAL_BY_SUBSCRIBER = 'manual_by_subscriber';
}
