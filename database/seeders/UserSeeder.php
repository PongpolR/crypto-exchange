<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $user = new User();
      $user->name = "tata";
      $user->email = "pongpol@rojana.com";
      $user->password = "1122";
      $user->save();

      $user = new User();
      $user->name = "user2";
      $user->email = "user2@rojana.com";
      $user->password = "1122";
      $user->save();
    }
}
