<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $permissions = [
            [ //1
                'name' => 'Add Permission',
                'slug' => 'add-permission'
            ],

            [//2
                'name' => 'Edit Permission',
                'slug' => 'edit-permission'
            ],

            [//3
                'name' => 'Delete Permission',
                'slug' => 'delete-permission'
            ],

            [//4
                'name' => 'Access Permission Page',
                'slug' => 'access-permission-page'
            ],

            [//5
                'name' => 'Add Role',
                'slug' => 'add-role'
            ],

            [//6
                'name' => 'Edit Role',
                'slug' => 'edit-role'
            ],

            [//7
                'name' => 'Delete Role',
                'slug' => 'delete-role'
            ],

            [//8
                'name' => 'Access Roles Page',
                'slug' => 'access-role-page'
            ],

            [//9
                'name' => 'Access Dashboard',
                'slug' => 'access-dashboard'
            ],

            [//10
                'name' => 'Access Category Page',
                'slug' => 'access-category-page'
            ],

            [//11
                'name' => 'Add Category',
                'slug' => 'add-category'
            ],

            [//12
                'name' => 'Delete Category',
                'slug' => 'delete-category'
            ],

            [//13
                'name' => 'Edit Category',
                'slug' => 'edit-category'
            ],

            [//14
                'name' => 'Access User Page',
                'slug' => 'access-user-page'
            ],

            [//15
                'name' => 'Add User',
                'slug' => 'add-user'
            ],

            [//16
                'name' => 'Delete User',
                'slug' => 'delete-user'
            ],

            [//17
                'name' => 'Edit User',
                'slug' => 'edit-user'
            ],

            [//18
                'name' => 'Access Site Setting Page',
                'slug' => 'access-site-setting-page'
            ],

            [//19
                'name' => 'Edit Site Setting',
                'slug' => 'edit-site-setting'
            ],

            [//20
                'name' => 'Change Category Status',
                'slug' => 'change-category-status'
            ],

            [//21
                'name' => 'Access Blog Page',
                'slug' => 'access-blog-page'
            ],

            [//22
                'name' => 'Add Blog',
                'slug' => 'add-blog'
            ],

            [//23
                'name' => 'Edit Blog',
                'slug' => 'edit-blog'
            ],

            [//24
                'name' => 'Delete Blog',
                'slug' => 'delete-blog'
            ],

            [//25
                'name' => 'Access Archive Blog List',
                'slug' => 'access-archive-blog-list'
            ],

            [//26
                'name' => 'Access Archive Category List',
                'slug' => 'access-archive-category-list'
            ],

            [//27
                'name' => 'Access Archive Blog Button',
                'slug' => 'access-archive-blog-button'
            ],

            [//28
                'name' => 'Access Archive Category Button',
                'slug' => 'access-archive-category-button'
            ],

        ];

        DB::table('permissions')->insert($permissions);
    }
}
