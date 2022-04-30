<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon',
        'amount',
        'description',
    ];

    public function cartItem(): BelongsTo
    {
        return $this->belongsTo(CartItem::class, 'cart_item_id');
    }
}
