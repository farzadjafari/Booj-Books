<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Http;

class BooksController extends Controller
{
    public function store()
    {
        if(!auth()->check())
        {
            return redirect()->route('login');
        }

        request()->validate([
            'title' => 'required|string',
            'author' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'published_date' => 'nullable|string',
        ]);

        $index = auth()->user()->books()->pluck('index')->max();

        Book::firstOrCreate(
            [
                'title' => request('title'),
                'author' => request('author'),
            ],
            [
            'description' => request('description'),
            'image' => request('image'),
            'published_date' => request('published_date'),
            'user_id' => auth()->user()->id,
            'index' => $index + 1,
        ]);

        return redirect()->route('books.index');
    }

    public function index()
    {
        if(!auth()->check())
        {
            return redirect()->route('login');
        }

        $books = auth()->user()->books()->simplePaginate(3);

        return view('books.index', ['books' => $books]);
    }

    public function show(Book $book)
    {
        return view('books.show', ['book' => $book]);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->back()->with('message', 'The visual was successfully deleted.');
    }
}
