@section('meta_title', $news->getTranslation()?->title ?? 'News')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($news->getTranslation()?->content ?? ''), 160))
@section('meta_keywords', $news->getTranslation()?->tags ?? 'news')
@section('meta_author', $news->author->name ?? 'News Portal')
@section('meta_og_title', $news->getTranslation()?->title ?? '')
@section('meta_og_description', \Illuminate\Support\Str::limit(strip_tags($news->getTranslation()?->content ?? ''), 160))
@section('meta_og_image', $news->image ?? asset('default.jpg'))

@extends('frontend.layouts.app')

@section('content')
<article class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($news->feture_image)
    <img src="{{ asset('storage/' . $news->feture_image) }}" alt="{{ $news->title }}" class="w-full h-64 md:h-96 object-cover">
    @endif

    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <span class="text-sm text-gray-600">{{ $news->published_at }}</span>
            <a href="{{ route('category.show', $news->category?->translations->where('locale', $locale)->first()?->slug) }}"
                class="transform transition-transform duration-300 hover:scale-110">
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                    {{ $news->category?->translations->where('locale', $locale)->first()?->title }}
                </span>
            </a>
        </div>

        <h1 class="text-3xl font-bold mb-6">{{ $news->translations->where('locale', $locale)->first()?->title }}</h1>

        <div class="prose max-w-none">
            {{ $news->description }}
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('home') }}"
                class="text-blue-600 hover:text-blue-800 transform transition-transform duration-300 hover:scale-105 hover:underline">
                &larr; Back to News
            </a>
        </div>
    </div>
</article>

@endsection
