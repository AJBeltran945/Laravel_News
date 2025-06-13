@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between mt-6">
    {{-- Mobile --}}
    <div class="flex justify-between w-full sm:hidden">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
        <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded">{{ __('pagination.previous') }}</span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">{{ __('pagination.previous') }}</a>
        @endif

        {{-- Next --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">{{ __('pagination.next') }}</a>
        @else
        <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded">{{ __('pagination.next') }}</span>
        @endif
    </div>

    {{-- Desktop --}}
    <div class="hidden sm:flex sm:items-center sm:justify-between w-full">
        <div class="text-sm text-gray-600">
            {{ __('Showing') }}
            @if ($paginator->firstItem())
            <span class="font-semibold text-black">{{ $paginator->firstItem() }}</span> -
            <span class="font-semibold text-black">{{ $paginator->lastItem() }}</span>
            @else
            {{ $paginator->count() }}
            @endif
            {{ __('of') }} <span class="font-semibold text-black">{{ $paginator->total() }}</span> {{ __('results') }}
        </div>

        <div class="inline-flex space-x-1 rtl:space-x-reverse mt-2 sm:mt-0">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
            <span class="px-3 py-1 bg-gray-300 text-gray-500 rounded-l">&laquo;</span>
            @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 bg-gray-600 text-white rounded-l hover:bg-gray-700 transition">&laquo;</a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
            @if (is_string($element))
            <span class="px-3 py-1 bg-gray-300 text-gray-500">{{ $element }}</span>
            @endif

            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <span class="px-3 py-1 bg-gray-800 text-white font-bold">{{ $page }}</span>
            @else
            <a href="{{ $url }}" class="px-3 py-1 bg-gray-600 text-white hover:bg-gray-700 transition">{{ $page }}</a>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 bg-gray-600 text-white rounded-r hover:bg-gray-700 transition">&raquo;</a>
            @else
            <span class="px-3 py-1 bg-gray-300 text-gray-500 rounded-r">&raquo;</span>
            @endif
        </div>
    </div>
</nav>
@endif
