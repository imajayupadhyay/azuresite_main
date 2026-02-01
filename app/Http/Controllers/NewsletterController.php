<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Store a new newsletter subscription
     */
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // Check if already subscribed
        $existing = NewsletterSubscription::where('email', $validated['email'])->first();

        if ($existing) {
            if ($existing->status === 'active') {
                return redirect()->back()->with('info', 'This email is already subscribed to our newsletter!');
            } else {
                // Resubscribe
                $existing->update([
                    'status' => 'active',
                    'subscribed_at' => now(),
                    'unsubscribed_at' => null,
                ]);
                return redirect()->back()->with('success', 'Welcome back! You have been resubscribed to our newsletter.');
            }
        }

        NewsletterSubscription::create($validated);

        return redirect()->back()->with('success', 'Thank you for subscribing! You will receive the latest Azure tutorials and tips.');
    }
}
