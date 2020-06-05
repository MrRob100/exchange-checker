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

      } else {
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
          "added" => time(),
          "price_data" => [
            0 => "",
            1 => "",
            2 => "",
            3 => "",
            4 => "",
          ]
        ];

        file_put_contents($file_name, json_encode($data));

      }
    }

}