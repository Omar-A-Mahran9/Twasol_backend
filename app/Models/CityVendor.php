<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CityVendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'city_vendor';
    protected $guarded = [];
    protected $casts = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d', 'subscription_end_date' => 'date:Y-m-d'];


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id', 'vendor_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'vendor_id', 'vendor_id');
    }
}