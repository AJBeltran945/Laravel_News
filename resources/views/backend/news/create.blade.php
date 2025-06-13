<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-6">Create News Article</h2>

                    <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="description" required rows="6">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <x-input-label for="image" :value="__('Image')" />
                            <div class="mt-1 flex items-center gap-4">
                                <label class="block">
                                    <span class="sr-only">Choose image</span>
                                    <input id="image" class="block w-full text-sm text-gray-600 dark:text-gray-400
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-indigo-50 dark:file:bg-indigo-900
                                        file:text-indigo-700 dark:file:text-indigo-100
                                        hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800
                                        cursor-pointer
                                        "
                                        type="file" name="image" accept="image/*" />
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Publishing Date -->
                        <div>
                            <x-input-label for="publishing_date" :value="__('Publishing Date')" />
                            <x-text-input id="publishing_date" class="block mt-1 w-full" type="date" name="publishing_date" :value="old('publishing_date')" required />
                            <x-input-error :messages="$errors->get('publishing_date')" class="mt-2" />
                        </div>

                        <!-- Categories Dropdown -->
                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <select id="category" name="category" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach(App\Models\Category::with(['translations' => function($query) {
                                $query->where('locale', 'en');
                                }])->get() as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->translations->first()?->title ?? 'No translation' }}
                                </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md transition ease-in-out duration-150">
                                Back to Admin
                            </a>

                            <x-primary-button class="ms-4">
                                {{ __('Create News') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
