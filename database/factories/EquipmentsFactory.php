<?php

namespace Database\Factories;

use App\Models\Equipments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EquipmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Equipments::class;

    public function definition(): array
    {
        return [
            'uuid'             => $this->faker->uuid(),
            'equipment_number' => strtoupper('EQ-' . $this->faker->unique()->numerify('#####')),
            'equipment_name'   => $this->faker->unique()->words(2, true),
            'general_capacity' => $this->faker->numberBetween(10, 150),
            'battery_level'    => $this->faker->numberBetween(0, 100),
            'current_address'  => $this->faker->address(),
            'equipment_status' => $this->faker->randomElement(['active','deactive','under_repair']),
        ];
    }
}
