<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPrice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = [];
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

    public function cars()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }

    public function from()
    {
        return $this->belongsTo(City::class,'from');
    }
    public function to()
    {
        return $this->belongsTo(City::class,'to');
    }
    public function city()
    {
        return $this->belongsTo(City::class,'city');
    }
}
