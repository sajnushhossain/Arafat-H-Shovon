<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Gallery;
use App\Models\Portfolio;
use App\Models\Qualification;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        $achievements = Achievement::all();
        $qualifications = Qualification::all();
        $teamMembers = TeamMember::all();
        $testimonials = Testimonial::all();
        $galleries = Gallery::with('photos')->get();
        $portfolios = Portfolio::latest()->take(4)->get();
        $admin = User::find(1);


        return view('welcome', compact(
            'settings',
            'achievements',
            'qualifications',
            'teamMembers',
            'testimonials',
            'galleries',
            'portfolios',
            'admin'
        ));
    }
}
