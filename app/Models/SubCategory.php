<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['name', 'full_image_path', 'description'];
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

    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()];
    }

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Categories', "default.svg"));
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, CategorySubCategory::class);
    }
    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_subcategory', 'sub_category_id', 'category_id')
            ->withPivot('category_id');
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_subcategory_product', 'subcategory_id', 'product_id');
    }
}
