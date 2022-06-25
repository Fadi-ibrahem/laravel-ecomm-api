<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'rating',
        'product_id',
        'customer_id',
        'comment',
    ];

    protected $table = 'feedbacks';

    // Get the product that has the feedback
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // Get the customer that has the feedback
    public function customer()
    {
        return $this->belongsTo(UserCustomer::class, 'customer_id', 'user_id');
    }
}
