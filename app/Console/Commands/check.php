<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use App\Services\KrakenService;
use App\Services\LiquidService;
use App\Services\BilaxyService;

class check extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:ex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks exchanges for new coins';

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
     * @return mixed
     */
    public function handle()
    {
        //takes a while
        $kraken = App::make('App\Services\KrakenService');
        // $kraken->check();

        $liquid = App::make('App\Services\LiquidService');
        $liquid->check();

        $bilaxy = App::make('App\Services\BilaxyService');
        $bilaxy->check();
    }
}
