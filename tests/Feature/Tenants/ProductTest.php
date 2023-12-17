<?php

namespace Tests\Feature\Tenants;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    /** @test */
    public function guest_may_not_access_products_page()
    {
        $this->get(tenantRoute('tenant.products.index'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_may_not_access_products_page()
    {
        $this->signIn();

        $this->get(tenantRoute('tenant.products.index'))
            ->assertRedirect('/');
    }

    /** @test */
    public function owner_can_access_products_page()
    {
        $this->signIn('owner');

        $this->get(tenantRoute('tenant.products.index'))
            ->assertOk();
    }

    /** @test */
    public function owner_can_delete_product()
    {
        $this->signIn('owner');

        $product = Product::factory()->create();

        $this->delete(tenantRoute('tenant.products.destroy', $product->slug))
            ->assertSessionHas('success', 'Product Deleted Successfully !');
    }
}
