<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements TranslatableContract, HasMedia
{
    use HasFactory, Translatable, InteractsWithMedia;

    protected $fillable=['parent_id'];
    public $translatedAttributes = ['title', 'description'];

    public function childs()
    {
        return $this->hasMany(Category::class,'parent_id')->with(['childs','translation']);
    }
    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }
    /**
     * Scope a query to only include active categories.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }
    public function scopeParentable(Builder $query): void
    {
        $query->where(function ($q){
            $q->where('parent_id',null)->orWhereHas('parent',function ($query){
                $query->where('parent_id',null);
            });
        });
    }
    public function scopeGrandParents(Builder $query): void
    {
        $query->whereNull('parent_id');
    }
    public function getLevelAttribute()
    {
        if ($this->parent_id == null)
        {
            return 1;
        }
        elseif($this->parent_id != null && $this->parent->parent_id == null)
        {
            return 2;
        }
        else
        {
            return 3;
        }
    }
    public function getLevelNameAttribute()
    {
        if ($this->level == 1)
        {
            return __('labels.parent_category');
        }
        elseif($this->level == 2)
        {
            return __('labels.sub_category');
        }
        else
        {
            return __('labels.subset_category');
        }
    }
    public function getTreeStartAttribute()
    {
        if ($this->level == 1)
        {
            return $this;
        }
        elseif($this->level == 2)
        {
            return $this->parent;
        }
        else
        {
            return $this->parent->parent;
        }
    }

    /**
     * Get the profile image that owns the Driver
     *
     * @return Image
     */
    public function getImageAttribute()
    {
        return $this->getFirstMedia('images')?->original_url;
    }

}
