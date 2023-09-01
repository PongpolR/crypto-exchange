<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cryptocurrency;
use App\Models\Transaction;
use App\Models\FiatMoney;
use Illuminate\Support\Facades\Validator;
use Auth;


class CryptocurrencyController extends Controller
{
  public function getCryptocurrency() {
    $cryptocurrencys = Cryptocurrency::All();
    return $cryptocurrencys;
  }

  public function transferCryptocurrency(Request $request, $id) {
    $validator = Validator::make($request->all(), [
      'with_user_id' => 'required',
    ]);

    if ($validator->fails()) {
        $errors = $validator->errors();

        return [
            "status" => "error",
            "error" => $errors,
        ];

    } else {
      $crypto = Cryptocurrency::find($id);
      $old_user_id = $crypto->user_id;
      $crypto->user_id = $request->with_user_id;
      $crypto->save();

      $transaction = new Transaction();
      $transaction->user_id = $old_user_id;
      $transaction->cryptocurrency_id = $id;
      $transaction->with_user_id = $request->with_user_id;

      if ($transaction->user_id == $transaction->with_user_id) {
        return [
          "status" => "error",
          "error" => 'ไม่สามารถโอนเหรียญให้กับตัวเองได้',
        ];
      } else {
        $transaction->save();

        $response = [
          'success' => true,
          'message' => "Transfer crypto successfully"
        ];

        return $response;
      }

      
    }
  }

  public function buyCryptocurrency($id) {

    $crypto = Cryptocurrency::find($id);
    
    $user_login = auth()->user();
    $user_fiat_money = $user_login->fiat_money;

    $response = [
      'crypto' => $crypto,
      'user' => $user_fiat_money
    ];

    if ($crypto->user_id == $user_fiat_money->user_id) {
      return 'ไม่สามารถซื้อเหรียญของตัวเองได้';
    } else {

      $test = [
        'price' => $crypto->price,
        'amount' => $user_fiat_money->amount,
        'msg' => 'transaction complete'
      ];

      // หักเงินคนซื้อเหรียญ
      $fiat_money = FiatMoney::find($user_fiat_money->id);
      $fiat_money->amount = $user_fiat_money->amount - $crypto->price;
      $fiat_money->save();

      // เพิ่มเงินให้เจ้าของเหรียญ
      $fiat_money = FiatMoney::find($crypto->user_id);
      $fiat_money->amount = $user_fiat_money->amount + $crypto->price;
      $fiat_money->save();

      // อัพเดทเจ้าของเหรียญเป็นคนที่ซื้อล่าสุด
      $old_user_id = $crypto->user_id;
      $crypto->user_id = $user_fiat_money->id;
      $crypto->save();

      // บันทึก transaction
      $transaction = new Transaction();
      $transaction->user_id = $old_user_id;
      $transaction->cryptocurrency_id = $id;
      $transaction->with_user_id = $crypto->user_id;
      $transaction->save();

      return $test;
    }

    return $response;
  }

}
