<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\News;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\DeepLTranslationService;
use Illuminate\Validation\Rules\In;

class NewsController extends Controller
{
    public function store(Request $request, DeepLTranslationService $translator)
    {
        $defaultLocale = 'en';
        $locales = config('locales.locales');

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'publishing_date' => 'required|date',
            'category' => 'required|exists:categories,id',
        ]);

        // Handle image upload
        $imagePath = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('img', 'public');
        }

        // Create the news item
        $news = News::create([
            'category_id' => $request->input('category'),
            'feture_image' => $imagePath,
            'published_at' => $request->input('publishing_date'),
        ]);

        // Handle default locale translation
        $news->translations()->create([
            'locale' => $defaultLocale,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => Str::slug($request->input('title'))
        ]);

        // Get other locales (excluding default)
        $otherLocales = array_diff($locales, [$defaultLocale]);

        // Create translations for each locale
        foreach ($otherLocales as $locale) {
            $translatedTitle = $translator->translate($request->input('title'), $defaultLocale, $locale);
            $translatedDescription = $translator->translate($request->input('description'), $defaultLocale, $locale);

            $news->translations()->create([
                'locale' => $locale,
                'title' => $translatedTitle,
                'description' => $translatedDescription,
                'slug' => Str::slug($translatedTitle),
            ]);
        }

        return redirect()->route('admin.index')->with('success', 'News created with translations.');
    }

    public function edit(int $id)
    {
        $news = News::find($id);
        $defaultLocale = 'en';
        $locales = config('locales.locales');
        $categories = Category::all();

        // Get all translations keyed by locale
        $translations = $news->translations->keyBy('locale');

        return view('backend.news.edit', compact(
            'news',
            'translations',
            'categories',
            'defaultLocale',
            'locales'
        ));
    }

    public function update(Request $request, News $news, DeepLTranslationService $translator)
    {
        $defaultLocale = 'en';
        $locales = config('locales.locales');

        $request->validate([
            "{$defaultLocale}.title" => 'required|string|max:255',
            "{$defaultLocale}.description" => 'required|string',
            'publishing_date' => 'required|date',
            'category' => 'required|exists:categories,id',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Update basic news data
        $news->update([
            'category_id' => $request->input('category'),
            'published_at' => $request->input('publishing_date'),
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('img', 'public');
            $news->update(['feture_image' => $imagePath]);
        }

        // Get the base data from default locale
        $baseData = $request->input($defaultLocale);

        // Update or create translations for each locale
        foreach ($locales as $locale) {
            $translationData = [
                'title' => ($locale === $defaultLocale)
                    ? $baseData['title']
                    : $translator->translate($baseData['title'], $defaultLocale, $locale),
                'description' => ($locale === $defaultLocale)
                    ? $baseData['description']
                    : $translator->translate($baseData['description'], $defaultLocale, $locale),
                'slug' => Str::slug(($locale === $defaultLocale)
                    ? $baseData['title']
                    : $translator->translate($baseData['title'], $defaultLocale, $locale)),
            ];

            $news->translations()->updateOrCreate(
                ['locale' => $locale],
                $translationData
            );
        }

        return redirect()->route('admin.index')->with('success', 'News updated with translations.');
    }

    public function destroy(int $id)
    {
        $news = News::find($id);
        $news->translations()->delete();
        $news->delete();

        return redirect()->back()->with('success', 'News deleted successfully.');
    }
}
