<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'f_name',
        'l_name',
        'type',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /**
     * Start One-To-One Relationships
     */

    // Get the supplier associated with the user
    public function supplier()
    {
        return $this->hasOne(UserSupplier::class, 'user_id', 'id');
    }

    // Get the supplier associated with the user
    public function customer()
    {
        return $this->hasOne(UserCustomer::class, 'user_id', 'id');
    }

    /**
     * End One-To-One Relationships
     */


    /**
     * Start One-To-Many Relationship
     */

    // Get the products for the admin
    public function products()
    {
        return $this->hasMany(Product::class, 'admin_id', 'id');
    }

    /**
     * End One-To-Many Relationship
     */
}
