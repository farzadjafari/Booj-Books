<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
            </div>
        </div>
    </div>
</x-app-layout>
