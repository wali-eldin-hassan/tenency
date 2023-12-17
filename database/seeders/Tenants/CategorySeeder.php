<?php

namespace Database\Seeders\Tenants;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Men',
                'slug' => 'men',
                'tenant_id' => 1,
                'title' => 'Summer styles for Men',
                'image_path' => 'https://images.unsplash.com/photo-1479064555552-3ef4979f8908?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'women',
                'slug' => 'women',
                'tenant_id' => 1,
                'title' => 'Women Summer styles',
                'image_path' => 'https://images.unsplash.com/photo-1509319117193-57bab727e09d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Backpack',
                'slug' => 'backpack',
                'tenant_id' => 1,
                'title' => 'Backpack for Work and traveling',
                'image_path' => 'https://images.unsplash.com/photo-1494726161322-5360d4d0eeae?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
