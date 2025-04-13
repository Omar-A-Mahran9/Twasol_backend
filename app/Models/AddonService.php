<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonService extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['name','full_image_path', 'description','full_icon_path',];
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

    public function getFullIconPathAttribute()
    {
        return asset(getImagePathFromDirectory($this->icon, 'Services', "default.svg"));
    }

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Services', "default.svg"));
    }

    public function orders()
    {
        return $this->HasMany(Order::class);
    }


}
