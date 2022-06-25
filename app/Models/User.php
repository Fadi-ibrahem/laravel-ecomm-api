<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

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
     * Start JWT Dependencies
     */

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * End JWT Dependencies
     */



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
