require('./bootstrap')
require('alpinejs')

let books = document.getElementById('books')

new Sortable(books, {
    animation: 150,
    ghostClass: 'bg-blue-200',
    store: {
        set: function (sortable) {
            axios.post('/books/sort', {
                items: sortable.toArray(),
            }).then(function (response){
                window.history.replaceState(null, null, window.location.pathname);
            })
        }
    },
})

