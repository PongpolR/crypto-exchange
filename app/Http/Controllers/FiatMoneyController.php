<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FiatMoney;
use Illuminate\Support\Facades\Validator;

class FiatMoneyController extends Controller
{
  public function topUpFiatMoney(Request $request, $id) {
    $validator = Validator::make($request->all(), [
      'amount' => 'required',
    ]);

    if ($validator->fails()) {
        $errors = $validator->errors();

        return [
            "status" => "error",
            "error" => $errors,
        ];

    } else {
      $fiat_money = FiatMoney::find($id);
      $topup_money = $request->amount;
      $fiat_money->amount =  $fiat_money->amount + $topup_money;
      $fiat_money->save();

      $response = [
        'success' => true,
        'message' => "Topup successfully ({$topup_money} baht.) user have balance: {$fiat_money->amount} baht."
      ];

      return $response;
    }

  }

    // public function getAllUserWithFiatMoney() {
    //   $userWithFiatMoneys = FiatMoney::join('users', 'users.id', '=', 'fiat_moneys.id')
    //            ->get(['users.id', 'users.name', 'fiat_moneys.amount']);

    //   return $userWithFiatMoneys;
    // }
}
