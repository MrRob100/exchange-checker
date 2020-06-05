<?php

// declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;

/**
 * Class CheckService
 * @package App\Services
 */
class CheckService
{
    /**
     * @param array $coins - all coins listed on exchange 
     *
     * @return o
     */
    public function check($exchange, $coins)
    {
      $before = json_decode(file_get_contents('public/data/'.$exchange.'Listings.json'));
      file_put_contents('public/data/'.$exchange.'Listings.json', json_encode($coins));
      $after = json_decode(file_get_contents('public/data/'.$exchange.'Listings.json'));

      if ($before === $after) {

        dump($exchange." SAME, TAKE NO ACTION");

      } else {
        dump($exchange." NOT SAME GET ARRAY_DIFF");
        $diff = array_diff($after, $before);
        // $diff = array_diff($previous, $after);

        dump("buy \/");
        // dump($diff);
        //create file that details the price

        $this->logNew($exchange, $diff);

      }
    }

    public function logNew($exchange, $diff)
    {

      $path = 'public/data/';

      //handle diff might be []
      foreach ($diff as $new_coin) {
        // touch($path.$new_coin."-".$exchange.".json");
      }
    }

}