<?php

namespace Database\Factories;

use App\Models\Master;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Master::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
