<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumni>
 */
class AlumniFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mobile' => fake()->phoneNumber,
            'address' => fake()->address,
            'pob' => fake()->city,
            'dob' => fake()->date(),
            'registration_at' => fake()->dateTimeBetween('-5 years', '-4 years'),
            'graduation_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'school_id' => School::factory(),
            'user_id' => User::factory(),
        ];
    }
}
