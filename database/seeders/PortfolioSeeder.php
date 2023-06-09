<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $data = [
            'judul' => $faker->words,
            'slug' => $faker->slug,
            'gambar' => $faker->sentence,
            'deskripsi' => $faker->paragraphs,
        ];

        Portfolio::create($data);
    }
}
