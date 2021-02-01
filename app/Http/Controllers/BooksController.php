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
                'user_id' => auth()->user()->id,
            ],
            [
            'description' => request('description'),
            'image' => request('image'),
            'published_date' => request('published_date'),
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

        $order = (request('order') ? request('order') : 'index');

        $books = auth()->user()->books()->orderBy($order)->get();

        return view('books.index', ['books' => $books]);
    }

    public function show(Book $book)
    {
        return view('books.show', ['book' => $book]);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('message', 'The visual was successfully deleted.');
    }
}
