<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cryptocurrency;

class CryptocurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $crypto = new Cryptocurrency();
      $crypto->name = "Bitcoin";
      $crypto->symbol = "BTC";
      $crypto->price = 350.25;
      $crypto->user_id = 1;
      $crypto->save();

      $crypto = new Cryptocurrency();
      $crypto->name = "Ethereum";
      $crypto->symbol = "ETH";
      $crypto->price = 270.75;
      $crypto->user_id = 1;
      $crypto->save();

      $crypto = new Cryptocurrency();
      $crypto->name = "Ethereum";
      $crypto->symbol = "ETH";
      $crypto->price = 270.75;
      $crypto->user_id = 2;
      $crypto->save();
      
      $crypto = new Cryptocurrency();
      $crypto->name = "Ethereum";
      $crypto->symbol = "ETH";
      $crypto->price = 270.75;
      $crypto->user_id = 1;
      $crypto->save();
    }
}
