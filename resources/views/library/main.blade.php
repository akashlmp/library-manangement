@extends('layouts.app')

@section('content')
<section x-data="library" class="py-10 bg-white dark:bg-gray-900 content md:py-16">
    <div class="grid grid-cols-1 gap-6 pt-24 mx-auto max-w-7xl sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        <template x-for="library in libraryData">
            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="p-4">
                    <h3 class="mb-2 text-lg font-semibold" x-text="library.product"></h3>
                    <p class="mb-4 text-gray-600 dark:text-gray-400">Description of Product 1.</p>
                </div>
                <div class="p-4 bg-gray-100 dark:bg-gray-700">
                    <button class="px-4 py-2 text-white transition duration-200 bg-green-500 rounded-md hover:bg-green-600">Add to Cart</button>
                </div>
            </div>
        </template>
    </div>
</section>

<script>
    var libraryFromController = @json($library);
</script>
@vite('resources/js/views/library.main.js')
@endsection
