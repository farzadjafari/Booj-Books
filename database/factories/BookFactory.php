<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'index' => $this->faker->randomNumber(),
        'uuid' => $this->faker->uuid ,
        'title' => $this->faker->streetName ,
        'author' => $this->faker->name ,
        'description' => $this->faker->paragraph ,
        'image' => $this->faker->imageUrl() ,
        'published_date' => $this->faker->date() ,
        'user_id' => User::factory() ,
        ];
    }
}
