<?php

// declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;

/**
 * Class KrakenService
 * @package App\Services
 */
class LiquidService
{
    /**
     * @param array $a
     *
     * @return o
     */
    public function getCoins()
    {
      $coins = [];
      $coinsRaw = json_decode(file_get_contents('https://api.liquid.com/products'), true);

      foreach ($coinsRaw as $row) {
        array_push($coins, $row['currency_pair_code']);
      }

      return $coins;
    }

    public function check() 
    {
      dump('l checked');
    }

}