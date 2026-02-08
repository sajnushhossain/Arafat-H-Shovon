<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // For now, we'll just redirect back with a success message.
        // In a real application, you would send an email here.

        return redirect()->back()->with('success', 'Thank you for your message! I will get back to you soon.');
    }
}