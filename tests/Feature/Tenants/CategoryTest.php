<?php

namespace Tests\Feature\Tenants;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    /** @test */
    public function guest_may_not_access_categories_page()
    {
        $this->get(tenantRoute('tenant.categories.index'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_may_not_access_categories_page()
    {
        $this->signIn();

        $this->get(tenantRoute('tenant.categories.index'))
            ->assertRedirect('/');
    }

    /** @test */
    public function owner_can_access_categories_page()
    {
        $this->signIn('owner');

        $this->get(tenantRoute('tenant.categories.index'))
            ->assertOk();
    }

    /** @test */
    public function owner_can_delete_product()
    {
        $this->signIn('owner');

        $category = Category::factory()->create();

        $this->delete(tenantRoute('tenant.categories.destroy', $category->slug))
            ->assertSessionHas('success', 'Category Deleted Successfully !');
    }
}
