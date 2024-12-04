<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;
    protected $guarded = [];
    protected $appends = ['commercial_register_image_path', 'licensure_image_path', 'logo_path', 'cover_path', 'description', 'brand'];
    protected $guard = 'vendor';
    protected $casts = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d', 'subscription_end_date' => 'date:Y-m-d'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }
    public function getBrandAttribute()
    {
        return $this->attributes['brand_name_' . app()->getLocale()];
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function vendorShipment()
    {
        return $this->hasOne(VendorShipment::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class)->withoutGlobalScope(SortingScope::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'vendor_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_vendors', 'vendor_id', 'category_id')->withPivot('ratio')->withoutGlobalScope(SortingScope::class);
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()];
    }

    public function getCommercialRegisterImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->commercial_register, 'Vendors', "default.svg"));
    }

    public function getLicensureImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->licensure, 'Vendors', "default.svg"));
    }

    public function getLogoPathAttribute()
    {
        return asset(getImagePathFromDirectory($this->logo, 'Vendors', "default.svg"));
    }

    public function getCoverPathAttribute()
    {
        return asset(getImagePathFromDirectory($this->cover, 'Vendors', "default.svg"));
    }
}
