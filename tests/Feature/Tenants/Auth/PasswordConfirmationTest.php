<?php

namespace Tests\Feature\Tenants\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    /** @test */
    public function confirm_password_screen_can_be_rendered_for_tenant(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user);

        $response = $this->actingAs($user)->get(tenantRoute('tenant.password.confirm'));

        $response->assertStatus(200);
    }

    /** @test */
    public function password_can_be_confirmed(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user);

        $this->actingAs($user)->post(tenantRoute('tenant.password.confirm.store'), [
            'password' => 'password',
        ])->assertRedirect()
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function password_is_not_confirmed_with_invalid_password(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user);

        $this->actingAs($user)->post(tenantRoute('tenant.password.confirm.store'), [
            'password' => 'wrong-password',
        ])->assertSessionHasErrors();
    }
}
