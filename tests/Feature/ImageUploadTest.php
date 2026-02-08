<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Setting;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create an admin user
    $this->admin = User::factory()->create([
        'is_super_admin' => true,
    ]);
});

test('admin can upload profile picture', function () {
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    Storage::fake('public');

    $this->actingAs($this->admin);

    $file = UploadedFile::fake()->image('profile.jpg', 600, 600);
    $base64Image = 'data:image/jpeg;base64,' . base64_encode($file->get());

    $response = $this->from(route('admin.dashboard'))->post(route('admin.profile.updateProfilePicture'), [
        'cropped_image_data' => $base64Image,
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Profile picture updated successfully.');

    $this->admin->refresh();
    expect($this->admin->profile_picture_url)->not->toBeNull();
    Storage::disk('public')->assertExists(str_replace('/storage/', '', $this->admin->profile_picture_url));

    // Test updating the profile picture and deleting the old one
    $old_path = $this->admin->profile_picture_url;

    $file2 = UploadedFile::fake()->image('profile2.jpg', 600, 600);
    $base64Image2 = 'data:image/jpeg;base64,' . base64_encode($file2->get());

    $this->from(route('admin.dashboard'))->post(route('admin.profile.updateProfilePicture'), [
        'cropped_image_data' => $base64Image2,
        '_token' => csrf_token(),
    ]);

    $this->admin->refresh();
    expect($this->admin->profile_picture_url)->not->toBeNull()
        ->and($this->admin->profile_picture_url)->not->toEqual($old_path);

    Storage::disk('public')->assertMissing(str_replace('/storage/', '', $old_path));
    Storage::disk('public')->assertExists(str_replace('/storage/', '', $this->admin->profile_picture_url));
});

test('admin can upload about me picture', function () {
    $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    Storage::fake('public');

    $this->actingAs($this->admin);

    $file = UploadedFile::fake()->image('about.jpg', 1600, 900);
    $base64Image = 'data:image/jpeg;base64,' . base64_encode($file->get());

    $response = $this->from(route('admin.dashboard'))->post(route('admin.settings.updateAboutMePicture'), [
        'cropped_image_data' => $base64Image,
        '_token' => csrf_token(),
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'About Me picture updated successfully.');

    $setting = Setting::where('key', 'about_me_picture_url')->first();
    expect($setting)->not->toBeNull()
        ->and($setting->value)->not->toBeNull();

    Storage::disk('public')->assertExists(str_replace('/storage/', '', $setting->value));

    // Test updating the about me picture and deleting the old one
    $old_path = $setting->value;

    $file2 = UploadedFile::fake()->image('about2.jpg', 1600, 900);
    $base64Image2 = 'data:image/jpeg;base64,' . base64_encode($file2->get());

    $this->from(route('admin.dashboard'))->post(route('admin.settings.updateAboutMePicture'), [
        'cropped_image_data' => $base64Image2,
        '_token' => csrf_token(),
    ]);

    $setting->refresh();
    expect($setting->value)->not->toBeNull()
        ->and($setting->value)->not->toEqual($old_path);

    Storage::disk('public')->assertMissing(str_replace('/storage/', '', $old_path));
    Storage::disk('public')->assertExists(str_replace('/storage/', '', $setting->value));
});
