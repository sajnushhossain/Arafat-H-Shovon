<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Gallery;
use App\Models\Photo;
use App\Models\User;
use App\Models\Setting;

uses(RefreshDatabase::class);

test('portfolio section is displayed with photos', function () {
    // Create an admin user
    $admin = User::factory()->create([
        'is_super_admin' => true,
    ]);
    
    // Create necessary settings
    Setting::create(['key' => 'hero_title', 'value' => 'Test Hero Title']);
    Setting::create(['key' => 'hero_subtitle', 'value' => 'Test Hero Subtitle']);
    Setting::create(['key' => 'about_me_text', 'value' => 'Test About Me Text']);
    Setting::create(['key' => 'skills_list', 'value' => 'Skill1,Skill2']);
    Setting::create(['key' => 'facebook_link', 'value' => 'https://facebook.com/test']);
    Setting::create(['key' => 'instagram_link', 'value' => 'https://instagram.com/test']);
    Setting::create(['key' => 'twitter_link', 'value' => 'https://twitter.com/test']);
    Setting::create(['key' => 'contact_phone', 'value' => '123-456-7890']);
    Setting::create(['key' => 'contact_email', 'value' => 'test@example.com']);

    // Create a gallery with photos
    $gallery = Gallery::factory()->create();
    $photos = Photo::factory()->count(5)->create(['gallery_id' => $gallery->id]);

    // Visit the homepage
    $response = $this->get(route('home'));

    // Assert that the response is successful
    $response->assertStatus(200);

    // Assert that the portfolio section is visible
    $response->assertSee('Portfolio');

    // Assert that the photos are visible
    foreach ($photos as $photo) {
        $response->assertSee(e($photo->title));
    }
});
