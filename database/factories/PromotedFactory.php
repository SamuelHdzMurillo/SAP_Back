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

        $startDate = '-12 months'; // Fecha de inicio (hace 6 meses)
        $endDate = 'now';
        return [
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'adress' => $this->faker->address,
            'colony' => $this->faker->secondaryAddress, // Campo añadido
            'postal_code' => $this->faker->postcode, // Campo añadido
            'house_number' => $this->faker->buildingNumber, // Campo añadido
            'electoral_key' => Str::random(18),
            'curp' => Str::random(18),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'section_id' => $this->faker->numberBetween(1, 400), // Asumiendo que tienes secciones en este rango
            'promotor_id' => $this->faker->numberBetween(1, 100), // Asumiendo que tienes promotores en este rango
            'created_at' => $this->faker->dateTimeBetween($startDate, $endDate), // Fecha aleatoria en los últimos 6 meses
            'updated_at' => $this->faker->dateTimeBetween($startDate, $endDate), // Fecha aleatoria en los últimos 6 meses
        ];
    }
}
