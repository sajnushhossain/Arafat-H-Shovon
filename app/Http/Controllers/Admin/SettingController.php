<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\AboutPhoto;
use App\Models\Education;
use App\Models\Language;
use App\Models\Reference;
use App\Models\Skill;
use App\Models\Software;
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
        $aboutPhotos = AboutPhoto::orderBy('sort_order')->get();
        $education = Education::latest()->get();
        $languages = Language::all();
        $references = Reference::all();
        $skills = Skill::all();
        $softwares = Software::all();
        return view('admin.settings.edit', compact('settings', 'aboutPhotos', 'education', 'languages', 'references', 'skills', 'softwares'));
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

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }

    public function storeEducation(Request $request)
    {
        $request->validate([
            'year' => 'required|string',
            'degree' => 'required|string',
            'institution' => 'required|string',
        ]);
        Education::create($request->all());
        return back()->with('success', 'Education added successfully.');
    }

    public function destroyEducation(Education $education)
    {
        $education->delete();
        return back()->with('success', 'Education deleted.');
    }

    public function storeLanguage(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'level' => 'required|string',
        ]);
        Language::create($request->all());
        return back()->with('success', 'Language added successfully.');
    }

    public function destroyLanguage(Language $language)
    {
        $language->delete();
        return back()->with('success', 'Language deleted.');
    }

    public function storeReference(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'contact' => 'required|string',
        ]);
        Reference::create($request->all());
        return back()->with('success', 'Reference added successfully.');
    }

    public function destroyReference(Reference $reference)
    {
        $reference->delete();
        return back()->with('success', 'Reference deleted.');
    }

    public function storeSkill(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'percentage' => 'required|integer|min:0|max:100',
        ]);
        Skill::create($request->all());
        return back()->with('success', 'Skill added successfully.');
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill deleted.');
    }

    public function storeSoftware(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'icon' => 'nullable|string',
        ]);
        Software::create($request->all());
        return back()->with('success', 'Software added successfully.');
    }

    public function destroySoftware(Software $software)
    {
        $software->delete();
        return back()->with('success', 'Software deleted.');
    }

    /**
     * Store new about photos.
     */
    public function storeAboutPhoto(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|max:10240',
        ]);

        if ($request->hasFile('images')) {
            $maxSort = AboutPhoto::max('sort_order') ?? 0;
            foreach ($request->file('images') as $image) {
                $path = $image->store('about_photos', 'public');
                AboutPhoto::create([
                    'image_path' => $path,
                    'sort_order' => ++$maxSort,
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully.');
    }

    /**
     * Remove an about photo.
     */
    public function destroyAboutPhoto(AboutPhoto $aboutPhoto)
    {
        if (Storage::disk('public')->exists($aboutPhoto->image_path)) {
            Storage::disk('public')->delete($aboutPhoto->image_path);
        }
        $aboutPhoto->delete();

        return back()->with('success', 'Image deleted successfully.');
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
