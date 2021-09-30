<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'description',
        'quantity'
    ];

    public function inStock()
    {
        return $this->quantity > 0;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
