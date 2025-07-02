<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'product_name',
        'product_price',
        'quantity',
        'product_details',
        'product_image',
        'student_id',
        'is_approved',
        'status'
        ];
        

public function updateStockStatus()
{
    if ($this->quantity <= 0 && $this->status !== 'out_of_stock') {
        $this->status = 'out_of_stock';
        $this->save();
    } elseif ($this->quantity > 0 && $this->status === 'out_of_stock') {
        $this->status = 'live';
        $this->save();
    }
}
 public function student()
{
    return $this->belongsTo(Student::class);
}
public function orders()
{
    return $this->hasMany(Order::class);
}



}
