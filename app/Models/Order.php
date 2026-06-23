<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'pickup_location',
        'destination',
        'pickup_lat',
        'pickup_lng',
        'destination_lat',
        'destination_lng',
        'price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
