<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    public function document(){
        return $this->belongsTo(Document::class);
    }

    public function supplier(){
        return $this->hasOne(Supplier::class);
    }

    public function client(){
        return $this->hasOne(Client::class);
    }

    protected $fillable = ['social_reason','location','person_type','document_id','document_number'];
}
