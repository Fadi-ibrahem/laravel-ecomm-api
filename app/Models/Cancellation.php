<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cancellation extends Model
{
    use HasFactory, SoftDeletes;

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
