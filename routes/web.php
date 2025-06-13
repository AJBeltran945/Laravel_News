<?php

use App\Http\Controllers\Frontend\HomeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\FooterContactController;
use Illuminate\Support\Facades\Route;

// Página de inicio con filtro de categoría
Route::get('/', fn() => redirect()->route('home'));

// Pagina de inicio
Route::get(LaravelLocalization::transRoute('routes.home'), [HomeController::class, 'index'])->name('home');

// Página de categoría
Route::get(LaravelLocalization::transRoute('routes.category'), [CategoryController::class, 'show'])
    ->name('category.show');

// Página de noticia individual
Route::get(LaravelLocalization::transRoute('routes.news'), [NewsController::class, 'show'])
    ->name('news.show');

// Pagina de footer
Route::post('/footer-contact', [FooterContactController::class, 'submit'])
    ->name('footer.contact.submit');
