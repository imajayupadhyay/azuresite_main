<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        // Search by name or email
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by gender
        if ($request->has('gender') && $request->gender != '') {
            $query->where('gender', $request->gender);
        }

        // Filter by city
        if ($request->has('city') && $request->city != '') {
            $query->where('city', 'like', "%{$request->city}%");
        }

        $customers = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Get counts for stats
        $stats = [
            'total' => Customer::count(),
            'with_profile' => Customer::whereNotNull('age')->orWhereNotNull('city')->count(),
            'male' => Customer::where('gender', 'male')->count(),
            'female' => Customer::where('gender', 'female')->count(),
        ];

        return Inertia::render('Admin/Customers/Index', [
            'customers' => $customers,
            'stats' => $stats,
            'filters' => $request->only(['search', 'gender', 'city']),
        ]);
    }

    /**
     * Display the specified customer
     */
    public function show(Customer $customer)
    {
        return response()->json([
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified customer
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:customers,email,' . $customer->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'gender' => ['nullable', 'in:male,female,other,prefer_not_to_say'],
            'qualification' => ['nullable', 'string', 'max:255'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
        ]);

        $customer->update($validated);

        return redirect()->back()->with('success', 'Customer updated successfully!');
    }

    /**
     * Reset customer password
     */
    public function resetPassword(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $customer->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Customer password reset successfully!');
    }

    /**
     * Remove the specified customer
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully!');
    }

    /**
     * Export customers to CSV
     */
    public function export(Request $request)
    {
        $query = Customer::query();

        // Apply same filters as index
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('gender') && $request->gender != '') {
            $query->where('gender', $request->gender);
        }

        $customers = $query->get();

        $filename = 'customers-' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($customers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Phone', 'Age', 'Gender', 'City', 'Country', 'Qualification', 'Occupation', 'Company', 'Joined Date']);

            foreach ($customers as $customer) {
                fputcsv($file, [
                    $customer->id,
                    $customer->name,
                    $customer->email,
                    $customer->phone,
                    $customer->age,
                    $customer->gender,
                    $customer->city,
                    $customer->country,
                    $customer->qualification,
                    $customer->occupation,
                    $customer->company,
                    $customer->created_at->format('Y-m-d'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
