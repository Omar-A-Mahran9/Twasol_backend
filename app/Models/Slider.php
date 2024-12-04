<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['title', 'description', 'full_image_path', 'btn_title'];

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
    public function getTitleAttribute()
    {
        return $this->attributes['title_' . app()->getLocale()];
    }

    public function getBtnTitleAttribute()
    {
        return $this->attributes['btn_title_' . app()->getLocale()];
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()];
    }

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->background, 'Sliders', "default.svg"));
    }
}
