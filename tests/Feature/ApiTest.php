<?php

namespace Tests\Feature;

use App\Models\Customer;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * Test customers index response.
     */
    public function test_v1_customers_index(): void
    {
        Customer::truncate();

        $customer = Customer::factory()->create([
            'id'    => 10,
            'name'  => 'Gilbert Fisher',
            'email' => 'emilia.hoppe@spencer.biz',
            'city'  => 'West Althea',
        ]);

        $response = $this->get('/api/v1/customers');

        $response->assertOk();
        $response->assertJsonPath('data.0.id', fn ($id) => $id === $customer->id);
        $response->assertJsonPath('data.0.name', $customer->name);

        $customer->delete();
    }
}
