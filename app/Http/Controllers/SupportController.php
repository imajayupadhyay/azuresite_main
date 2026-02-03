<?php

namespace App\Http\Controllers;

use App\Models\SupportSubmission;
use App\Models\SupportPageSection;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Display the support page
     */
    public function index()
    {
        // Fetch all active sections grouped by type
        $sections = SupportPageSection::active()->ordered()->get();
        
        $hero = $sections->where('section_type', 'hero')->first();
        $quickLinks = $sections->where('section_type', 'quick_link')->values();
        $contactInfo = $sections->where('section_type', 'contact_info')->values();
        $faqs = $sections->where('section_type', 'faq')->values();

        return inertia('Support/Index', [
            'hero' => $hero,
            'quickLinks' => $quickLinks,
            'contactInfo' => $contactInfo,
            'faqs' => $faqs,
        ]);
    }

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
