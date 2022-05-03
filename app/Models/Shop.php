<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'open_hour',
        'close_hour',
    ];

    public function workers(): HasMany
    {
        return $this->hasMany(Worker::class);
    }
}
