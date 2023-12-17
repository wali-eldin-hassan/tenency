<?php

namespace Tests\Feature\Tenants\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    /** @test */
    public function login_screen_can_be_rendered_for_tenant(): void
    {
        $this->get(tenantRoute('tenant.login'))
            ->assertStatus(200);
    }

    /** @test */
    public function users_belong_to_tenant_can_authenticate_using_tenant_login_screen(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user);

        $this->post(tenantRoute('tenant.login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(RouteServiceProvider::HOME);

        $this->assertAuthenticated();
    }

    /** @test */
    public function users_not_belong_to_tenant_can_not_authenticate_using_tenant_login_screen(): void
    {
        $user = User::factory()->create();

        $this->post(tenantRoute('tenant.login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    /** @test */
    public function users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user);

        $this->post(tenantRoute('tenant.login.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
