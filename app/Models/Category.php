<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model implements \Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable
{
    use HasFactory;

    protected $fillable = [];

    // relation with category translation
    public function translations(): HasMany
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    // relation with news
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }


    public function getLocalizedRouteKey($locale)
    {
        return $this->translations->firstWhere('locale', $locale)?->slug;
    }


    public function resolveRouteBinding($slug, $field = null)
    {
        return static::whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->with(['translations'])->firstOrFail();
    }

    public function getTranslation()
    {
        return $this->translations->firstWhere('locale', app()->getLocale());
    }

    public function title(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getTranslation()?->title ?? 'No Title',
        );
    }

    public function slug(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getTranslation()?->slug ?? 'No Slug',
        );
    }
}
