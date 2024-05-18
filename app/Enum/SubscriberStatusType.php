<?php

namespace App\Enum;

enum SubscriberStatusType: string
{
    case SUBSCRIBED = 'subscribed';
    case UNSUBSCRIBED = 'unsubscribed';
}
