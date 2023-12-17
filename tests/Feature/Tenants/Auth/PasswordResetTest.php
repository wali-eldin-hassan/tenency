<?php

namespace Tests\Feature\Tenants\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    /** @test */
    public function reset_password_link_screen_can_be_rendered_for_tenant(): void
    {
        $this->get(tenantRoute('tenant.password.request'))->assertStatus(200);
    }

    /** @test */
    public function reset_password_link_can_be_requested(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        addUserToTenant($user);

        $this->post(tenantRoute('tenant.password.email'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    /** @test */
    public function reset_password_screen_can_be_rendered(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        addUserToTenant($user);

        $this->post(tenantRoute('tenant.password.email'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $this->get('/reset-password/'.$notification->token)
                ->assertStatus(200);

            return true;
        });
    }

    /** @test */
    public function password_can_be_reset_with_valid_token(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        addUserToTenant($user);

        $this->post(tenantRoute('tenant.password.email'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ])->assertSessionHasNoErrors();

            return true;
        });
    }
}
