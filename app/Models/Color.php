<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'color_value',
    ];

    // The products that belong to the color.
    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_colors', 'color_id', 'product_id');
    }
}
