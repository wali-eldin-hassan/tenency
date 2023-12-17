<?php

namespace Tests;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $tenancy = false;

    public function setUp(): void
    {
        parent::setUp();

        if ($this->tenancy) {
            $this->initializeTenancy();
        }
    }

    public function initializeTenancy()
    {
        $tenant = Tenant::create([
            'domain' => 'hash.windstore.test',
            'company' => 'Hash',
        ]);

        $tenant->createDomain([
            'domain' => 'hash.windstore.test',
        ]);

        tenancy()->initialize($tenant);
    }

    protected function signIn($role = 'user')
    {
        $user = User::factory()->create();

        addUserToTenant($user, $role);

        $this->actingAs($user);

        return $this;
    }
}
