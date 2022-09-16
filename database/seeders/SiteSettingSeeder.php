<?php

namespace Database\Seeders;

use App\Models\Admin\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SiteSetting::create([
            'full_name' => 'Code Alchemy CMS',
            'short_name' => 'CodAl',
            'description' => 'This is a basic CMS designed by Niraj',
            'email' => 'niraj@mail.com',
            'footer_text' => '&copy; Code Alchemy Team',
            'phone_number' => '9800444217'
        ]);
    }
}
