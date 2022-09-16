<?php

namespace Database\Seeders;

use App\Models\Admin\Role;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'admin'
            ],

            [
                'name' => 'Author',
                'slug' => 'author'
            ],
        ];

        DB::table('roles')->insert($roles);

        Role::first()->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]);

        Role::skip(1)->take(1)->first()->permissions()->attach([4, 8, 9, 10, 14]);

    }
}
