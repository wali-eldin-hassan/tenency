<?php

namespace Tests\Feature\Tenants\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    /** @test */
    public function owner_can_update_their_password(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user, 'owner');

        $this
            ->actingAs($user)
            ->from('/profile')
            ->put(tenantRoute('tenant.password.update'), [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
    }

    /** @test */
    public function owner_must_provide_correct_password_to_update_password(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user, 'owner');

        $this
            ->actingAs($user)
            ->from('/profile')
            ->put(tenantRoute('tenant.password.update'), [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])->assertSessionHasErrorsIn('updatePassword', 'current_password')
            ->assertRedirect('/profile');
    }
}
