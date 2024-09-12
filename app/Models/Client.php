<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }
}
