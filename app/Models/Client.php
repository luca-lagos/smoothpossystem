<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function people(){
        return $this->belongsTo(People::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }

    protected $fillable = ['people_id'];
}
