<?php

namespace Database\Seeders\Tenants;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::create([
            'company' => 'Hash',
            'domain' => 'hash.' . env('APP_DOMAIN'),
            'email' => 'test@example.com',
            'approved' => true,
        ]);

        $tenant->createDomain([
            'domain' => 'hash' . '.' . env('APP_DOMAIN'),
        ]);

        DB::table('tenant_user')->insert([
            [
                'tenant_id' => 1,
                'user_id' => 1,
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 2,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 3,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 4,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 5,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 6,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id' => 1,
                'user_id' => 7,
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 8,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 9,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 10,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 11,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 12,
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 13,
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 14,
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 15,
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 16,
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tenant_id' => 1,
                'user_id' => 17,
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
