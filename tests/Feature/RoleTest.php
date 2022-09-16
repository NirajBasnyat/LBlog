<?php

namespace Tests\Feature;

use App\Models\Admin\Role;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    private $makeRole;

    protected function setUp(): void
    {
        parent::setUp();

        $this->makeRole = $this->post('admin/roles',[
            'name' => 'test role',
            'permissions' => [1,2,4]
        ]);

        $this->isLoggedInAsAdmin();
    }

    /** @test */
    public function role_can_be_created(): void
    {
        $this->makeRole;

        $this->assertDatabaseHas('roles', [
            'name' => 'test role'
        ]);
    }

    /** @test */
    public function role_can_be_deleted(): void
    {
        $this->makeRole;

        //deleting stored role
        $role = Role::latest()->first();
        $role->delete('/admin/roles/' . $role->id);

        $this->assertDatabaseMissing('roles', [
            'name' => 'test role'
        ]);
    }

    /** @test */
    public function role_can_be_updated(): void
    {
        //storing role
        $this->makeRole;

        $role = Role::latest()->first();

        $this->patch('/admin/roles/'. $role->id,[
            'name' => 'test role updated',
            'permissions' => [1,3,5]
        ]);

        $this->assertNotEquals($role->name, Role::latest()->first()->name);
        $this->assertDatabaseMissing('roles', [
            'name' => 'test role'
        ]);
    }

    /** @test */
    public function role_pages_are_visible(): void
    {
        $this->get(route('admin.roles.index'))->assertStatus(200);
        $this->get(route('admin.roles.create'))->assertStatus(200);
    }

    /** @test */
    public function slugs_are_created_automatically(): void
    {
        $this->post('admin/roles', [
            'name' => 'My Role',
            'permissions' => [1,2,3,5]
        ])->assertStatus(302);

        $this->assertDatabaseHas('roles', [
            'slug' => 'my-role'
        ]);
    }

    /** @test */
    public function role_cannot_be_accessed_via_non_admin_user(): void
    {
        $this->isLoggedIn();

        $this->get(route('admin.roles.index'))->assertStatus(403);
    }

    /** @test */
    public function role_can_be_accessed_via_admin_user(): void
    {
        $this->get(route('admin.roles.index'))->assertStatus(200);
    }
}
