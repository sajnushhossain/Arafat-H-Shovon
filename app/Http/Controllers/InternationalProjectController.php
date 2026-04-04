<?php

namespace App\Http\Controllers;

use App\Models\InternationalProject;
use Illuminate\Http\Request;

class InternationalProjectController extends Controller
{
    public function show(InternationalProject $internationalProject)
    {
        $internationalProject->load('photos');
        return view('international-projects.show', compact('internationalProject'));
    }
}
