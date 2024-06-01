<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearImports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:imports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will clear all imports records from the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('imports')->delete();
        DB::table('failed_import_rows')->delete();

        $this->info('All imports and failed rows have been cleared.');
    }
}
