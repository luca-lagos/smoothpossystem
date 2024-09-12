<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
    
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}
