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

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function branch()
    {
        return $this->belongsTo(CityVendor::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function historyOrder()
    {
        return $this->hasMany(HistoryOrder::class);
    }
    public function reasons()
    {
        return $this->belongsToMany(OrderReason::class, 'order_reason')->withPivot('comment', 'created_at');
    }
    public function getStatusAttribute()
    {
        return OrderStatus::tryFrom($this->attributes['status'])->name;
    }
}
