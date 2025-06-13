<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Create New Category</h2>
                    </div>

                    <form method="POST" action="{{ route('categories.store') }}" class="space-y-6">
                        @csrf

                        <!-- Category Title -->
                        <div>
                            <x-input-label for="title" :value="__('Category Title')" />
                            <x-text-input
                                id="title"
                                class="block mt-1 w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                type="text"
                                name="title"
                                :value="old('title')"
                                required
                                autofocus
                                placeholder="Enter category name" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6 space-x-4">
                            <a href="{{ route('admin.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 text-white rounded-md transition ease-in-out duration-150">
                                Back to Admin
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Create Category') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
