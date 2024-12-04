<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['name', 'description', 'name_trimmed', 'rate'];
    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
        // 'discount_from' => 'date:Y-m-d',
        // 'discount_to' => 'date:Y-m-d',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function designType()
    {
        return $this->belongsTo(DesignType::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withoutGlobalScope(SortingScope::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->whereNull('parent_id')->withoutGlobalScope(SortingScope::class);
    }

    public function categoriesNew()
    {
        return $this->belongsToMany(Category::class, 'category_product')
            ->withPivot('sub_category_id')->withoutGlobalScope(SortingScope::class); // Include the subcategory in the pivot table
    }
    public function subcategoriesNew()
    {
        return $this->belongsToMany(SubCategory::class, 'category_product')
            ->withPivot('category_id')->withoutGlobalScope(SortingScope::class); // Include category_id in the pivot
    }
    public function subcategories()
    {
        return $this->belongsToMany(Category::class)->whereNotNull('parent_id')->withoutGlobalScope(SortingScope::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function skinColors()
    {
        return $this->belongsToMany(SkinColor::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class)->withoutGlobalScope(SortingScope::class);
    }
    public function productCities()
    {
        return $this->hasMany(CityProduct::class)->withoutGlobalScope(SortingScope::class);
    }
    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class)->withoutGlobalScope(SortingScope::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function visits()
    {
        return $this->morphMany(Visit::class, 'visitable');
    }

    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }

    public function getNameTrimmedAttribute()
    {
        return strtoupper(substr($this->attributes['name_' . app()->getLocale()], 0, 2));
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()];
    }

    public function getRateAttribute()
    {
        return $this->rates()->count() == 0 ? 0 : round(($this->rates()->sum('rate') / $this->rates()->count()), 1);
    }
}
