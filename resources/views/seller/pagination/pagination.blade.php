<div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
    <div class="flex justify-between flex-1 sm:hidden">
        <a href="javascript:void(0)"
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Previous</a>
        <a href="javascript:void(0)"
            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Next</a>
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium" x-text="pagination.current_page">1</span>
                to
                <span class="font-medium" x-text="pagination.last_page">10</span>
                of
                <span class="font-medium" x-text="pagination.total">97</span>
                results
            </p>
        </div>
        <div>
            <nav class="inline-flex -space-x-px rounded-md shadow-sm isolate" aria-label="Pagination">
                <template x-for="pageLink in pagination.links">
                    <a href="javascript:void(0)" aria-current="page" x-html="pageLink.label" @click="getLibraryData(pageLink.label)"
                        :class="{ 'text-white': pageLink.active }"
                        class="relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 dark:bg-gray-400 focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">1</a>
                </template>
            </nav>
        </div>
    </div>
</div>
