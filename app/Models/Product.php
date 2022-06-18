<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'qty',
        'image',
        'description',
        'price',
        'supplier_id',
        'admin_id',
        'category_id',
        'sub_category_id',
        'color_id',
        'size_id',
    ];

    /**
     * Start One-To-Many Relationship
     */

    // Get the feedbacks of the product
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'product_id', 'id');
    }

    // Get the admin that add or approve the product
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    // Get the supplier that supplies the product
    public function supplier()
    {
        return $this->belongsTo(UserSupplier::class, 'supplier_id', 'user_id');
    }

    // Get the category that has the product
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * End One-To-Many Relationship
     */



    /**
     * Start Many-To-Many Relationship
     */

    // The colors that belong to the product
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'products_colors', 'product_id', 'color_id');
    }

    // The sizes that belong to the product
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'products_sizes', 'product_id', 'size_id');
    }

    // The orders that belong to the product
    public function orders()
    {
        return $this->belongsToMany(Order::class,
            'orders_products',
            'product_id',
            'order_id')
            ->withPivot('qty', 'current_product_price', 'current_total_product_price', 'offer')
            ->withTimestamps();
    }

    /**
     * End Many-To-Many Relationship
     */
}
