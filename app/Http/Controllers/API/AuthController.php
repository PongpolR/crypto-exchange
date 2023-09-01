<?php

namespace App\Http\Controllers\API;

use Firebase\JWT\JWT;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
// use Validator;
use App\Models\User;
use App\Models\FiatMoney;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'confirm_password' => 'required|same:password',
      ]);

      if ($validator->fails()) {
        $response = [
          'success' => false,
          'message' => $validator->errors()
        ];
        return response()->json($response, 400);
      }

      $input = $request->all();
      $input['password'] = bcrypt($input['password']);
      $user = User::create($input);

      // $success['token'] = $user->createToken('MyApp')->plainTextToken;
      $success['name'] = $user->name;

      $response = [
        'success' => true,
        'data' => $success,
        'message' => 'User register successfully'
      ];

      $new_fiat_money = new FiatMoney();
      $new_fiat_money->user_id = $user->id;
      $new_fiat_money->save();

      return response()->json($response, 200);

    }

    public function login(Request $request) {
      // if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
      //   $user = Auth::user();
      //   $success['token'] = $user->createToken('MyApp')->plainTextToken;
      //   $success['name'] = $user->name;

      //   $response = [
      //     'success' => true,
      //     'data' => $success,
      //     'message' => 'User login successfully'
      //   ];
      // return response()->json($response, 200);

      // } else {
      //   $response = [
      //     'success' => false,
      //     'message' => 'Unauthorized'
      //   ];
      //   return response()->json($response);
      // }
      $credentials = $request->only(['email', 'password']);
      $token = auth()->attempt($credentials);
      return $token;
      
    }
}
