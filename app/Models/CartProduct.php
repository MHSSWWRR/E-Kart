<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartProduct extends Model
{
    use HasFactory;
    protected $fillable = ['cart_id', 'variant_id', 'quantity'];

    function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
    function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
