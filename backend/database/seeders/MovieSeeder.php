<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['shining', 'matrix', 'avengers', 'mad_max'] as $movie) {
            Movie::query()->create([
                'name' => ucfirst(str_replace('_', ' ', $movie)),
                'poster' => "/movies/{$movie}.jpeg"
            ]);
        }
    }
}
