<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'current_price',
    ];

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function productGuarantee(): BelongsTo
    {
        return $this->belongsTo(ProductGuarantee::class, 'guarantee_id');
    }

    public function productManufacturer(): BelongsTo
    {
        return $this->belongsTo(ProductManufacturer::class, 'manufacturer_id');
    }
}
