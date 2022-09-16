<?php

namespace Tests;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function isLoggedInAsAdmin()
    {
        $this->seed([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class
        ]);

        $admin = User::first();
        $admin->roles()->attach(1);

        $this->actingAs($admin);
    }

    public function isLoggedIn()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }

}
