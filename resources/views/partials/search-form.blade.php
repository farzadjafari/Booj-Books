<div class="p-6 bg-white border-b border-gray-200">
    <form method="post" action="{{ route('api.books.fetch') }}" class="form-control">
        @csrf

        <label class="flex items-center">
            <span class="mr-2">Enter a keyword to search the books</span>

            <input type="text" placeholder="Start With Why" name="search"/>
        </label>

        <button class="btn btn-blue">Fetch Books</button>
    </form>
</div>
