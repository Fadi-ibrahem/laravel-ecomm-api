<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSupplier extends Model
{
    use HasFactory, SoftDeletes;

    protected  $primaryKey = 'user_id';

    protected $fillable = [
        'address',
    ];

    /**
     * Start One-To-One Relationship
     */

    // Get user that equals to the supplier
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

    // Get the products for the supplier
    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id', 'user_id');
    }

    /**
     * End One-To-Many Relationship
     */



    /**
     * Start Polymorphic Relationship
     */

    // Get all of the supplier's phone.

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    /**
     * End Polymorphic Relationship
     */
}
