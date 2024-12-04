<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['question', 'answer'];
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

    public function getQuestionAttribute()
    {
        return $this->attributes['question_' . app()->getLocale()];
    }

    public function getAnswerAttribute()
    {
        return $this->attributes['answer_' . app()->getLocale()];
    }

}
