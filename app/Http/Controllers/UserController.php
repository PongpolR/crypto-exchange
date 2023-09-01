<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cryptocurrency;
use App\Models\FiatMoney;

class UserController extends Controller
{
  public function getAllUsers() {
    $users = User::All();
    return $users;
  }

  public function getUser($id) {
        $user = User::find($id);
        return $user;
  }

  public function getUserWithFiatMoney() {
    $users = User::all();
    foreach($users as $user) {
      $user->fiat_money;
    }
    return $users;

  }

  public function getUserWithCryptocurrencies() {
    $users = User::all();
    foreach($users as $user) {
      $user->cryptocurrencies;
    }
    return $users;
  }

  public function getUserWithTransactions() {
    $users = User::all();

    foreach($users as $user) {
      $user->sendCrypto;
      $user->receiveCrypto;

      foreach($user->sendCrypto as $u) {
        $user_obj_name = User::find($u->user_id)->name;
        $to_user_obj_name = User::find($u->with_user_id)->name;
        $crypto_item = Cryptocurrency::find($u->id);

        $u['user'] = $user_obj_name;
        $u['to_user'] = $to_user_obj_name;
        $u['crypto_item'] = $crypto_item;
      }

      foreach($user->receiveCrypto as $u) {
        $user_obj_name = User::find($u->user_id)->name;
        $to_user_obj_name = User::find($u->with_user_id)->name;
        $crypto_item = Cryptocurrency::find($u->cryptocurrency_id);

        $u['user'] = $user_obj_name;
        $u['to_user'] = $to_user_obj_name;
        $u['crypto_item'] = $crypto_item;
      }

    }
    return $users;
  }

}
