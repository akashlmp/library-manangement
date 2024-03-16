document.addEventListener("alpine:init", () => {
    Alpine.data("library", () => ({
        init() {
            console.log(this.libraryData, data);
        },
        libraryData: data["library"]["data"],
        page: data["library"]["current_page"],
        url: data["library"]["next_page_url"],
        fetchMore() {
            console.log(this.page, this.url);
            axios
                .get(this.url)
                .then((response) => {
                    console.log(response);
                    let data = response["data"]["data"];
                    this.libraryData = [
                        ...this.libraryData,
                        ...data["library"]["data"],
                    ];
                    this.page = data["library"]["current_page"];
                    this.url = data["library"]["next_page_url"];
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        handleScroll() {
            let scrollPosition = window.innerHeight + window.pageYOffset;
            let pageHeight = document.documentElement.scrollHeight;
            if (scrollPosition >= pageHeight) {
                this.fetchMore();
            }
        },
    }));
});

