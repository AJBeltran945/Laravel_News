<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $locale = app()->getLocale();
        $news = $category->news()->with(['translations', 'category.translations'])
            ->orderByDesc('published_at')
            ->paginate(4);
        $categories = Category::with('translations')->get();

        return view('frontend.home', compact('news', 'categories', 'locale', 'category'));
    }
}
