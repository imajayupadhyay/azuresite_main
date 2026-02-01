<?php

namespace App\Http\Controllers;

use App\Models\SupportSubmission;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Store a new support submission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        SupportSubmission::create($validated);

        return redirect()->back()->with('success', 'Your support request has been submitted successfully! We will get back to you soon.');
    }
}
