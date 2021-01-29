<form method="POST" action="{{ route('books.delete', ['book' => $book]) }}"
      class="ml-5">
    @csrf
    @method('DELETE')

    <button type="submit" title="Delete"
            onclick="return confirm('Are you sure about deleting {{ $book->title }}?')"
            class="flex items-center text-red-700 cursor-pointer hover:text-red-900 focus:outline-none">
        Remove
    </button>
</form>
