<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityProduct extends Model
{
    use HasFactory;

    protected $table = 'city_product';
    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function fastShipping()
    {
        return $this->hasOne(FastCity::class, 'city_id', 'city_id');
    }
}
