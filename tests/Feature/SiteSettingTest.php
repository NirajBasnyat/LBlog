<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteSettingTest extends TestCase
{
    use RefreshDatabase;

    private $makeSiteSetting;

    //ADD THIS in TestCase

    //custom method created in TestCase to get logged_in user instance.
   /* public function isLoggedIn()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
    */

    protected function setUp(): void
    {
        parent::setUp();

        $this->makeSiteSetting = $this->post('site-settings', [
           'full_name'=>'test string',
            'short_name'=>'test string',
            'description'=>'some long string here',
            'email'=>'test string',
            'footer_text'=>'test string',
            'phone_number'=>'test string',
            
        ]);
    }

    /** @test */
    public function site_setting_can_be_created() :void
    {
        #Uncomment these if you have authentication system setup
        //$this->isLoggedIn();

        $response = $this->makeSiteSetting;
        $response->assertStatus(302);

        $this->assertCount(1, SiteSetting::all());
    }

    /** @test */
    public function site_setting_can_be_deleted() :void
    {
        //$this->isLoggedIn();

        //storing site_setting
        $this->makeSiteSetting;

        $this->assertCount(1, SiteSetting::all());

        //deleting stored site_setting
        $site_setting = SiteSetting::first();
        $site_setting->delete('/site-settings/' . $site_setting->id);

        $this->assertCount(0, SiteSetting::all());
    }

    /** @test */
    public function site_setting_can_be_updated() :void
    {
        //$this->isLoggedIn();

        //storing site_setting
        $this->makeSiteSetting;

        $this->assertCount(1, SiteSetting::all());

        //updating stored site_setting
        $site_setting = SiteSetting::first();

        $this->patch('/site-settings/' . $site_setting->id, [
            'full_name'=>'test string updated',
            'short_name'=>'test string updated',
            'description'=>'some long string updated here',
            'email'=>'test string updated',
            'footer_text'=>'test string updated',
            'phone_number'=>'test string updated',
            
        ])->assertStatus(302);

        $this->assertNotEquals($site_setting->full_name, SiteSetting::first()->full_name);

        $this->assertCount(1, SiteSetting::all());
    }

    /** @test */
    public function site_setting_pages_are_visible() :void
    {
        //$this->isLoggedIn();

        $this->get(route('site-settings.index'))->assertStatus(200);
        $this->get(route('site-settings.create'))->assertStatus(200);
    }

}
