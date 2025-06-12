<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6">Edit News Article</h2>

                    <form method="POST" action="{{ route('news.update', $news) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Category Selection -->
                        <div class="mb-6">
                            <x-input-label for="category" :value="__('Category')" />
                            <select id="category" name="category" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-500">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $news->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->translations($defaultLocale)?->first()->title ?? '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Publishing Date -->
                        <div class="mb-6">
                            <x-input-label for="publishing_date" :value="__('Publishing Date')" />
                            <x-text-input
                                id="publishing_date"
                                class="block mt-1 w-full"
                                type="date"
                                name="publishing_date"
                                :value="old('publishing_date', $news->published_at)"
                                required />
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-6">
                            <x-input-label for="image" :value="__('Featured Image')" />
                            <input id="image" class="block mt-1 text-gray-700 dark:text-gray-300" type="file" name="image">
                            @if($news->feture_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $news->feture_image) }}" alt="{{$news->title}}" class="h-20">
                            </div>
                            @endif
                        </div>

                        <!-- Default Language Fields -->
                        <h3 class="text-lg font-medium mb-4">English (Default)</h3>

                        <!-- Title -->
                        <div class="mb-4">
                            <x-input-label for="en_title" :value="__('Title')" />
                            <x-text-input
                                id="en_title"
                                class="block mt-1 w-full"
                                type="text"
                                name="en[title]"
                                :value="old('en.title', $translations['en']->title ?? '')"
                                required />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="en_description" :value="__('Description')" />
                            <textarea
                                id="en_description"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-500"
                                name="en[description]"
                                rows="5"
                                required>{{ old('en.description', $translations['en']->description ?? '') }}</textarea>
                        </div>

                        <!-- Other Languages -->
                        @foreach($locales as $locale)
                        @if($locale !== $defaultLocale)
                        <h3 class="text-lg font-medium mb-4">{{ strtoupper($locale) }} (Auto-translated)</h3>

                        <!-- Title -->
                        <div class="mb-4">
                            <x-input-label for="{{ $locale }}_title" :value="__('Title')" />
                            <x-text-input
                                id="{{ $locale }}_title"
                                class="block mt-1 w-full bg-gray-100 dark:bg-gray-600 dark:text-gray-300"
                                type="text"
                                name="{{ $locale }}[title]"
                                :value="old($locale . '.title', $translations[$locale]->title ?? '')"
                                readonly />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="{{ $locale }}_description" :value="__('Description')" />
                            <textarea
                                id="{{ $locale }}_description"
                                class="block mt-1 w-full rounded-md bg-gray-100 dark:bg-gray-900 border-gray-300 shadow-sm dark:text-gray-300 dark:border-gray-500"
                                name="{{ $locale }}[description]"
                                rows="5"
                                readonly>{{ old($locale . '.description', $translations[$locale]->description ?? '') }}</textarea>
                        </div>
                        @endif
                        @endforeach

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md transition ease-in-out duration-150">
                                Back to Admin
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Update News') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
