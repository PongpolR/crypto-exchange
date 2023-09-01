<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function users(){
      return $this->belongsToMany(User::class);
    }

    public function cryptocurrencies(){
      return $this->belongsToMany(Cryptocurrency::class);
    }

}
