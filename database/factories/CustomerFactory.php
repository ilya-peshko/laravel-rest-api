<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\en_AU\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['Individual', 'Business']);
        $name = $type === 'Individual' ? $this->faker->name() : $this->faker->company();

        return [
            'name'        => $name,
            'type'        => $type,
            'email'       => $this->faker->email(),
            'address'     => $this->faker->streetAddress(),
            'city'        => $this->faker->city(),
            'state'       => Address::state(),
            'postal_code' => $this->faker->postcode(),
        ];
    }
}
