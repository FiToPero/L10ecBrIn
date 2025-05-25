<?php

namespace Database\Factories;

use App\Models\Carousel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carousel>
 */
class CarouselFactory extends Factory
{
    protected $model = Carousel::class; // Modelo asociado al factory

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->text(50),
            'image' => 'storage/images/photo_' . $this->faker->numberBetween(1, 26) . '.jpg',
            // 'image' => $this->faker->image('img/images', 1080, 1080, null, true),
        ];
    }
}
