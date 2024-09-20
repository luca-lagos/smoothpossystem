<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot('count', 'shop_price', 'sale_price');
    }

    protected $fillable = ['date_time', 'tax', 'voucher_number', 'total', 'voucher_id', 'supplier_id'];
}
