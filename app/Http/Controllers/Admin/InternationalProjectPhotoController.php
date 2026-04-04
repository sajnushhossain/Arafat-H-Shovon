<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternationalProject;
use App\Models\InternationalProjectPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternationalProjectPhotoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, InternationalProject $internationalProject)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|string|max:255',
            'photo' => 'required|image|max:51200', // Max 50MB
        ]);

        $path = $request->file('photo')->store('international_projects', 'public');

        $internationalProject->photos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'url' => $this->formatUrl($request->url),
        ]);

        return redirect()->route('admin.international-projects.show', $internationalProject)->with('success', 'Photo uploaded successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternationalProject $internationalProject, InternationalProjectPhoto $photo)
    {
        // Delete photo from storage
        Storage::disk('public')->delete($photo->file_path);

        $photo->delete();

        return redirect()->route('admin.international-projects.show', $internationalProject)->with('success', 'Photo deleted successfully.');
    }

    /**
     * Format URL to ensure it has a protocol.
     */
    private function formatUrl($url)
    {
        if (!$url) return null;
        
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }
}
