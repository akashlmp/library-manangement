<style>
    .error {
        border-color: red;
    }
</style>

<div style="display: none !important"
    class="absolute top-0 bottom-0 left-0 right-0 z-10 py-12 transition duration-150 ease-in-out bg-gray-700"
    id="modal">
    <div role="alert" class="container w-11/12 max-w-lg mx-auto md:w-2/3">
        <div class="relative px-5 py-8 bg-white border border-gray-400 rounded shadow-md md:px-10">
            <div class="flex justify-start w-full mb-3 text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="52"
                    height="52" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <path
                        d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />
                    <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" />
                </svg>
            </div>
            <h1 class="mb-4 font-bold leading-tight tracking-normal text-gray-800 font-lg">Enter Book Details</h1>
            <label for="name" class="text-sm font-bold leading-tight tracking-normal text-gray-800">Book
                Name</label>
            <input id="name" x-model="bookFormFeilds.book_name" name="book_name"
                class="flex items-center w-full h-10 pl-3 mt-2 mb-5 text-sm font-normal text-gray-600 border border-gray-300 rounded focus:outline-none focus:border focus:border-indigo-700 "
                :class="{ 'error': errors.book_name }" placeholder="James" />
            <template x-for="error in errors.book_name">
                <span x-text="error" class="text-sm text-red-500">
                </span>
            </template>
            <div class="relative mt-2 mb-5">
                <label for="authorname" class="text-sm font-bold leading-tight tracking-normal text-gray-800">Author
                    Name</label>
                <input id="authorname" x-model="bookFormFeilds.author_name" name="author_name"
                    class="flex items-center w-full h-10 pl-3 mt-2 mb-5 text-sm font-normal text-gray-600 border border-gray-300 rounded focus:outline-none focus:border focus:border-indigo-700 "
                    :class="{ 'error': errors.author_name }" placeholder="James" />
                <template x-for="error in errors.author_name">
                    <span x-text="error" class="text-sm text-red-500">
                    </span>
                </template>
            </div>
            <div class="relative mt-2 mb-5">
                <label for="category"
                    class="text-sm font-bold leading-tight tracking-normal text-gray-800">Category</label>
                <select x-model="bookFormFeilds.category" id="category" name="category"
                    class="flex items-center w-full h-10 pl-3 mt-2 mb-5 text-sm font-normal text-gray-600 border border-gray-300 rounded focus:outline-none focus:border focus:border-indigo-700 "
                    :class="{ 'error': errors.category }">
                    <template x-for="category in bookCategories">
                        <option value="category.id" x-text="category.name"></option>
                    </template>
                </select>
                <template x-for="error in errors.category">
                    <span x-text="error" class="text-sm text-red-500">
                    </span>
                </template>
            </div>
            <div class="relative mt-2 mb-5">
                <label for="price"
                    class="text-sm font-bold leading-tight tracking-normal text-gray-800">Price</label>
                <input x-model="bookFormFeilds.price" type="number" id="price" name="price"
                    class="flex items-center w-full h-10 pl-3 mt-2 mb-5 text-sm font-normal text-gray-600 border border-gray-300 rounded focus:outline-none focus:border focus:border-indigo-700 "
                    :class="{ 'error': errors.price }" placeholder="James" />
                <template x-for="error in errors.price">
                    <span x-text="error" class="text-sm text-red-500">
                    </span>
                </template>
            </div>
            <div class="flex items-center justify-start w-full">
                <button type="button" @click="addBook()"
                    class="px-8 py-2 text-sm text-white transition duration-150 ease-in-out bg-indigo-700 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 hover:bg-indigo-600">Submit</button>
                <button
                    class="px-8 py-2 ml-3 text-sm text-gray-600 transition duration-150 ease-in-out bg-gray-100 border rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 hover:border-gray-400 hover:bg-gray-300"
                    onclick="modalHandler()">Cancel</button>
            </div>
            <button
                class="absolute top-0 right-0 mt-4 mr-5 text-gray-400 transition duration-150 ease-in-out rounded cursor-pointer hover:text-gray-600 focus:ring-2 focus:outline-none focus:ring-gray-600"
                onclick="modalHandler()" aria-label="close modal" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20"
                    height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
    </div>
</div>
<script>
    let modal = document.getElementById("modal");

    function modalHandler(val) {
        if (val) {
            fadeIn(modal);
        } else {
            fadeOut(modal);
        }
    }

    function fadeOut(el) {
        el.style.opacity = 1;
        (function fade() {
            if ((el.style.opacity -= 0.1) < 0) {
                el.style.display = "none";
            } else {
                requestAnimationFrame(fade);
            }
        })();
    }

    function fadeIn(el, display) {
        el.style.opacity = 0;
        el.style.display = display || "flex";
        (function fade() {
            let val = parseFloat(el.style.opacity);
            if (!((val += 0.2) > 1)) {
                el.style.opacity = val;
                requestAnimationFrame(fade);
            }
        })();
    }
</script>
