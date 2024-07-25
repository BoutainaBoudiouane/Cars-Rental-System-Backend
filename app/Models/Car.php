<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand', 'model', 'year', 'color', 'rental_price', 'available','image',
    ];

    // Define relationships with other models here
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
