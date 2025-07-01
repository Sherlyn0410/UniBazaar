<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory;
    use Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
        'is_admin',
        'profile_image',
    ];

    public function products()
{
    return $this->hasMany(Product::class);
}

public function orders()
{
    return $this->hasMany(Order::class, 'buyer_id');
}

public function receivedRatings()
{
    return $this->hasMany(Rating::class, 'seller_id');
}

public function givenRatings()
{
    return $this->hasMany(Rating::class, 'buyer_id');
}

public function buyer()
{
    return $this->belongsTo(Student::class, 'buyer_id');
}

}
