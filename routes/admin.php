<?php

use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\BackEnd\Index;
use App\Http\Controllers\BackEnd\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Index::class, 'index'])->name('admin.index');

// Category Routes
Route::resource('categories', CategoryController::class)->except(['show']);
Route::get('/categories/create', function () {
    return view('backend.categories.create');
})->name('categories.create');

// News Routes
Route::resource('news', NewsController::class)->except(['show']);
Route::get('/news/create', function () {
    return view('backend.news.create');
})->name('news.create');

// Profile routes (keep them outside admin if you want)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// // Category

// Route::get('/categories/create', function () {
//     return view('backend.create-category');
// })->name('categories.create');

// Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
// Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
// Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
// Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// // News

// Route::get('/create-news', function () {
//     return view('backend.create-news');
// })->name('news.create');

// Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
// Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
// Route::post('/news', [NewsController::class, 'store'])->name('news.store');
// Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
