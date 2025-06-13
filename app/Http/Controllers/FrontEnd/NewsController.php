<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function show(News $news)
    {
        $locale = app()->getLocale();
        $categories = News::with('translations')->get();

        return view('frontend.news.show', compact('news', 'categories', 'locale'));
    }
}
