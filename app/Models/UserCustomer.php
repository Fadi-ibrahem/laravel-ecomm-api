<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'zone',
        'street',
    ];

    /**
     * Start One-To-One Relationship
     */

    // Get user that equals to the customer
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * End One-To-One Relationship
     */



    /**
     * Start One-To-Many Relationship
     */

    // Get the orders for the customer
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'user_id');
    }

    // Get the feedbacks of the customer
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'customer_id', 'user_id');
    }

    /**
     * End One-To-Many Relationship
     */
}
