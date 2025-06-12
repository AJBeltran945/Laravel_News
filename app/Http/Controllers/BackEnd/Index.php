<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;

class Index extends Controller
{
    public function index()
    {
        $categories = Category::with('translations')->get();
        $news = News::with('translations')->get();
        return view('backend.index', compact('categories', 'news'));
    }
}
