<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public function people()
    {
        return $this->belongsTo(People::class);
    }
    
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    protected $fillable = ['people_id'];
}
