<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books Result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(! empty($books['items']))
                        <p>Check the books you want to add to your list.</p>

                        @foreach($books['items'] as $book)
                            <form method="post" action="{{ route('books.store') }}" class="form-control flex flex-col md:flex-row items-center">
                                @csrf

                                <div class="flex flex-col flex-1">
                                    <img style="max-width: 5rem" class="mb-2" src="{{ data_get($book, 'volumeInfo.imageLinks.thumbnail') }}" alt="Book thumbnail">
                                    <input type="hidden" name="image"
                                           value="{{ data_get($book, 'volumeInfo.imageLinks.thumbnail') }}">

                                    <p><strong>Title: </strong>{{ data_get($book, 'volumeInfo.title') }}</p>
                                    <input type="hidden" name="title" value="{{ data_get($book, 'volumeInfo.title') }}">

                                    <p><strong>Description: </strong>{{ data_get($book, 'volumeInfo.description') }}</p>
                                    <input type="hidden" name="description"
                                           value="{{ data_get($book, 'volumeInfo.description') }}">

                                    <p><strong>Author: </strong>{{ data_get($book, 'volumeInfo.authors.0') }}</p>
                                    <input type="hidden" name="author"
                                           value="{{ data_get($book, 'volumeInfo.authors.0') }}">


                                    <p><strong>Published Date: </strong>{{ date('j F, Y', strtotime(data_get($book, 'volumeInfo.publishedDate'))) }}</p>
                                    <input type="hidden" name="published_date"
                                           value="{{ data_get($book, 'volumeInfo.publishedDate') }}">

                                </div>

                                <button class="btn btn-blue">Add to list</button>
                            </form>
                        @endforeach
                    @else
                        <p>No result found! Please try again.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
