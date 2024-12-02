<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateTable extends Command
{
    protected $signature = 'table:truncate {table}';

    protected $description = 'Truncate the specified table';

    public function handle(): void
    {
        $table = $this->argument('table');

        if ($this->confirm("Do you really wish to truncate table '$table'?")) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table($table)->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            $this->info("Table '$table' has been truncated.");
        } else {
            $this->info("Operation cancelled.");
        }
    }
}
