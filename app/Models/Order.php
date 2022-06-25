<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_number',
        'order_date',
        'shipped_date',
        'required_date',
        'customer_id',
        'shipper_id',
        'qty',
        'discount',
        'price',
        'card_type',
        'card_number',
        'tax',
        'total_price',
        'coupon_id',
        'status',
        'cancellation_id',
    ];

    /**
     * Start One-To-One Relationship
     */

    // Get the cancellation associated with the order
    public function cancellation()
    {
        return $this->hasOne(Cancellation::class, 'cancellation_id', 'id');
    }

    /**
     * End One-To-One Relationship
     */



    /**
     * Start One-To-Many Relationship
     */

    // Get the coupon that applied on the order
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }

    // Get the shipper that shipped the order
    public function shipper()
    {
        return $this->belongsTo(Shipper::class, 'shipper_id', 'id');
    }

    // Get the customer that generates the order
    public function customer()
    {
        return $this->belongsTo(UserCustomer::class, 'customer_id', 'user_id');
    }

    /**
     * End One-To-Many Relationship
     */




    /**
     * Start Many-To-Many Relationship
     */

    // The products that belong to the order
    public function products()
    {
        return $this->belongsToMany(Product::class,
            'orders_products',
            'order_id',
            'product_id')
            ->withPivot('qty', 'current_product_price', 'current_total_product_price', 'offer')
            ->withTimestamps();;
    }

    /**
     * End Many-To-Many Relationship
     */
}
