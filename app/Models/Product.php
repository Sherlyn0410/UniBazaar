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
        
 public function student()
{
    return $this->belongsTo(Student::class);
}
public function orders()
{
    return $this->hasMany(Order::class);
}



}
