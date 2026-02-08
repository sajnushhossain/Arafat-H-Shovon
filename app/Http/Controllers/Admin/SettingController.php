<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.edit', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->except('_token', '_method');

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }

    /**
     * Update the authenticated admin's profile picture.
     */
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'cropped_image_data' => 'required|string|min:250', // Expecting base64 string with a minimum length
        ]);

        $user = Auth::user();
        $imageData = $request->input('cropped_image_data');

        if ($imageData) {
            Log::info('Cropped image data received for profile picture.', ['data_length' => strlen($imageData)]);

            // Decode the base64 image data
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
            $imageData = str_replace('data:image/gif;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $decodedImage = base64_decode($imageData);

            if ($decodedImage === false) {
                Log::error('Failed to base64 decode profile picture image data.');
                return back()->with('error', 'Failed to decode image data.');
            }
            Log::info('Profile picture image data successfully decoded.');

            // Determine file extension
            $extension = 'png'; // Default to png
            if (preg_match('/^data:image\/(\w+);base64,/', $request->input('cropped_image_data'), $matches)) {
                $extension = strtolower($matches[1]);
            }


            // Delete old profile picture if exists and is not a default asset
            if ($user->profile_picture_url && !Str::contains($user->profile_picture_url, 'default_profile.png')) {
                $oldPath = str_replace('/storage/', '', $user->profile_picture_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                    Log::info('Deleted old profile picture.', ['path' => $oldPath]);
                }
            }

            $fileName = 'profile-pictures/' . Str::uuid() . '.' . $extension;
            if (Storage::disk('public')->put($fileName, $decodedImage)) {
                Log::info('Profile picture saved to storage.', ['path' => $fileName]);
                $user->profile_picture_url = '/storage/' . $fileName;
                $user->save();
                Log::info('User profile_picture_url updated in database.');
            } else {
                Log::error('Failed to save profile picture to storage.', ['path' => $fileName]);
                return back()->with('error', 'Failed to save profile picture.');
            }
        }

        return back()->with('success', 'Profile picture updated successfully.');
    }

    /**
     * Update the "about me" section picture.
     */
    public function updateAboutMePicture(Request $request)
    {
        Log::info('updateAboutMePicture called.', ['request_data' => $request->all()]);

        $request->validate([
            'cropped_image_data' => 'required|string', // Expecting base64 string
        ]);

        $imageData = $request->input('cropped_image_data');

        if ($imageData) {
            Log::info('Cropped image data received for about me picture.', ['data_length' => strlen($imageData)]);

            // Decode the base64 image data
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
            $imageData = str_replace('data:image/gif;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $decodedImage = base64_decode($imageData);

            if ($decodedImage === false) {
                Log::error('Failed to base64 decode about me picture image data.');
                return back()->with('error', 'Failed to decode image data.');
            }
            Log::info('About me picture image data successfully decoded.');

            // Determine file extension
            $extension = 'png'; // Default to png
            if (preg_match('/^data:image\/(\w+);base64,/', $request->input('cropped_image_data'), $matches)) {
                $extension = strtolower($matches[1]);
            }


            $setting = Setting::where('key', 'about_me_picture_url')->first();
            // Delete old about me picture if exists and is not a default asset
            if ($setting && $setting->value && !Str::contains($setting->value, 'default_about_me.png')) {
                $oldPath = str_replace('/storage/', '', $setting->value);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                    Log::info('Deleted old about me picture.', ['path' => $oldPath]);
                }
            }

            $fileName = 'about-me-pictures/' . Str::uuid() . '.' . $extension;
            if (Storage::disk('public')->put($fileName, $decodedImage)) {
                Setting::updateOrCreate(
                    ['key' => 'about_me_picture_url'],
                    ['value' => '/storage/' . $fileName]
                );
                Log::info('About me picture saved to storage and URL updated in database.', ['path' => $fileName]);
            } else {
                Log::error('Failed to save about me picture to storage.', ['path' => $fileName]);
                return back()->with('error', 'Failed to save about me picture.');
            }
        }

        return back()->with('success', 'About Me picture updated successfully.');
    }
}