<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('meta_title', 'News Website')</title>
    <meta name="description" content="@yield('meta_description', 'Stay informed with the latest news')">
    <meta name="keywords" content="@yield('meta_keywords', 'news, headlines, updates')">
    <meta name="author" content="@yield('meta_author', 'News Portal')">

    <meta property="og:type" content="article">
    <meta property="og:title" content="@yield('meta_og_title', config('app.name'))">
    <meta property="og:description" content="@yield('meta_og_description', 'Stay informed with the latest news')">
    <meta property="og:image" content="@yield('meta_og_image', asset('default.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_og_title', config('app.name'))">
    <meta name="twitter:description" content="@yield('meta_og_description', 'Stay informed with the latest news')">
    <meta name="twitter:image" content="@yield('meta_og_image', asset('default.jpg'))">

    <!-- CSS and JS links -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('frontend.layouts.header')

    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    @include('frontend.layouts.footer')
</body>

</html>
