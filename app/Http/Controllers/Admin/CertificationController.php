<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\CertificationCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CertificationController extends Controller
{
    /**
     * Display a listing of certifications
     */
    public function index(Request $request)
    {
        $query = Certification::with('category');

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('certification_category_id', $request->category_id);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        $certifications = $query->ordered()->paginate(15)->withQueryString();

        // Get categories for filter
        $categories = CertificationCategory::active()->ordered()->get();

        // Get counts for stats
        $stats = [
            'total' => Certification::count(),
            'active' => Certification::where('is_active', true)->count(),
            'inactive' => Certification::where('is_active', false)->count(),
        ];

        return Inertia::render('Admin/Certifications/Index', [
            'certifications' => $certifications,
            'categories' => $categories,
            'stats' => $stats,
            'filters' => $request->only(['search', 'category_id', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new certification
     */
    public function create()
    {
        $categories = CertificationCategory::active()->ordered()->get();

        return Inertia::render('Admin/Certifications/Create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created certification
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'certification_category_id' => ['required', 'exists:certification_categories,id'],
            'code' => ['required', 'string', 'max:20', 'unique:certifications'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:certifications'],
            'description' => ['required', 'string'],
            'long_description' => ['nullable', 'string'],
            'level_color' => ['required', 'string', 'in:green,blue,purple,orange'],
            'exam_duration' => ['nullable', 'string', 'max:50'],
            'questions' => ['nullable', 'string', 'max:50'],
            'passing_score' => ['nullable', 'string', 'max:50'],
            'exam_cost' => ['nullable', 'string', 'max:50'],
            'duration' => ['nullable', 'string', 'max:50'],
            'last_updated' => ['nullable', 'string', 'max:50'],
            'prerequisites' => ['nullable', 'array'],
            'prerequisites.*' => ['string'],
            'target_audience' => ['nullable', 'array'],
            'target_audience.*' => ['string'],
            'modules' => ['nullable', 'array'],
            'modules.*.number' => ['required', 'integer'],
            'modules.*.title' => ['required', 'string'],
            'modules.*.duration' => ['nullable', 'string'],
            'modules.*.lessons' => ['nullable', 'array'],
            'skills' => ['nullable', 'array'],
            'skills.*.name' => ['required', 'string'],
            'skills.*.weight' => ['required', 'string'],
            'skills.*.topics' => ['nullable', 'array'],
            'resources' => ['nullable', 'array'],
            'resources.*.icon' => ['required', 'string'],
            'resources.*.title' => ['required', 'string'],
            'resources.*.description' => ['nullable', 'string'],
            'resources.*.url' => ['required', 'url'],
            'faqs' => ['nullable', 'array'],
            'faqs.*.question' => ['required', 'string'],
            'faqs.*.answer' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        Certification::create($validated);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification created successfully!');
    }

    /**
     * Show the form for editing the specified certification
     */
    public function edit(Certification $certification)
    {
        $categories = CertificationCategory::active()->ordered()->get();
        $certification->load('category');

        return Inertia::render('Admin/Certifications/Edit', [
            'certification' => $certification,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified certification
     */
    public function update(Request $request, Certification $certification)
    {
        $validated = $request->validate([
            'certification_category_id' => ['required', 'exists:certification_categories,id'],
            'code' => ['required', 'string', 'max:20', 'unique:certifications,code,' . $certification->id],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:certifications,slug,' . $certification->id],
            'description' => ['required', 'string'],
            'long_description' => ['nullable', 'string'],
            'level_color' => ['required', 'string', 'in:green,blue,purple,orange'],
            'exam_duration' => ['nullable', 'string', 'max:50'],
            'questions' => ['nullable', 'string', 'max:50'],
            'passing_score' => ['nullable', 'string', 'max:50'],
            'exam_cost' => ['nullable', 'string', 'max:50'],
            'duration' => ['nullable', 'string', 'max:50'],
            'last_updated' => ['nullable', 'string', 'max:50'],
            'prerequisites' => ['nullable', 'array'],
            'prerequisites.*' => ['string'],
            'target_audience' => ['nullable', 'array'],
            'target_audience.*' => ['string'],
            'modules' => ['nullable', 'array'],
            'modules.*.number' => ['required', 'integer'],
            'modules.*.title' => ['required', 'string'],
            'modules.*.duration' => ['nullable', 'string'],
            'modules.*.lessons' => ['nullable', 'array'],
            'skills' => ['nullable', 'array'],
            'skills.*.name' => ['required', 'string'],
            'skills.*.weight' => ['required', 'string'],
            'skills.*.topics' => ['nullable', 'array'],
            'resources' => ['nullable', 'array'],
            'resources.*.icon' => ['required', 'string'],
            'resources.*.title' => ['required', 'string'],
            'resources.*.description' => ['nullable', 'string'],
            'resources.*.url' => ['required', 'url'],
            'faqs' => ['nullable', 'array'],
            'faqs.*.question' => ['required', 'string'],
            'faqs.*.answer' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $certification->update($validated);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification updated successfully!');
    }

    /**
     * Toggle certification active status
     */
    public function toggleStatus(Certification $certification)
    {
        $certification->update([
            'is_active' => !$certification->is_active
        ]);

        $status = $certification->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Certification {$status} successfully!");
    }

    /**
     * Remove the specified certification
     */
    public function destroy(Certification $certification)
    {
        $certification->delete();

        return redirect()->route('admin.certifications.index')->with('success', 'Certification deleted successfully!');
    }
}
