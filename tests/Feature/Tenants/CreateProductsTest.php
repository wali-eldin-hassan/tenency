<?php

namespace Tests\Feature\Tenants;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProductsTest extends TestCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    /** @test */
    public function guest_may_not_create_product()
    {
        $this->post(tenantRoute('tenant.products.store'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_may_not_create_product()
    {
        $this->signIn();

        $this->post(tenantRoute('tenant.products.store'))
            ->assertRedirect();
    }

    /** @test */
    public function owner_can_access_create_product_page(): void
    {
        $this->signIn('owner');

        $this->get(tenantRoute('tenant.products.create'))
            ->assertOk();
    }

    /** @test */
    public function product_requires_name_description_and_image(): void
    {
        $this->signIn('owner');

        $this->post(tenantRoute('tenant.products.store'), [
            Product::factory()->make([
                'name' => null,
                'description' => null,
                'image' => null,
            ]),
        ])
            ->assertSessionHasErrors('name')
            ->assertSessionHasErrors('description')
            ->assertSessionHasErrors('image');
    }

    /** @test */
    public function owner_can_create_product(): void
    {
        $this->signIn('owner');

        Storage::fake('images');

        $file = UploadedFile::fake()->image('image.jpg');

        $product = Product::factory()->make([
            'image' => $file,
        ]);

        $this->post(tenantRoute('tenant.products.store'), $product->toArray());

        $this->get(tenantRoute('tenant.products.index'))
            ->assertSee($product->name)
            ->assertSee($product->color);

        $this->assertDatabaseCount('products', 1);
    }

    /** @test */
    public function image_should_be_uploaded_to_storage_after_product_is_created(): void
    {
        $this->signIn('owner');

        Storage::fake('images');

        $file = UploadedFile::fake()->image('image.jpg');

        $product = Product::factory()->make([
            'image' => $file,
        ]);

        $this->post(tenantRoute('tenant.products.store'), $product->toArray());

        Storage::disk('public')->assertExists(tenant('slug') . '/images/products/' . $file->hashName());
    }
}
