<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['name'];
    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }

    public function packages()
{
    return $this->belongsToMany(Packages::class, 'city_package','city_id');
}


    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('product_has_fast_shipping');
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class)->withoutGlobalScope(SortingScope::class);
    }

    public function branches()
    {
        return $this->belongsTo(CityVendor::class,'id','city_id')->withoutGlobalScope(SortingScope::class);
    }

    public function fastShipping()
    {
        return $this->hasOne(FastCity::class, 'city_id', 'id')->withoutGlobalScope(SortingScope::class);
    }

    public function bepartners()
    {
        return $this->belongsToMany(Bepartener::class, 'bepartner_city');
    }

  

    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }
}
