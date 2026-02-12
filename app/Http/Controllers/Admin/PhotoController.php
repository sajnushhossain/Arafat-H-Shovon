<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Gallery $gallery)
    {
        $gallery->load('photos'); // Eager load photos
        return view('admin.photos.index', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Gallery $gallery)
    {
        return view('admin.photos.create', compact('gallery'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'required|image|max:51200', // Max 50MB
        ]);

        $path = $request->file('photo')->store('photos', 'public');

        $gallery->photos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
        ]);

        return redirect()->route('admin.galleries.show', $gallery)->with('success', 'Photo uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery, Photo $photo)
    {
        return view('admin.photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery, Photo $photo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:51200', // Max 50MB
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('photo')) {
            // Delete old photo
            Storage::disk('public')->delete($photo->file_path);

            $path = $request->file('photo')->store('photos', 'public');
            $data['file_path'] = $path;
        }

        $photo->update($data);

        return redirect()->route('admin.galleries.show', $photo->gallery)->with('success', 'Photo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery, Photo $photo)
    {
        // Delete photo from storage
        Storage::disk('public')->delete($photo->file_path);

        $photo->delete();

        return redirect()->route('admin.galleries.show', $photo->gallery)->with('success', 'Photo deleted successfully.');
    }
}
