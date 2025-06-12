<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6">Edit Category</h2>

                    <form method="POST" action="{{ route('categories.update', $category) }}">
                        @csrf
                        @method('PUT')

                        <!-- Default Language Field -->
                        <div class="mb-6">
                            <x-input-label for="{{ $defaultLocale }}_title" :value="__('Title ('.strtoupper($defaultLocale).')')" />
                            <x-text-input
                                id="{{ $defaultLocale }}_title"
                                class="block mt-1 w-full"
                                type="text"
                                name="{{ $defaultLocale }}[title]"
                                :value="old($defaultLocale.'.title', $translations[$defaultLocale]->title ?? '')"
                                required
                                autofocus />
                            <x-input-error :messages="$errors->get($defaultLocale.'.title')" class="mt-2" />
                        </div>

                        <!-- Other Languages -->
                        @foreach($locales as $locale)
                        @if($locale !== $defaultLocale)
                        <div class="mb-4">
                            <x-input-label for="{{ $locale }}_title" :value="__('Title ('.strtoupper($locale).') - Auto-translated')" />
                            <x-text-input
                                id="{{ $locale }}_title"
                                class="block mt-1 w-full bg-gray-100"
                                type="text"
                                name="{{ $locale }}[title]"
                                :value="old($locale.'.title', $translations[$locale]->title ?? '')"
                                readonly />
                        </div>
                        @endif
                        @endforeach

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md transition ease-in-out duration-150">
                                Back to Admin
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Update Category') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
