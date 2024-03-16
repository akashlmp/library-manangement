document.addEventListener('alpine:init', () => {
    Alpine.data('library', () => ({
        init() {
            console.log(this.libraryData);
        },
        libraryData: libraryFromController,

    }))
})
