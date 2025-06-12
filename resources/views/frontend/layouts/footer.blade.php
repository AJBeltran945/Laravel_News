<footer class="bg-gray-800 text-white py-6 mt-10">
    <div class="max-w-5xl mx-auto px-4">
        <h4 class="text-xl font-semibold mb-4 border-b border-gray-600 pb-1">{{ __('staticText.contact_form') }}</h4>
        <form action="{{ route('footer.contact.submit') }}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-3">
            @csrf
            <!-- Line 1 -->
            <input type="text" name="name" placeholder="{{ __('staticText.name') }}" required
                class="col-span-1 md:col-span-2 px-3 py-2 text-gray-900 rounded text-sm focus:outline-none focus:ring focus:ring-blue-400 transition duration-300 ease-in-out transform hover:scale-105">
            <input type="text" name="surname" placeholder="{{ __('staticText.surname') }}" required
                class="col-span-1 md:col-span-2 px-3 py-2 text-gray-900 rounded text-sm focus:outline-none focus:ring focus:ring-blue-400 transition duration-300 ease-in-out transform hover:scale-105">
            <input type="email" name="email" placeholder="{{ __('staticText.email') }}" required
                class="col-span-1 md:col-span-2 px-3 py-2 text-gray-900 rounded text-sm focus:outline-none focus:ring focus:ring-blue-400 transition duration-300 ease-in-out transform hover:scale-105">

            <!-- Line 2 -->
            <input type="text" name="subject" placeholder="{{ __('staticText.subject') }}" required
                class="col-span-1 md:col-span-3 px-3 py-2 text-gray-900 rounded text-sm focus:outline-none focus:ring focus:ring-blue-400 transition duration-300 ease-in-out transform hover:scale-105">
            <textarea name="message" placeholder="{{ __('staticText.message') }}" rows="1" required
                class="col-span-1 md:col-span-3 px-3 py-2 text-gray-900 rounded text-sm resize-none focus:outline-none focus:ring focus:ring-blue-400 transition duration-300 ease-in-out transform hover:scale-105"></textarea>

            <!-- Line 3 -->
            <input type="hidden" name="lang" value="{{ app()->getLocale() }}">
            <div class="col-span-1 md:col-span-6 flex justify-end">
                <button type="submit"
                    class="bg-white hover:bg-blue-400 text-gray-900 font-semibold tracking-wide px-6 py-2.5 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
                    {{ __('staticText.send') }}
                </button>
            </div>
        </form>
    </div>
</footer>
