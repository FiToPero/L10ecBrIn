<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'productName' => $this->faker->name(),
            'shortDescription' => $this->faker->text(15),
            'company' => $this->faker->company(),
            'brand' => $this->faker->lastName(20),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'stock' => $this->faker->numberBetween(1, 100),
            'address' => $this->faker->address(30),
            'website' => $this->faker->url(30),
            'email' => $this->faker->unique()->safeEmail(),
            'remember' => $this->faker->boolean(),
            'priority' => $this->faker->numberBetween(2, 10),
            'image_01' => 'storage/images/photo_'. $this->faker->numberBetween(1, 26) . '.jpg',
            'image_02' => 'storage/images/photo_'. $this->faker->numberBetween(1, 26) . '.jpg',
            'image_03' => 'storage/images/photo_'. $this->faker->numberBetween(1, 26) . '.jpg',
            'image_04' => 'storage/images/photo_'. $this->faker->numberBetween(1, 26) . '.jpg',
            'image_05' => 'storage/images/photo_'. $this->faker->numberBetween(1, 26) . '.jpg'
        ];

        //  'image' => $this->faker->image('img/images', 1080, 1080, null, true),
    }
}
