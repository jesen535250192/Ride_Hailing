<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'user_id',
    'driver_id',
    'pickup_location',
    'destination',
    'pickup_lat',
    'pickup_lng',
    'dest_lat',
    'dest_lng',
    'distance',
    'price',
    'status',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}