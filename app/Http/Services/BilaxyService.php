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


      $in = ['a', 'b'];

      $ne = ['a', 'b', 'c'];

      $de = array_diff($in, $ne);

      // dd($de);



      $coins = $this->getCoins();

      $previous = json_decode(file_get_contents('public/data/BilaxyListings.json'));

      file_put_contents('public/data/BilaxyListings.json', json_encode($coins));

      $after = json_decode(file_get_contents('public/data/BilaxyListings.json'));

      dump('before \/');

      dump($previous);

      dump('after \/');

      
      dump($after);

      if ($previous === $after) {
        dump("SAME!");
      } else {
        dump("NOT SAME GET ARRAY_DIFF");
        $diff = array_diff($after, $previous);
        // $diff = array_diff($previous, $after);
        dump($diff);
      }

      dump('b checked');


    }

}