<?php

// declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;

/**
 * Class BilaxyService
 * @package App\Services
 */
class BilaxyService
{
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

    // OUTSOURCE TO CHECKSERVICE AND PASS IN PARAMS
    public function check() 
    {

      $coins = $this->getCoins();

      $before = json_decode(file_get_contents('public/data/BilaxyListings.json'));

      file_put_contents('public/data/BilaxyListings.json', json_encode($coins));

      $after = json_decode(file_get_contents('public/data/BilaxyListings.json'));

      if ($before === $after) {
        dump("SAME, TAKE NO ACTION");

      } else {
        dump("NOT SAME GET ARRAY_DIFF");
        $diff = array_diff($after, $before);
        // $diff = array_diff($previous, $after);

        dump($diff);
        //create file that details the price

        $this->logData($diff);

      }

    }

    //takes array
    public function logData($diff) {
      dump('touch file');

      //handle diff might be []
      foreach ($diff as $new_coin) {
        touch($new_coin."-bilaxy.json");
      }
    }

}