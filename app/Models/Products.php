<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'categories_id'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'categories_id');
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_products');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}
