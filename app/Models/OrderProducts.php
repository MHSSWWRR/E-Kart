<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProducts extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'variant_id', 'quantity', 'price'];

    function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }
    function order(): BelongsTo
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}
