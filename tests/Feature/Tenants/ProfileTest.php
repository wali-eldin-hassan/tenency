<?php

namespace Tests\Feature\Tenants;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    public function test_profile_page_is_displayed_for_owners(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user, 'owner');

        $this->actingAs($user)
            ->get(tenantRoute('tenant.profile.edit'))
            ->assertOk();
    }

    /** @test */
    public function profile_page_is_should_not_be_displayed_for_users(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user);

        $this->actingAs($user)
            ->get(tenantRoute('tenant.profile.edit'))
            ->assertRedirect();
    }

    /** @test */
    public function profile_information_can_be_updated_by_owners(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user, 'owner');

        $this->actingAs($user)
            ->patch(tenantRoute('tenant.profile.update'), [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ])->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    /** @test */
    public function owners_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user, 'owner');

        $this->actingAs($user)
            ->delete(tenantRoute('tenant.profile.destroy'), [
                'password' => 'password',
            ])->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    /** @test */
    public function correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user, 'owner');

        $this->actingAs($user)
            ->from('/profile')
            ->delete(tenant_route(tenant('domain'), 'tenant.profile.destroy'), [
                'password' => 'wrong-password',
            ])->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}
