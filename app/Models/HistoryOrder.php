<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryOrder extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }
    public function getStatusAttribute()
    {
        return OrderStatus::tryFrom($this->attributes['status'])->name;
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

}
