<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiatMoney extends Model
{
    use HasFactory;

    protected $table = 'fiat_moneys';

    protected $fillable = [
      'amount'
    ];

    public function users(){
      return $this->belongsTo(User::class);
    }
}
