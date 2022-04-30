<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    public const STATUS_CREATED = 'created';

    public const STATUS_READY = 'ready';

    public const STATUS_COMPLETED = 'completed';

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class, 'seller_id');
    }
}
