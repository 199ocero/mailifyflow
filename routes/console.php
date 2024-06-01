<?php

use Illuminate\Database\Console\PruneCommand;
use Illuminate\Support\Facades\Schedule;
use Spatie\WebhookClient\Models\WebhookCall;

// added command to prune webhook_calls
Schedule::command(PruneCommand::class, [
    '--model' => [WebhookCall::class],
])
    ->onOneServer()
    ->daily()
    ->description('Prune webhook_calls.');

// added command to prune batches
Schedule::command('queue:prune-batches')->daily();
Schedule::command('queue:prune-batches --hours=48 --unfinished=72')->daily();
Schedule::command('queue:prune-batches --hours=48 --cancelled=72')->daily();

// added command to prune failed jobs
Schedule::command('queue:flush')->daily();

// added command to clear imports
Schedule::command('clear:imports')->daily();
