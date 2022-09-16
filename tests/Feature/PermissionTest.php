<?php

namespace Tests\Feature;

use App\Models\Admin\Permission;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{

    use RefreshDatabase;

    private $makePermission;

    protected function setUp(): void
    {
        parent::setUp();

        $this->isLoggedInAsAdmin();

        $this->makePermission = $this->post('admin/permissions', [
            'name' => 'test permission',
        ]);
    }

    /** @test */
    public function permission_can_be_created(): void
    {
        $response = $this->makePermission;
        $response->assertStatus(302);
        $response->assertSessionHas('success','Permission Created Successfully!');
        $this->assertDatabaseHas('permissions',[
           'name' => 'test permission'
        ]);
    }

    /** @test */
    public function permission_can_be_deleted(): void
    {
        //storing permission
        $this->makePermission;

        $this->assertDatabaseHas('permissions',[
            'name' => 'test permission'
        ]);

        //deleting stored permission
        $permission = Permission::latest()->first();
        $response = $permission->delete('/admin/permissions/' . $permission->id);

        $this->assertDatabaseMissing('permissions',[
            'name' => 'test permission'
        ]);

    }

    /** @test */
    public function permission_can_be_updated(): void
    {
        //storing permission
        $this->makePermission;

        //updating stored permission
        $permission = Permission::first();

        $response = $this->patch('/admin/permissions/' . $permission->id, [
            'name' => 'test permission updated',
        ])->assertStatus(302);

        $response->assertSessionHas('success','Permission updated Successfully!');

        $this->assertDatabaseHas('permissions',[
            'name' => 'test permission updated'
        ]);

        $this->assertNotEquals($permission->name, Permission::first()->name);

    }

    /** @test */
    public function permission_pages_are_visible(): void
    {
        $this->get(route('admin.permissions.index'))->assertStatus(200);
        $this->get(route('admin.permissions.create'))->assertStatus(200);
    }

    /** @test */
    public function slugs_are_created_automatically(): void
    {
        $this->post('admin/permissions', [
            'name' => 'My Permission',
        ])->assertStatus(302);

        $this->assertDatabaseHas('permissions',[
            'slug' => 'my-permission'
        ]);
    }

    /** @test */
    public function permission_cannot_be_accessed_via_non_admin_user(): void
    {
        $this->isLoggedIn();

        $this->get(route('admin.permissions.index'))->assertStatus(403);
    }

    /** @test */
    public function permission_can_be_accessed_via_admin_user(): void
    {
        $this->get(route('admin.permissions.index'))->assertStatus(200);
    }

}
