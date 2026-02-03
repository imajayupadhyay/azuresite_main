<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportPageSection;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SupportPageController extends Controller
{
    /**
     * Display the support page sections management.
     */
    public function index(): Response
    {
        $sections = SupportPageSection::ordered()->get();
        
        // Group sections by type for better organization
        $groupedSections = $sections->groupBy('section_type');

        return Inertia::render('Admin/SupportPage/Index', [
            'sections' => $sections,
            'groupedSections' => $groupedSections,
            'sectionTypes' => $this->getSectionTypes(),
        ]);
    }

    /**
     * Store a new section.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_type' => 'required|string',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'link_url' => 'nullable|string|max:255',
            'link_text' => 'nullable|string|max:255',
            'color_scheme' => 'nullable|string|max:255',
            'data' => 'nullable|array',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Set sort_order to last if not provided
        if (!isset($validated['sort_order'])) {
            $validated['sort_order'] = SupportPageSection::where('section_type', $validated['section_type'])
                ->max('sort_order') + 1;
        }

        SupportPageSection::create($validated);

        return redirect()->back()->with('success', 'Section created successfully.');
    }

    /**
     * Update an existing section.
     */
    public function update(Request $request, SupportPageSection $section)
    {
        $validated = $request->validate([
            'section_type' => 'required|string',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'link_url' => 'nullable|string|max:255',
            'link_text' => 'nullable|string|max:255',
            'color_scheme' => 'nullable|string|max:255',
            'data' => 'nullable|array',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $section->update($validated);

        return redirect()->back()->with('success', 'Section updated successfully.');
    }

    /**
     * Delete a section.
     */
    public function destroy(SupportPageSection $section)
    {
        $section->delete();

        return redirect()->back()->with('success', 'Section deleted successfully.');
    }

    /**
     * Toggle section active status.
     */
    public function toggleActive(SupportPageSection $section)
    {
        $section->update(['is_active' => !$section->is_active]);

        return redirect()->back()->with('success', 'Section status updated successfully.');
    }

    /**
     * Update sections sort order.
     */
    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'sections' => 'required|array',
            'sections.*.id' => 'required|exists:support_page_sections,id',
            'sections.*.sort_order' => 'required|integer',
        ]);

        foreach ($validated['sections'] as $sectionData) {
            SupportPageSection::where('id', $sectionData['id'])
                ->update(['sort_order' => $sectionData['sort_order']]);
        }

        return redirect()->back()->with('success', 'Order updated successfully.');
    }

    /**
     * Get available section types with descriptions.
     */
    private function getSectionTypes(): array
    {
        return [
            [
                'value' => 'hero',
                'label' => 'Hero Section',
                'description' => 'Main banner section with title and subtitle',
            ],
            [
                'value' => 'quick_link',
                'label' => 'Quick Link',
                'description' => 'Quick navigation link with icon',
            ],
            [
                'value' => 'contact_info',
                'label' => 'Contact Information',
                'description' => 'Email, social media, or other contact details',
            ],
            [
                'value' => 'faq',
                'label' => 'FAQ Item',
                'description' => 'Frequently asked question with answer',
            ],
        ];
    }
}
