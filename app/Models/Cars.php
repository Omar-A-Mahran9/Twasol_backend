<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['name', 'full_image_path', 'description'];
    protected $casts   = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'car_id'); // Use the correct foreign key column here
    }
    

    public function brand()
    {
        return $this->belongsTo(Brand::class,'car_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class)->whereNull('parent_id')->withoutGlobalScope(SortingScope::class);
    }

    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()];
    }

    public function getFullImagePathAttribute()
    {
        return $this->images->map(function ($image) {
 
            return asset(getImagePathFromDirectory($image->name, 'CarImages', 'placeholder.png'));
        });    }
    

}
