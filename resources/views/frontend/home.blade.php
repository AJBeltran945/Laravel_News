@if(isset($category))
@section('meta_title', $category->getTranslation()?->name)
@section('meta_description', 'Latest news in ' . $category->getTranslation()?->name)
@section('meta_keywords', strtolower($category->getTranslation()?->name))
@else
@section('meta_title', __('news.latest_news'))
@section('meta_description', __('footer.description'))
@section('meta_keywords', 'news, homepage, categories')
@endif

@extends('frontend.layouts.app')

@section('title', 'AJ NEWS')

@section('content')
<h1 class="text-3xl font-bold mb-6">{{ __('staticText.latest_news') }}</h1>

<form method="GET" action="" class="mb-6" id="category-filter">
    <label for="category" class="block mb-2 text-sm font-medium text-gray-700">
        {{ __('staticText.filter_category') }}:
    </label>

    <select name="category" id="category" class="border rounded p-2 w-60 max-w-xs"
        onchange="window.location = this.value">
        <option value="{{ route('home') }}">{{ __('staticText.default_category') }}</option>
        @foreach($categories as $categ)
        <option value="{{ route('category.show', $categ->slug) }}"
            @if(isset($category) && $categ->id == $category->id) selected @endif>
            {{ $categ->title }}
        </option>
        @endforeach
    </select>
</form>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach($news as $item)
    @include('frontend.partials.news-card', ['news' => $item])
    @endforeach
</div>

<div class="mt-6">
    {{ $news->links() }}
</div>

@endsection
