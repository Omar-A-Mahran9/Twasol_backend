<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['name', 'full_image_path'];
    protected $casts   = [
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
 

    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Backage', "default.svg"));
    }

    public function cars()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }

    public function from()
    {
        return $this->belongsTo(City::class,'from');
    }
    public function to()
    {
        return $this->belongsTo(City::class,'to');
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_package','package_id');
    }
    

}
