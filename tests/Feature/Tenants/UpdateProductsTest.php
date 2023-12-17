<?php

namespace Tests\Feature\Tenants;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateProductsTest extends TestCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    /** @test */
    public function guest_may_not_update_product()
    {
        $product = Product::factory()->create();

        $this->patch(tenantRoute('tenant.products.update', $product->slug))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_may_not_update_product()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $this->patch(tenantRoute('tenant.products.update', $product->slug))
            ->assertRedirect('/');
    }

    /** @test */
    public function owner_can_access_edit_product_page(): void
    {
        $this->signIn('owner');

        $product = Product::factory()->create();

        $this->get(tenantRoute('tenant.products.edit', $product->slug))
            ->assertOk();
    }

    /** @test */
    public function product_requires_name_and_description_to_be_updated(): void
    {
        $this->signIn('owner');

        $product = Product::factory()->create();

        $this->patch(tenantRoute('tenant.products.update', $product->slug), [
            Product::factory()->make([
                'name' => null,
                'description' => null,
            ]),
        ])
            ->assertSessionHasErrors('name')
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function owner_can_update_product(): void
    {
        $this->signIn('owner');

        $product = Product::factory()->create();

        $this->patch(tenantRoute('tenant.products.update', $product->slug), [
            'name' => 'new product name',
            'color' => 'New Red',
            'description' => $product->description,
            'price' => $product->price,
            'stock' => $product->stock,
            'category_id' => $product->category_id,
        ]);

        $this->get(tenantRoute('tenant.products.index'))
            ->assertSee('new product name')
            ->assertSee('New Red');
    }

    /** @test */
    public function old_image_should_be_deleted_after_product_is_updated(): void
    {
        $this->signIn('owner');

        Storage::fake('images');

        $file = UploadedFile::fake()->image('image.jpg');

        $product = Product::factory()->make([
            'image' => $file,
        ]);

        $this->post(tenantRoute('tenant.products.store'), $product->toArray());

        $newFile = UploadedFile::fake()->image('new-image.jpg');

        $this->patch(tenantRoute('tenant.products.update', Product::first()->slug), [
            'name' => 'new product name',
            'color' => 'New Red',
            'description' => $product->description,
            'image' => $newFile,
            'price' => $product->price,
            'stock' => $product->stock,
            'category_id' => $product->category_id,
        ]);

        Storage::disk('public')->assertExists(tenant('slug') . '/images/products/' . $newFile->hashName());
        
        Storage::disk('public')->assertMissing(tenant('slug') . '/images/products/' . $file->hashName());
    }
}
