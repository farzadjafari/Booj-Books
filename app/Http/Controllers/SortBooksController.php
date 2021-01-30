<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SortBooksController extends Controller
{
    public function __invoke()
    {
        foreach(request('items') as $index => $uuid)
        {
            $book = Book::where('uuid', $uuid)->first();

            if($book === null)
            {
                continue;
            }

            $book->update(['index' => $index]);
        }
    }
}
