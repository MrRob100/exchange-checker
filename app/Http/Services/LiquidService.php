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

    //put in common service
    public function check() 
    {

      $check = App::make('App\Services\CheckService');
      $hitbtc = App::make('App\Services\HitBtcService');

      $check->check($this->exchange, $this->getCoins());

      $dir = 'public/data/price/';
      $files = scandir($dir);
      foreach($files as $file) {

        if (strpos($file, $this->exchange) !== false) {
          $data = json_decode(file_get_contents($dir.$file), true);

          $timeafter = time() - $data['added'];

          if ($timeafter < 300) {
            //get price
            $price = $hitbtc->price($data['coin']);

            //add it to file
            $data['price_data'][$timeafter] = $price;

            file_put_contents($dir.$file, json_encode($data));
          } else {
            //
          }
        }
      
      }

    }

}