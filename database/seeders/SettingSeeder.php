<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'hero_title' => 'Capturing Moments, Creating Memories',
            'hero_subtitle' => 'The world through my lens. Explore my collection of photographs.',
            'about_me_text' => 'My name is Arafat H Shovon. I am a passionate photographer with a love for capturing the beauty of the world around me. My journey into photography started years ago, and since then, I\'ve been on a constant quest to find and frame moments that tell a story.',
            'skills_list' => 'Portrait Photography, Landscape Photography, Event Photography, Advanced Photo Editing',
            'contact_email' => 'contact@arafatshovon.com',
            'contact_phone' => '+1 234 567 890',
            'facebook_link' => '#',
            'instagram_link' => '#',
            'twitter_link' => '#',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}