<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'reg_date',
        'zone',
        'street',
    ];

    // Get the orders for the shipper
    public function orders()
    {
        return $this->hasMany(Order::class, 'shipper_id', 'id');
    }



    /**
     * Start Polymorphic Relationship
     */

    // Get all of the shipper's phone.
    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    /**
     * End Polymorphic Relationship
     */
}
