<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot('count','sale_price','discount');
    }

    protected $fillable = ['date_time', 'tax', 'voucher_number', 'total', 'voucher_id', 'supplier_id'];
}
