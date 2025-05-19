<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_price',
        'product_details',
        'product_image',
        'student_id',
        ];
        
 public function student()
{
    return $this->belongsTo(Student::class);
}

}
