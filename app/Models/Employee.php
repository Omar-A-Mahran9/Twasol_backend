<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $guarded = [];


    protected $casts = [

        'created_at' => 'date:Y-m-d',

        'updated_at' => 'date:Y-m-d',

        'birth_date' => 'date:Y-m-d',

        'hire_date' => 'date:Y-m-d',

        'termination_date' => 'date:Y-m-d',

    ];


    /**
     * Employee belongs to a department.
     */
    public function department()
    {
        return $this->belongsTo(
            Department::class
        );
    }
}
