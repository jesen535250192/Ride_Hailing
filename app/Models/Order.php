<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Rating;
use App\Models\User;

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
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
