<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['full_image_path', 'description', 'title'];
    protected $casts   = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getTitleAttribute()
    {
        return $this->attributes['title_' . app()->getLocale()];
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()];
    }

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Ads', "placeholder.png"));
    }
}
