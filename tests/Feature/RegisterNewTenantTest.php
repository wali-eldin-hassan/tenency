<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterNewTenantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function tenant_registeration_page_is_displayed()
    {
        $this->get('/register')->assertStatus(200);
    }

    /** @test */
    public function owner_and_tenant_created_successfully()
    {
        $this->post('/register', [
            'name' => 'Test User',
            'phone' => '12345678900',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'company' => 'hello',
            'domain' => 'hello',
        ])
            ->assertRedirect(tenant_route('hello.' . config('tenancy.central_domains')[0], 'tenant.login'));

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    /** @test */
    public function owner_should_belong_to_tenant_when_tenant_is_created()
    {
        $this->post('/register', [
            'name' => 'Test User',
            'phone' => '12345678900',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'company' => 'hello',
            'domain' => 'hello',
        ]);

        $this->assertDatabaseHas('tenant_user', [
            'tenant_id' => 1,
            'user_id' => 1,
            'role' => 'owner',
        ]);
    }
}
