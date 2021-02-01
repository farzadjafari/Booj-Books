<?php

namespace Tests\Feature\BoojBooks;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SortBookTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_sort_books()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $books = Book::factory()->count(2)->for($user)->create();

        $this->get('/books')
            ->assertSeeInOrder([$books[0]->title, $books[1]->title]);


        $this->post('/books/sort', [
            'items' => [
                0 => $user->books[1]->uuid,
                1 => $user->books[0]->uuid
            ]
        ]);

        $this->get('/books')
            ->assertSeeInOrder([$user->books[1]->title, $user->books[0]->title]);
    }
}
