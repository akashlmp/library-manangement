document.addEventListener('alpine:init', () => {
    Alpine.data('sellerTable', () => ({
        init() {

            console.log(this.pagination)
        },
        search: '',
        libraryData: data['library']['data'],
        pagination: {
            links: data['library']['links'],
            current_page: data['library']['current_page'],
            last_page: data['library']['last_page'],
            per_page: data['library']['per_page'],
            total: data['library']['total'],
        },
        bookCategories: data['bookCategories'],
        routes: {
            sellerStoreRoute: sellerStoreRoute,
            sellerLibraryRoute: sellerLibraryRoute
        },
        bookFormFeilds: {
            'book_name': 'test book',
            'author_name': '',
            'category': (data['bookCategories']).length > 0 ? data['bookCategories'][0].id : '',
            'price': 0,
        },
        errors: {

        },
        addBook() {
            let refThis = this;
            axios.post(this.routes['sellerStoreRoute'], this.bookFormFeilds)
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    if (error.hasOwnProperty('response') && error.response.hasOwnProperty('data') && error.response.data.hasOwnProperty('errors')) {
                        refThis.errors = error['response']['data']['errors'];
                    }
                });
        },
        getLibraryData(page = 1, limit = 10) {
            $('table').css('opacity', 0.5);
            $('.table-loading').show();
            if (page == '&laquo; Previous') {
                page = this.pagination.current_page - 1;
            } else if (page == 'Next &raquo;') {
                page = this.pagination.current_page + 1;
            }
            let params = {
                page: page,
                limit: limit,
                search: this.search,
            };
            let refThis = this;
            axios.get(this.routes['sellerLibraryRoute'], {
                params: params
            })
                .then(function (response) {
                    let data = response['data']['data'];
                    refThis.libraryData = data['library']['data'];
                    refThis.pagination = {
                        links: data['library']['links'],
                        current_page: data['library']['current_page'],
                        last_page: data['library']['last_page'],
                        per_page: data['library']['per_page'],
                        total: data['library']['total'],
                    };
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(function () {
                    let route = refThis.routes.sellerLibraryRoute + '?';
                    let query = '';
                    Object.keys(params).forEach(function (param) {
                        if(params[param] && param != 'limit'){
                            query += query ? `&${param}=${params[param]}` : `${param}=${params[param]}`;
                        }
                    });
                    let routeWithQueryParams = route + query;
                    window.history.replaceState(routeWithQueryParams, null, routeWithQueryParams);
                    $('.table-loading').hide();
                    $('table').css('opacity', 1)
                });
        }


    }))
})
