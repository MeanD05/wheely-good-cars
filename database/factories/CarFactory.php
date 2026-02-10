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
       $makesAndModels = [
            'BMW' => ['3 Series', '5 Series', 'X3', 'X5', 'i8'],
            'Audi' => ['A3', 'A4', 'A6', 'Q5', 'Q7', 'e-tron'],
            'Volkswagen' => ['Golf', 'Passat', 'Tiguan', 'Polo', 'Arteon'],
            'Toyota' => ['Corolla', 'Camry', 'RAV4', 'Prius', 'Highlander'],
            'Ford' => ['Focus', 'Fiesta', 'Mustang', 'Explorer', 'F-150'],
            'Mercedes' => ['C-Class', 'E-Class', 'S-Class', 'GLA', 'GLE'],
            'Peugeot' => ['208', '308', '3008', '5008', '508'],
            'Renault' => ['Clio', 'Megane', 'Captur', 'Kadjar', 'Talisman'],
            'Tesla' => ['Model S', 'Model 3', 'Model X', 'Model Y'],
        ];

        $make = $this->faker->randomElement(array_keys($makesAndModels));
        $model = $this->faker->randomElement($makesAndModels[$make]);

        return [
            'license_plate' => strtoupper($this->faker->bothify('??-###-??')),
            'make' => $make,
            'model' => $model,
            'price' => $this->faker->numberBetween(2000, 90000),
            'mileage' => $this->faker->numberBetween(0, 250000),
            'seats' => $this->faker->randomElement([2,4,5,7]),
            'doors' => $this->faker->randomElement([3,5]),
            'production_year' => $this->faker->numberBetween(1998, 2024),
            'weight' => $this->faker->numberBetween(900, 2500),
            'color' => $this->faker->safeColorName(),
            'views' => $this->faker->numberBetween(0, 5000),
            'sold_at' => $this->faker->optional(0.2)->dateTimeThisYear(),
            'image' => 'https://loremflickr.com/640/480/car?' . uniqid(),
        ];
    }
}
