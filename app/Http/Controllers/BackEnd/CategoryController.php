<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\DeepLTranslationService;

class CategoryController extends Controller
{
    public function store(Request $request, DeepLTranslationService $translator)
    {
        $defaultLocale = 'en';
        $locales = config('locales.locales');

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $baseTitle = $request->input('title');

        // Create the category first
        $category = Category::create();

        // Handle default locale translation
        $category->translations()->create([
            'locale' => $defaultLocale,
            'title' => $baseTitle,
            'slug' => Str::slug($baseTitle),
        ]);

        // Get other locales (excluding default)
        $otherLocales = array_diff($locales, [$defaultLocale]);

        // Create translations for each locale
        foreach ($otherLocales as $locale) {
            $translatedTitle = $translator->translate($baseTitle, $defaultLocale, $locale);

            $category->translations()->create([
                'locale' => $locale,
                'title' => $translatedTitle,
                'slug' => Str::slug($translatedTitle),
            ]);
        }

        return redirect()->route('admin.index')->with('success', 'Category created with translations.');
    }

    public function edit(int $id)
    {
        $category = Category::find($id);
        $defaultLocale = 'en';
        $locales = config('locales.locales');
        $translations = $category->translations->keyBy('locale');

        return view('backend.categories.edit', compact('category', 'translations', 'defaultLocale', 'locales'));
    }

    public function update(Request $request, int $id, DeepLTranslationService $translator)
    {
        $category = Category::find($id);
        $defaultLocale = 'en';
        $locales = config('locales.locales');

        $request->validate([
            "$defaultLocale.title" => 'required|string|max:255'
        ]);

        $baseData = $request->input($defaultLocale);

        // Update or create translations for each locale
        foreach ($locales as $locale) {
            $title = ($locale === $defaultLocale)
                ? $baseData['title']
                : $translator->translate($baseData['title'], $defaultLocale, $locale);

            $category->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title' => $title,
                    'slug' => Str::slug($title),
                ]
            );
        }

        return redirect()->route('admin.index')
            ->with('success', 'Category updated successfully with all translations.');
    }

    public function destroy(int $id)
    {
        $category = Category::find($id);
        $category->translations()->delete();
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
