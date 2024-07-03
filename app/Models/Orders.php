<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'address', 'payment_method'];

    public function user()
    {
        return  $this->BelongsTo(User::class);
    }

    public function variants()
    {
        return $this->belongsToMany(ProductVariant::class);
    }
    public function products()
    {
        return $this->belongsToMany(Products::class, 'order_products')->withPivot('price');
    }
    public function orderProducts()
    {
        return $this->hasMany(OrderProducts::class, 'order_id');
    }
}
