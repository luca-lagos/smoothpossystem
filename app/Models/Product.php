<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    public function shops()
    {
        return $this->belongsToMany(Shop::class)->withTimestamps()->withPivot('count', 'shop_price', 'sale_price');
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class)->withTimestamps()->withPivot('count', 'sale_price', 'discount');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function presentation()
    {
        return $this->belongsTo(Presentation::class);
    }

    public function handleUploadImage($image)
    {
        $file = $image;
        $name = time() . $file->getClientOriginalName();
        /*$file->move(public_path('/img/products/', $name));*/
        Storage::putFileAs('/public/products/', $file, $name, 'public');
        return $name;
    }

    protected $fillable = ['code', 'name', 'price', 'count', 'description',  'expiration_date', 'image_path', 'brand_id', 'presentation_id'];
}
