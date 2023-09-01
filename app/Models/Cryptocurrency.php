<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cryptocurrency extends Model
{
    use HasFactory;

    public function users() {
      return $this->belongsToMany(User::class);
    }

    public function transactions() {
      return $this->hasMany(Transaction::class);
    }

}
