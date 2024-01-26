<?php

namespace Database\Factories;

use App\Models\Promoted;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PromotedFactory extends Factory
{
    protected $model = Promoted::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'adress' => $this->faker->address,
            'electoral_key' => Str::random(18),
            'curp' => Str::random(18),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'section_id' => $this->faker->numberBetween(1, 300), // Asumiendo que tienes secciones en este rango
            'promotor_id' => $this->faker->numberBetween(1, 100), // Asumiendo que tienes promotores en este rango
        ];
    }
}
