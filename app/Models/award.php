<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class award extends Model
{
    use HasFactory;
    protected $table="awards";
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

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }
    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'awares', "default.svg"));
    }
}
