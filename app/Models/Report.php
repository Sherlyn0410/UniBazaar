<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'seller_id',
        'order_id',
        'reason',
    ];

    // Relationships
    public function buyer()
    {
        return $this->belongsTo(Student::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(Student::class, 'seller_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
