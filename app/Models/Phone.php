<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'phoneable_id',
        'phoneable_type',
    ];

    // Get the parent phoneable model (supplier or shipper).
    public function phoneable()
    {
        return $this->morphTo();
    }
}
