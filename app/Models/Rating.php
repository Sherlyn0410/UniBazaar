<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

     protected $fillable = [
        'order_id',
        'seller_id',
        'buyer_id',
        'rating',
        'review',
    ];

     public function seller()
    {
        return $this->belongsTo(Student::class, 'seller_id');
    }

    public function buyer()
    {
        return $this->belongsTo(Student::class, 'buyer_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
