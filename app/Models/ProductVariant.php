<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'color_id', 'size_id', 'image', 'price', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function color()
    {
        return $this->belongsTo(Colors::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }


    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Orders::class);
    }
}
