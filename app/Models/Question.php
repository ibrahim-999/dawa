<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    public $translatedAttributes = ['title'];

    /**
     * Get all of the answers for the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answer(): HasOne
    {
        return $this->hasOne(Answer::class);
    }
}
