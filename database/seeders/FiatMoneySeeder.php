<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FiatMoney;

class FiatMoneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $fiat_moneys = new Fiatmoney();
      $fiat_moneys->amount = 1500;
      $fiat_moneys->user_id = 1;
      $fiat_moneys->save();

      $fiat_moneys = new Fiatmoney();
      $fiat_moneys->amount = 1500;
      $fiat_moneys->user_id = 2;
      $fiat_moneys->save();

    }
}
