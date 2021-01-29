<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Http;

class ApiBooksController extends Controller
{
    protected $apiUrl = 'https://www.googleapis.com/books/v1/volumes?q=';

    public function __invoke()
    {
        request()->validate([
            'search' => ['required' ,'string']
        ]);

        $response = Http::get($this->apiUrl . request('search') . '&maxResults=10');

        $books = $response->json();

        return view('api-books.index', ['books' =>$books]);
    }
}
