<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'offer_percentage',
        'code',
    ];

    // Get the orders for the coupon
    public function orders()
    {
        return $this->hasMany(Order::class, 'coupon_id', 'id');
    }
}
