<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsletterSubscriptionController extends Controller
{
    /**
     * Display a listing of newsletter subscriptions
     */
    public function index(Request $request)
    {
        $query = NewsletterSubscription::query();

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search by email
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('email', 'like', "%{$search}%");
        }

        $subscriptions = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Get counts for stats
        $stats = [
            'total' => NewsletterSubscription::count(),
            'active' => NewsletterSubscription::where('status', 'active')->count(),
            'unsubscribed' => NewsletterSubscription::where('status', 'unsubscribed')->count(),
        ];

        return Inertia::render('Admin/Newsletter/Index', [
            'subscriptions' => $subscriptions,
            'stats' => $stats,
            'filters' => $request->only(['status', 'search']),
        ]);
    }

    /**
     * Update the specified subscription status
     */
    public function update(Request $request, NewsletterSubscription $subscription)
    {
        $validated = $request->validate([
            'status' => 'required|in:active,unsubscribed',
        ]);

        if ($validated['status'] === 'unsubscribed' && $subscription->status === 'active') {
            $subscription->update([
                'status' => 'unsubscribed',
                'unsubscribed_at' => now(),
            ]);
        } elseif ($validated['status'] === 'active' && $subscription->status === 'unsubscribed') {
            $subscription->update([
                'status' => 'active',
                'subscribed_at' => now(),
                'unsubscribed_at' => null,
            ]);
        }

        return redirect()->back()->with('success', 'Subscription status updated successfully!');
    }

    /**
     * Remove the specified subscription
     */
    public function destroy(NewsletterSubscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('admin.newsletter.index')->with('success', 'Subscription deleted successfully!');
    }

    /**
     * Export subscriptions to CSV
     */
    public function export(Request $request)
    {
        $query = NewsletterSubscription::query();

        // Apply same filters as index
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $subscriptions = $query->where('status', 'active')->get();

        $filename = 'newsletter-subscriptions-' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($subscriptions) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Email', 'Status', 'Subscribed At']);

            foreach ($subscriptions as $subscription) {
                fputcsv($file, [
                    $subscription->email,
                    $subscription->status,
                    $subscription->subscribed_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
