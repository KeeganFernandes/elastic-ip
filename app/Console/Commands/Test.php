<?php

namespace App\Console\Commands;

use App\Models\AccessConcentrator;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 't';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $access_concentrator = AccessConcentrator::first();

        dd($access_concentrator->getNextAvailableIp());

        return Command::SUCCESS;
    }
}
