<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.messages')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
                        @if($books->count() > 0)
                            <div
                                class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                                <p class="bg-blue-200 text-center p-1 rounded">
                                Sort the books by dragging and dropping them!<br>
                                    You can also sort them by clicking on the list's headings
                                </p>

                                <table class="min-w-full">
                                    <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                                            <a href="{{ route('books.index', ['order'=>'title']) }}" class="flex">Title
                                                <span class="ml-1">{{ (request('order') == 'title' ? '^' : '') }}</span>
                                            </a>
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                                            <a href="{{ route('books.index', ['order'=>'author']) }}" class="flex">Author
                                                <span class="ml-1">{{ (request('order') == 'author' ? '^' : '') }}</span>
                                            </a>
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                                            <a href="{{ route('books.index', ['order'=>'description']) }}" class="flex">Description
                                                <span class="ml-1">{{ (request('order') == 'description' ? '^' : '') }}</span>
                                            </a>
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                            Thumbnail
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                                            <a href="{{ route('books.index', ['order'=>'published_date']) }}" class="flex">Published Date
                                                <span class="ml-1">{{ (request('order') == 'published_date' ? '^' : '') }}</span>
                                            </a>
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white" id="books" data-sort="{{ route('books.sort') }}">
                                    @foreach ($books as $book)
                                        <tr data-id="{{ $book->uuid }}">
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                                <div class="text-sm leading-5 text-blue-900">{{ $book->title }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                                {{ $book->author }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                                {{ Str::limit($book->description, 100, '...') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                                <img style="max-width: 5rem" class="mb-2" src="{{ $book->image }}"
                                                     alt="Book thumbnail">
                                            </td>

                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5">
                                                {{ $book->published_date }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                                <div class="flex">
                                                    <a href="{{ route('books.show', ['book' => $book]) }}"
                                                       class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                                        View
                                                    </a>

                                                    @include('books.partials.delete-btn')
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
                        @else
                            <p>There is no book added to the list. <a class="underline" href="{{ route('dashboard') }}">Do it now!</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
