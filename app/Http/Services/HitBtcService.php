<?php

// declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;

/**
 * Class HitBtcService
 * @package App\Services
 */
class HitBtcService
{
    /**
     * @param array $coins - all coins listed on exchange 
     *
     * @return o
     */

     //find out what base currency to have (prob btc)
    public function price($coin)
    {
      $data = "";

      try {
        $data = json_decode(file_get_contents('https://api.hitbtc.com/api/2/public/ticker/'.strtoupper($coin).'BTC'), true);        
        return $data['last'];
      
      } catch(exception $e) {

        //log err
        return "";
      }

      return "";

    }

    public function buy($coin)
    {
      //
    }

}