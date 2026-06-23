<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_id',
        'driver_id',
        'rating',
        'suggestion',
    ];

    /**
     * Rating dimiliki oleh satu Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Customer yang memberikan rating
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Driver yang menerima rating
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}