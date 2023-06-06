<?php

namespace Database\Factories;

use App\Models\Layanan;
use Illuminate\Database\Eloquent\Factories\Factory;



class LayananFactory extends Factory
{
    protected $model = Layanan::class;

    public function definition(): array
    {
    	return [
    	    'nama_layanan' => $this->faker->word(3),
            'slug' => $this->faker->sentence(2),
            'harga' => 'Rp.' . $this->faker->randomFloat(),
            'deskripsi' => $this->faker->paragraphs(2),
    	];
    }
}
