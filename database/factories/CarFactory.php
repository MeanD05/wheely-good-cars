<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'license_plate' => strtoupper($this->faker->bothify('??-###-??')),
            'make' => $this->faker->randomElement([
                'BMW','Audi','Volkswagen','Toyota','Ford',
                'Mercedes','Peugeot','Renault','Tesla'
            ]),
            'model' => ucfirst($this->faker->word()),
            'price' => $this->faker->numberBetween(2000, 90000),
            'mileage' => $this->faker->numberBetween(0, 250000),
            'seats' => $this->faker->randomElement([2,4,5,7]),
            'doors' => $this->faker->randomElement([3,5]),
            'production_year' => $this->faker->numberBetween(1998, 2024),
            'weight' => $this->faker->numberBetween(900, 2500),
            'color' => $this->faker->safeColorName(),
            'views' => $this->faker->numberBetween(0, 5000),
            'sold_at' => $this->faker->optional(0.2)->dateTimeThisYear(),
            
        ];
    }
}
