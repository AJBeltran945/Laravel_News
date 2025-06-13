<a href="{{ route('news.show', $news->translations->firstWhere('locale', $locale)?->slug) }}">
    <article class="bg-gray-600 rounded-lg shadow-md transform transition-transform duration-300 hover:scale-105">
        @if ($news->feture_image)
        <img src="{{ asset('storage/' . $news->feture_image) }}" alt="News Image" class="w-full h-48 object-cover">
        @endif
        <div class="p-6 h-{1000px}">
            <h2 class="text-xl text-white font-bold mb-3">{{ $news->translations->where('locale', $locale)->first()?->title }}</h2>
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-white">{{ $news->published_at }}</span>
                <span class="text-sm text-white">
                    {{ $news->category?->translations->where('locale', $locale)->first()?->title }}
                </span>
            </div>
        </div>
    </article>
</a>
