<?php

namespace App\Console\Commands;

use App\Http\Controllers\SoldListingsController;
use Illuminate\Console\Command;

class SoldPropertyListing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:soldImport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $new = new SoldListingsController();
        $new->importListing();
        return 0;
    }
}
