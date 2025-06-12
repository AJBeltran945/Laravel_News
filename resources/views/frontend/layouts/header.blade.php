<header class="fixed top-0 left-0 w-full z-50 bg-gray-800 text-white shadow-md">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('home') }}"
                class="text-2xl font-bold transform transition-transform duration-300 hover:scale-110 hover:text-blue-400">
                {{ __('staticText.aj_news') }}
            </a>
            <nav class="md:block">
                <ul class="flex space-x-4">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a hreflang="{{ $localeCode }}"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                            class="transform transition-transform duration-300 hover:scale-110 hover:text-blue-400 uppercase">
                            {{ $localeCode }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</header>
