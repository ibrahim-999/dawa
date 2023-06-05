<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Comment extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'notifiable_id',
        'notifiable_type',
        'type',
        'reason'
    ];

    public $translatedAttributes = ['title', 'body'];

    /**
     * get driver profile warnings
     */
    public function profileComments()
    {
        return $this->hasMany(Warning::class, 'comment_id', 'id');
    }
}