<?php

namespace Tests\Feature\BoojBooks;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_a_book_to_her_list()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post('/books', [
            'title' => 'A book',
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'A book',
            'user_id' => $user->id
        ]);
    }

    public function test_user_can_see_all_her_books()
    {
        $user = User::factory()->hasBooks(5)->create();

        $this->actingAs($user);

        $response = $this->get('/books')->assertStatus(200);

        foreach ($user->books as $book) {
            $response->assertSee($book->title);
        }
    }

    public function test_user_can_see_a_book()
    {
        $user = User::factory()->hasBooks(1)->create();

        $this->actingAs($user);

        $book = $user->books[0];

        $this->get('/books/' . $book->uuid)
            ->assertStatus(200)
            ->assertSee($book->title);
    }

    public function test_user_can_delete_a_book()
    {
        $user = User::factory()->hasBooks(1)->create();

        $this->actingAs($user);

        $book = $user->books[0];

        $this->assertDatabaseHas('books', [
            'uuid' => $book->uuid,
        ]);

        $this->delete('/books/' . $book->uuid);

        $this->assertDatabaseMissing('books', [
            'uuid' => $book->uuid,
        ]);
    }

    public function test_user_can_only_see_her_books()
    {
        $loggedInUser = User::factory()->create();

        $this->actingAs($loggedInUser);

        $otherUser = User::factory()->create();

        $book = Book::factory()->create([
            'user_id' => $otherUser->id
        ]);

        $this->get('/books')
            ->assertDontSee($book->title);
    }
}
