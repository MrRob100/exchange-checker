<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Services\KrakenService;
use App\Services\LiquidService;
use App\Services\BilaxyService;

class listingsController extends Controller
{
    public function index() {

        $events = json_decode(file_get_contents('../public/data/listings.json'), true);

        $e_string = json_encode($events); 

        // dd($e_string);

        return view('listings', compact('e_string'));
    }

    public function kraken() {
        $kraken = App::make('App\Services\KrakenService');
        $coins = $kraken->getCoins();
        dump($coins);
        die();
    }

    public function liquid() {
        $liquid = App::make('App\Services\LiquidService');
        $coins = $liquid->getCoins();
        dump($coins);
        die();
    }

    public function bilaxy() {
        $bilaxy = App::make('App\Services\BilaxyService');
        $coins = $bilaxy->getCoins();
        dump($coins);
        die();
    }
}
