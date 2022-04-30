<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductManufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'raiting',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'manufacturer_id');
    }
}
