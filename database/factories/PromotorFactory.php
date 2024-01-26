<?php

namespace Database\Factories;

use App\Models\Promotor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PromotorFactory extends Factory
{
    protected $model = Promotor::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'position' => $this->faker->jobTitle,
            'profile_path' => $this->faker->imageUrl(),
            'ine_path' => $this->faker->imageUrl(),
            'municipal_id' => $this->faker->numberBetween(1, 5), // Asumiendo que tienes municipales en ese rango
            'password' => bcrypt('secret'), // O usa cualquier contraseña que desees
            // 'email_verified_at' => now(), // Descomenta si necesitas este campo
        ];
    }
}
