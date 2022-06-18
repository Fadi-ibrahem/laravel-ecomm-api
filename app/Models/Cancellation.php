<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancellation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'refund_amount',
        'notes',
    ];

    // Get order that owns the cancellation
    public function order()
    {
        return $this->belongsTo(Order::class, 'cancellation_id', 'id');
    }
}
