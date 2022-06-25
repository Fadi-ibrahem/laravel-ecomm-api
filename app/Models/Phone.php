<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phone extends Model
{
    use HasFactory, SoftDeletes;

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
