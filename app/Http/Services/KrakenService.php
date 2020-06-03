<?php

// declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;

/**
 * Class KrakenService
 * @package App\Services
 */
class KrakenService
{
    /**
     * @param array $a
     *
     * @return o
     */
    public function getCoins()
    {
      $coinsRaw = json_decode(file_get_contents('https://api.kraken.com/0/public/Assets'), true);

      $coins = array_keys($coinsRaw['result']);

      

      return $coins;
    }

    public function check() 
    {
      dump('k checked');
    }

}