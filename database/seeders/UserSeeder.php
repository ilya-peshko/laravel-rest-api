<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(25)
            ->hasInvoices(10)
            ->hasAddress()
            ->create();

        User::factory()
            ->count(100)
            ->hasInvoices(5)
            ->hasAddress()
            ->create();

        User::factory()
            ->count(100)
            ->hasInvoices(3)
            ->hasAddress()
            ->create();

        User::factory()
            ->count(5)
            ->hasAddress()
            ->create();
    }
}
