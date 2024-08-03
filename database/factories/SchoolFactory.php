<?php

namespace Database\Factories;

use App\Actions\School\Utils;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\School>
 */
class SchoolFactory extends Factory
{
    use Utils;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'stage' => fake()->randomElement([self::STAGE_FORMAL, self::STAGE_NON_FORMAL]),
            'address' => fake()->address(),
        ];
    }
}
