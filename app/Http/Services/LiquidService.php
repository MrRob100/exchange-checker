<?php

// declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;
use App\Services\CheckService;

/**
 * Class LiquidService
 * @package App\Services
 */
class LiquidService
{
    public $exchange = "Liquid"; 

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

      $check = App::make('App\Services\CheckService');

      $check->check($this->exchange, $this->getCoins());

    }

}