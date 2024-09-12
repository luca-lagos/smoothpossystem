<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }
}
