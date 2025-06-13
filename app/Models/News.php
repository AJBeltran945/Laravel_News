<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model implements \Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'feture_image',
        'published_at',
    ];

    protected $dates = [
        'published_at',
    ];

    // relation with News translation
    public function translations(): HasMany
    {
        return $this->hasMany(NewsTranslation::class);
    }

    // relation with category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function getLocalizedRouteKey($locale)
    {
        return $this->translations->firstWhere('locale', $locale)?->slug;
    }


    public function resolveRouteBinding($slug, $field = null)
    {
        return static::whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->with(['translations', 'category.translations'])->firstOrFail();
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

    public function description(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getTranslation()?->description ?? 'No Description',
        );
    }
}
