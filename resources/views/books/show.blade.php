<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books Result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('books.index') }}"><< All Books</a>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <img style="max-width: 20rem" class="mb-2" src="{{ $book->image }}" alt="Book thumbnail">
                    
                    <h1 class="md:text-2xl font-bold">{{ $book->title }}</h1>

                    <p><strong>Author: </strong>{{ $book->author }}</p>

                    <p><strong>Description: </strong>{{ $book->description }}</p>

                    <p><strong>Published Date: </strong>{{ date('j F, Y', strtotime(data_get($book, $book->published_date))) }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
