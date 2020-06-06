<?php

// declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;
use App\Services\CheckService;


/**
 * Class BilaxyService
 * @package App\Services
 */
class BilaxyService
{
    public $exchange = "Bilaxy";

    /**
     * @param array $a
     *
     * @return o
     */
    public function getCoins()
    {
      $coinsRaw = json_decode(file_get_contents('https://newapi.bilaxy.com/v1/currencies'), true);
      $coins = array_keys($coinsRaw);
      return $coins;
    }

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
            dump('within timeframe '.$data['coin'].' '.$this->exchange);
            //get price
            $price = $hitbtc->price($data['coin']);

            //add it to file
            $data['price_data'][$timeafter] = $price;

            dump('about to put \/');
            dump($data);

            file_put_contents($dir.$file, json_encode($data));
          } else {
            dump('too late '.$data['coin'].' '.$this->exchange);
          }
        }
      
      }

    }

    public function getPrice($coin) {

      return $price;
    }

}