<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts   = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function addon_service()
    {
        return $this->belongsTo(AddonService::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    
}
