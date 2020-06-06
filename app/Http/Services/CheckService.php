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
      $before = json_decode(file_get_contents('public/data/'.$exchange.'Listings.json'), true);
      file_put_contents('public/data/'.$exchange.'Listings.json', json_encode($coins));
      $after = json_decode(file_get_contents('public/data/'.$exchange.'Listings.json'), true);

      if ($before === $after) {

        dump($exchange.': before and after same');

      } else {

        dump($exchange.': before and after different');

        $diff = array_diff($after, $before);
        // $diff = array_diff($previous, $after);

        $this->logNew($exchange, $diff);

        return true;

      }

      return false;

    }

    public function logNew($exchange, $diff)
    {

      $path = 'public/data/price/';

      //handle diff might be []
      foreach ($diff as $new_coin) {

        $file_name = $path.$new_coin."-".$exchange.".json";

        touch($file_name);

        //put stamp 
        $data = [
          "coin" => $new_coin,
          "added" => time(),
          "price_data" => []
        ];

        file_put_contents($file_name, json_encode($data));

        $this->addToListings($exchange, $new_coin);

      }
    }

    public function addToListings($exchange, $coin) {
      $data = json_decode(file_get_contents('public/data/listings.json'), true);

      $alsoOn = [];

      $data[$coin."-".$exchange] = [
        "exchange" => $exchange,
        "symbol" => $coin,
        "timestamp" => time(),
        "alsoOn" => $alsoOn
      ];

      file_put_contents('public/data/listings.json', json_encode($data));

    }



}