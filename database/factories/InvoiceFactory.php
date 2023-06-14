<?php

namespace Database\Factories;

use App\Enums\InvoiceStatusesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement([InvoiceStatusesEnum::Paid->value, InvoiceStatusesEnum::Void->value, InvoiceStatusesEnum::Billed->value]);

        return [
            'user_id'      => User::factory(),
            'amount'       => $this->faker->numberBetween(100, 20000),
            'status'       => $status,
            'billed_date'  => $this->faker->dateTimeThisDecade(),
            'paid_date'    => $status === InvoiceStatusesEnum::Paid->value ? $this->faker->dateTimeThisDecade() : null,
        ];
    }
}
