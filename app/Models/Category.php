<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'sub_category_id',
    ];

    // Get the products for the category
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }


    /**
     * Start Unary Relation Ship (on-to-many)
     */

    // Get the sub categories for the category
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'sub_category_id', 'id');
    }

    // Get the category that has the sub categories
    public function category()
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }

    /**
     * End Unary Relation Ship (on-to-many)
     */
}
