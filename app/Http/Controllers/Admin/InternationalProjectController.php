<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternationalProject;
use Illuminate\Http\Request;

class InternationalProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = InternationalProject::all();
        return view('admin.international-projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.international-projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        InternationalProject::create($request->all());

        return redirect()->route('admin.international-projects.index')->with('success', 'International Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InternationalProject $internationalProject)
    {
        $internationalProject->load('photos');
        return view('admin.international-projects.show', compact('internationalProject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InternationalProject $internationalProject)
    {
        return view('admin.international-projects.edit', compact('internationalProject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InternationalProject $internationalProject)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $internationalProject->update($request->all());

        return redirect()->route('admin.international-projects.index')->with('success', 'International Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternationalProject $internationalProject)
    {
        $internationalProject->delete();

        return redirect()->route('admin.international-projects.index')->with('success', 'International Project deleted successfully.');
    }
}
