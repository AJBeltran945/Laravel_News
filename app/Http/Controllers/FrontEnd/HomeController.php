<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        $categories = Category::with('translations')->get();
        $news = News::with(['translations', 'category.translations'])
            ->orderByDesc('published_at')
            ->paginate(4);


        return view('frontend.home', compact('news', 'categories', 'locale'));
    }
}
