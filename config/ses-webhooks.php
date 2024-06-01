<?php

declare(strict_types=1);

return [
    /*
     * You can define the job that should run when a certain webhook hits your application
     * here. See the examples below for key names.
     *
     * You can find a list of event types here:
     * https://docs.aws.amazon.com/ses/latest/dg/event-publishing-retrieving-sns-examples.html
     */
    'jobs' => [
        'bounce' => \App\Jobs\Ses\BounceJob::class,
        'complaint' => \App\Jobs\Ses\ComplaintJob::class,
        'delivery' => \App\Jobs\Ses\DeliveryJob::class,
        'send' => \App\Jobs\Ses\SendJob::class,
        'reject' => \App\Jobs\Ses\RejectJob::class,
        'rendering_failure' => \App\Jobs\Ses\RenderingFailureJob::class,
        'delivery_delay' => \App\Jobs\Ses\DeliveryDelayJob::class,
        'open' => \App\Jobs\Ses\OpenJob::class,
        'click' => \App\Jobs\Ses\ClickJob::class,
    ],

    /*
    * The classname of the model to be used. The class should equal or extend
    * \Ankurk91\SesWebhooks\Model\SesWebhookCall.
    */
    'model' => \Ankurk91\SesWebhooks\Model\SesWebhookCall::class,

    /**
     * This class determines if the incoming webhook call should be stored and processed.
     */
    'profile' => \Ankurk91\SesWebhooks\SesWebhookProfile::class,

    /*
     * When disabled, the package will not verify if the signature is valid.
     * This can be handy in local environments and testing.
     */
    'verify_signature' => (bool) env('SES_SIGNATURE_VERIFY', true),

];
