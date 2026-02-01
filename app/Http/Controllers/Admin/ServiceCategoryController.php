<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of service categories
     */
    public function index(Request $request)
    {
        $query = ServiceCategory::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        $categories = $query->ordered()->paginate(15)->withQueryString();

        // Get counts for stats
        $stats = [
            'total' => ServiceCategory::count(),
            'active' => ServiceCategory::where('is_active', true)->count(),
            'inactive' => ServiceCategory::where('is_active', false)->count(),
        ];

        return Inertia::render('Admin/Services/Categories/Index', [
            'categories' => $categories,
            'stats' => $stats,
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    /**
     * Store a newly created category
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:service_categories'],
            'icon' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        ServiceCategory::create($validated);

        return redirect()->back()->with('success', 'Service category created successfully!');
    }

    /**
     * Update the specified category
     */
    public function update(Request $request, ServiceCategory $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:service_categories,slug,' . $category->id],
            'icon' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $category->update($validated);

        return redirect()->back()->with('success', 'Service category updated successfully!');
    }

    /**
     * Toggle category active status
     */
    public function toggleStatus(ServiceCategory $category)
    {
        $category->update([
            'is_active' => !$category->is_active
        ]);

        $status = $category->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Service category {$status} successfully!");
    }

    /**
     * Remove the specified category
     */
    public function destroy(ServiceCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.services.categories.index')->with('success', 'Service category deleted successfully!');
    }

    /**
     * Reorder categories
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'categories' => ['required', 'array'],
            'categories.*.id' => ['required', 'exists:service_categories,id'],
            'categories.*.order' => ['required', 'integer', 'min:0'],
        ]);

        foreach ($validated['categories'] as $categoryData) {
            ServiceCategory::where('id', $categoryData['id'])
                ->update(['order' => $categoryData['order']]);
        }

        return redirect()->back()->with('success', 'Categories reordered successfully!');
    }
}
