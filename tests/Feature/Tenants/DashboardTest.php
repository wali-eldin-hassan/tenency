<?php

namespace Tests\Feature\Tenants;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    /** @test */
    public function guest_may_not_access_dashboard(): void
    {
        $this->get(tenantRoute('tenant.dashboard'))
            ->assertRedirect();
    }

    /** @test */
    public function user_may_not_access_dashboard(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user);

        $this->actingAs($user)
            ->get(tenantRoute('tenant.dashboard'))
            ->assertRedirect();
    }

    /** @test */
    public function owner_can_access_dashboard(): void
    {
        $user = User::factory()->create();

        addUserToTenant($user, 'owner');

        $this->actingAs($user)
            ->get(tenantRoute('tenant.dashboard'))
            ->assertOk();
    }
}
