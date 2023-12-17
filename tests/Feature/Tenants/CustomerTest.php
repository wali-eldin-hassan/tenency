<?php

namespace Tests\Feature\Tenants;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    /** @test */
    public function guest_may_not_access_customers_page()
    {
        $this->get(tenantRoute('tenant.customers.index'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_may_not_access_customers_page()
    {
        $this->signIn();

        $this->get(tenantRoute('tenant.customers.index'))
            ->assertRedirect('/');
    }

    /** @test */
    public function owner_can_access_customers_page()
    {
        $this->signIn('owner');

        $this->get(tenantRoute('tenant.customers.index'))
            ->assertOk();
    }

    /** @test */
    public function customer_name_email_and_role_should_be_visible()
    {
        $this->signIn('owner');

        $user = User::factory()->create();

        addUserToTenant($user);

        $user_tenant = $user->tenants->find(tenant('id'));

        $this->get(tenantRoute('tenant.customers.index'))
            ->assertSee($user->name)
            ->assertSee($user->email)
            ->assertSee($user_tenant->pivot->role);
    }

    /** @test */
    public function role_attribute_is_requires_to_update_user_role(): void
    {
        $this->signIn('owner');

        $user = User::factory()->create();

        addUserToTenant($user);

        $this->patch(tenantRoute('tenant.customers.update', $user->id), [
            'role' => null,
        ])->assertSessionHasErrors('role');
    }

    /** @test */
    public function owner_can_update_customer_role()
    {
        $this->signIn('owner');

        $user = User::factory()->create();

        addUserToTenant($user);

        $this->patch(tenantRoute('tenant.customers.update', $user->id), [
            'role' => 'owner',
        ]);

        $user_tenant = $user->fresh()->tenants->find(tenant('id'));

        $this->assertEquals($user_tenant->pivot->role, 'owner');

        $this->patch(tenantRoute('tenant.customers.update', $user->id), [
            'role' => 'user',
        ]);

        $user_tenant = $user->fresh()->tenants->find(tenant('id'));

        $this->assertEquals($user_tenant->pivot->role, 'user');
    }
}
