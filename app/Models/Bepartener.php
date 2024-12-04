<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bepartener extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts   = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
    ];

    public function cities()
    {
        return $this->belongsToMany(City::class, 'bepartner_city', 'bepartener_id', 'city_id');
    }
}
