<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Tenants\TenantSeeder;
use Database\Seeders\Tenants\ProductSeeder;
use Database\Seeders\Tenants\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Khatab Wedaa',
            'email' => 'khatabwedaa@gmail.com',
        ]);

        \App\Models\User::factory(23)->create();

        $this->call([
            TenantSeeder::class,
            ProductSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
