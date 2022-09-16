<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '123@admin',
            'email_verified_at' => now(),
        ]);

        $user2 = User::create([
            'name' => 'Author',
            'email' => 'author@mail.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);


        $user1->roles()->attach([1]); //admin_role
        $user2->roles()->attach([2]); //author_role

        $user1->permissions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28]);
        $user2->permissions()->attach([9, 10, 14, 21, 22, 23, 24]);
    }
}
