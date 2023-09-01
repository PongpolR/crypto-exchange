<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FiatMoneyController;
use App\Http\Controllers\CryptocurrencyController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function(){
  Route::post('login', 'login')->name('login');
  Route::post('register', 'register');
});

Route::middleware('auth:api')->get('/me', function () {
  $user = auth()->user();
  return $user;
});

Route::get(
  '/users',
  [UserController::class, 'getAllUsers']
);

Route::get(
  '/user/{id}',
  [UserController::class, 'getUser']
);

Route::get(
  '/users/amount',
  [UserController::class, 'getUserWithFiatMoney']
);

Route::get(
  '/users/crypto',
  [UserController::class, 'getUserWithCryptocurrencies']
);

Route::get(
  '/users/transactions',
  [UserController::class, 'getUserWithTransactions']
);

Route::put(
  '/fiat_money/topup/{id}',
  [FiatMoneyController::class, 'topUpFiatMoney']
);

Route::get(
  '/cryptocurrency',
  [CryptocurrencyController::class, 'getCryptocurrency']
);

Route::post(
  '/crypto/transfer/{id}',
  [CryptocurrencyController::class, 'transferCryptocurrency']
);


Route::middleware('auth:api')->post(
  '/crypto/buy/{id}',
   [CryptocurrencyController::class, 'buyCryptocurrency']
);

