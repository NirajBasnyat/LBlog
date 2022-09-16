<?php

namespace Tests\Feature;

use App\Models\Admin\Category;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private \Illuminate\Testing\TestResponse $makeCategory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->isLoggedInAsAdmin();

        $this->makeCategory = $this->post('admin/categories', [
            'name' => 'test string',
            'is_active' => 1,
        ]);
    }

    /** @test */
    public function category_can_be_created(): void
    {
        $response = $this->makeCategory;
        $response->assertStatus(302);

        $this->assertCount(1, Category::all());
    }

    /** @test */
    public function category_can_be_deleted(): void
    {
        //storing category

        $this->assertCount(1, Category::all());

        //deleting stored category
        $category = Category::first();
        $category->delete('admin/categories/' . $category->id);

        $this->assertCount(0, Category::all());
    }

    /** @test */
    public function category_can_be_updated(): void
    {
        //storing category

        $this->assertCount(1, Category::all());

        //updating stored category
        $category = Category::first();

        $this->patch('admin/categories/' . $category->id, [
            'name' => 'test string updated',
            'is_active' => 0,
        ])->assertStatus(302);

        $this->assertNotEquals($category->name, Category::first()->name);

        $this->assertCount(1, Category::all());
    }

    /** @test */
    public function category_pages_are_visible(): void
    {
        $this->get(route('admin.categories.index'))->assertStatus(200);
        $this->get(route('admin.categories.create'))->assertStatus(200);
    }

    /** @test */
    public function category_cannot_be_accessed_via_non_admin_user(): void
    {
        $this->isLoggedIn();

        $this->get(route('admin.categories.index'))->assertStatus(403);
    }

    /** @test */
    public function category_can_be_accessed_via_admin_user(): void
    {
        $this->get(route('admin.categories.index'))->assertStatus(200);
    }

    /** @test */
    public function slugs_are_created_automatically(): void
    {
        $this->post('admin/categories', [
            'name' => 'My Category',
            'status' => 1
        ])->assertStatus(302);

        $this->assertCount(2, Category::all());

        $this->assertDatabaseHas('categories',[
            'slug' => 'my-category'
        ]);
    }

}
