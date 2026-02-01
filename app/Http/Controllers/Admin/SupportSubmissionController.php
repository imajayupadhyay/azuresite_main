<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportSubmission;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupportSubmissionController extends Controller
{
    /**
     * Display a listing of support submissions
     */
    public function index(Request $request)
    {
        $query = SupportSubmission::query();

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Search by name, email, or subject
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $submissions = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Get counts for stats
        $stats = [
            'total' => SupportSubmission::count(),
            'pending' => SupportSubmission::where('status', 'pending')->count(),
            'in_progress' => SupportSubmission::where('status', 'in_progress')->count(),
            'resolved' => SupportSubmission::where('status', 'resolved')->count(),
        ];

        return Inertia::render('Admin/Support/Index', [
            'submissions' => $submissions,
            'stats' => $stats,
            'filters' => $request->only(['status', 'category', 'search']),
        ]);
    }

    /**
     * Display the specified submission
     */
    public function show(SupportSubmission $submission)
    {
        return Inertia::render('Admin/Support/Show', [
            'submission' => $submission,
        ]);
    }

    /**
     * Update the specified submission
     */
    public function update(Request $request, SupportSubmission $submission)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'admin_notes' => 'nullable|string',
        ]);

        $submission->update($validated);

        return redirect()->back()->with('success', 'Support submission updated successfully!');
    }

    /**
     * Remove the specified submission
     */
    public function destroy(SupportSubmission $submission)
    {
        $submission->delete();

        return redirect()->route('admin.support.index')->with('success', 'Support submission deleted successfully!');
    }
}
