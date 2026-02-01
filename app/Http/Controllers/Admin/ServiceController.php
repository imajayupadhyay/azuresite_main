<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Display a listing of services
     */
    public function index(Request $request)
    {
        $query = Service::with('category');

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('service_category_id', $request->category_id);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        $services = $query->ordered()->paginate(15)->withQueryString();

        // Get categories for filter
        $categories = ServiceCategory::active()->ordered()->get();

        // Get counts for stats
        $stats = [
            'total' => Service::count(),
            'active' => Service::where('is_active', true)->count(),
            'inactive' => Service::where('is_active', false)->count(),
        ];

        return Inertia::render('Admin/Services/Index', [
            'services' => $services,
            'categories' => $categories,
            'stats' => $stats,
            'filters' => $request->only(['search', 'category_id', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new service
     */
    public function create()
    {
        $categories = ServiceCategory::active()->ordered()->get();
        
        return Inertia::render('Admin/Services/Create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created service
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_category_id' => ['required', 'exists:service_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:services'],
            'description' => ['required', 'string'],
            'icon_identifier' => ['nullable', 'string', 'max:100'],
            'icon_url' => ['nullable', 'url', 'max:500'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'video_thumbnail' => ['nullable', 'url', 'max:500'],
            'video_duration' => ['nullable', 'string', 'max:20'],
            'difficulty' => ['required', 'in:beginner,intermediate,advanced'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
            'tutorial_sections' => ['nullable', 'array'],
            'tutorial_sections.*.title' => ['required', 'string', 'max:255'],
            'tutorial_sections.*.slug' => ['nullable', 'string', 'max:255'],
            'tutorial_sections.*.order' => ['required', 'integer', 'min:0'],
            'tutorial_sections.*.is_active' => ['boolean'],
            'tutorial_sections.*.content_blocks' => ['nullable', 'array'],
            'tutorial_sections.*.content_blocks.*.type' => ['required', 'in:content,code,tip,warning,info'],
            'tutorial_sections.*.content_blocks.*.content' => ['required', 'string'],
            'tutorial_sections.*.content_blocks.*.code_language' => ['nullable', 'string', 'max:50'],
            'tutorial_sections.*.content_blocks.*.order' => ['required', 'integer', 'min:0'],
        ]);

        // Handle video upload if present
        if ($request->hasFile('video_file')) {
            $videoPath = $request->file('video_file')->store('videos', 'public');
            $validated['video_url'] = asset('storage/' . $videoPath);
        }

        // Handle video thumbnail upload if present
        if ($request->hasFile('video_thumbnail_file')) {
            $thumbnailPath = $request->file('video_thumbnail_file')->store('thumbnails', 'public');
            $validated['video_thumbnail'] = asset('storage/' . $thumbnailPath);
        }

        // Create service
        $service = Service::create($validated);

        // Create tutorial sections if provided
        if (!empty($validated['tutorial_sections'])) {
            foreach ($validated['tutorial_sections'] as $sectionData) {
                $contentBlocks = $sectionData['content_blocks'] ?? [];
                unset($sectionData['content_blocks']);
                
                $section = $service->tutorialSections()->create($sectionData);
                
                // Create content blocks for this section
                if (!empty($contentBlocks)) {
                    foreach ($contentBlocks as $blockData) {
                        $section->contentBlocks()->create($blockData);
                    }
                }
            }
        }

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully!');
    }

    /**
     * Show the form for editing the specified service
     */
    public function edit(Service $service)
    {
        $categories = ServiceCategory::active()->ordered()->get();
        
        // Load service with all tutorial sections and their content blocks
        $service->load([
            'category',
            'tutorialSections' => function ($query) {
                $query->ordered()->with(['contentBlocks' => function ($q) {
                    $q->ordered();
                }]);
            }
        ]);
        
        return Inertia::render('Admin/Services/Edit', [
            'service' => $service,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified service
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'service_category_id' => ['required', 'exists:service_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:services,slug,' . $service->id],
            'description' => ['required', 'string'],
            'icon_identifier' => ['nullable', 'string', 'max:100'],
            'icon_url' => ['nullable', 'url', 'max:500'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'video_thumbnail' => ['nullable', 'url', 'max:500'],
            'video_duration' => ['nullable', 'string', 'max:20'],
            'difficulty' => ['required', 'in:beginner,intermediate,advanced'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
            'tutorial_sections' => ['nullable', 'array'],
            'tutorial_sections.*.id' => ['nullable', 'exists:tutorial_sections,id'],
            'tutorial_sections.*.title' => ['required', 'string', 'max:255'],
            'tutorial_sections.*.slug' => ['nullable', 'string', 'max:255'],
            'tutorial_sections.*.order' => ['required', 'integer', 'min:0'],
            'tutorial_sections.*.is_active' => ['boolean'],
            'tutorial_sections.*.content_blocks' => ['nullable', 'array'],
            'tutorial_sections.*.content_blocks.*.id' => ['nullable', 'exists:tutorial_content_blocks,id'],
            'tutorial_sections.*.content_blocks.*.type' => ['required', 'in:content,code,tip,warning,info'],
            'tutorial_sections.*.content_blocks.*.content' => ['required', 'string'],
            'tutorial_sections.*.content_blocks.*.code_language' => ['nullable', 'string', 'max:50'],
            'tutorial_sections.*.content_blocks.*.order' => ['required', 'integer', 'min:0'],
            'deleted_sections' => ['nullable', 'array'],
            'deleted_sections.*' => ['exists:tutorial_sections,id'],
            'deleted_blocks' => ['nullable', 'array'],
            'deleted_blocks.*' => ['exists:tutorial_content_blocks,id'],
        ]);

        // Handle video upload if present
        if ($request->hasFile('video_file')) {
            $videoPath = $request->file('video_file')->store('videos', 'public');
            $validated['video_url'] = asset('storage/' . $videoPath);
        }

        // Handle video thumbnail upload if present
        if ($request->hasFile('video_thumbnail_file')) {
            $thumbnailPath = $request->file('video_thumbnail_file')->store('thumbnails', 'public');
            $validated['video_thumbnail'] = asset('storage/' . $thumbnailPath);
        }

        // Update service
        $service->update($validated);

        // Delete removed sections
        if (!empty($validated['deleted_sections'])) {
            \App\Models\TutorialSection::whereIn('id', $validated['deleted_sections'])->delete();
        }

        // Delete removed blocks
        if (!empty($validated['deleted_blocks'])) {
            \App\Models\TutorialContentBlock::whereIn('id', $validated['deleted_blocks'])->delete();
        }

        // Update or create tutorial sections
        if (!empty($validated['tutorial_sections'])) {
            foreach ($validated['tutorial_sections'] as $sectionData) {
                $contentBlocks = $sectionData['content_blocks'] ?? [];
                $sectionId = $sectionData['id'] ?? null;
                unset($sectionData['id'], $sectionData['content_blocks']);
                
                if ($sectionId) {
                    // Update existing section
                    $section = \App\Models\TutorialSection::find($sectionId);
                    $section->update($sectionData);
                } else {
                    // Create new section
                    $section = $service->tutorialSections()->create($sectionData);
                }
                
                // Update or create content blocks
                if (!empty($contentBlocks)) {
                    foreach ($contentBlocks as $blockData) {
                        $blockId = $blockData['id'] ?? null;
                        unset($blockData['id']);
                        
                        if ($blockId) {
                            // Update existing block
                            $block = \App\Models\TutorialContentBlock::find($blockId);
                            $block->update($blockData);
                        } else {
                            // Create new block
                            $section->contentBlocks()->create($blockData);
                        }
                    }
                }
            }
        }

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully!');
    }

    /**
     * Toggle service active status
     */
    public function toggleStatus(Service $service)
    {
        $service->update([
            'is_active' => !$service->is_active
        ]);

        $status = $service->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Service {$status} successfully!");
    }

    /**
     * Remove the specified service
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully!');
    }
}
