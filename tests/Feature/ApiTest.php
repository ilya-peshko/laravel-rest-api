<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test customers list response.
     */
    public function test_v1_customers_list(): void
    {
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
    }

    /**
     * Test customers index response.
     */
    public function test_v1_customers_show(): void
    {
        $customer = Customer::factory()->create([
            'id'    => 10,
            'name'  => 'Gilbert Fisher',
            'email' => 'emilia.hoppe@spencer.biz',
            'city'  => 'West Althea',
        ]);

        $response = $this->get('/api/v1/customers/10');

        $response->assertOk();
        $response->assertJsonPath('data.id', fn ($id) => $id === $customer->id);
        $response->assertJsonPath('data.name', $customer->name);
    }

    /**
     * Test customers index response.
     */
    public function test_v1_customers_store(): void
    {
        $response = $this->post('/api/v1/customers', [
            'name'       => 'Gilbert Fisher',
            'type'       => 'Individual',
            'email'      => 'schultz.manuela@gmail.com',
            'address'    => '3801 Abernathy Ville Apt. 404',
            'city'       => 'East Lowell',
            'state'      => 'Queensland',
            'postalCode' => '43742-9054',
        ]);
        $response->assertOk();

        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseHas('customers', [
            'name' => 'Gilbert Fisher',
        ]);
    }

    /**
     * Test customers index response.
     */
    public function test_v1_customers_destroy(): void
    {
        $customer = Customer::factory()->create([
            'id'    => 10,
            'name'  => 'Gilbert Fisher',
            'email' => 'emilia.hoppe@spencer.biz',
            'city'  => 'West Althea',
        ]);

        $this->assertDatabaseHas('customers', [
            'id' => 10,
        ]);

        $this->delete("/api/v1/customers/{$customer->id}");
        $this->assertDatabaseMissing('customers', [
            'id' => 10,
        ]);
    }
}
