<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
      'buyer_id',
      'product_id',
      'quantity', 
      'ordered_at' => 'datetime',
       'is_paid'


      ];

    public function buyer()
    {
        return $this->belongsTo(Student::class, 'buyer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

