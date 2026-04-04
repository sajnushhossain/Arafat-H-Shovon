<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Education;
use App\Models\Language;
use App\Models\Reference;
use App\Models\Skill;
use App\Models\Software;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        $education = Education::latest()->get();
        $languages = Language::all();
        $references = Reference::all();
        $skills = Skill::all();
        $softwares = Software::all();
        
        return view('about-myself', compact('settings', 'education', 'languages', 'references', 'skills', 'softwares'));
    }
}