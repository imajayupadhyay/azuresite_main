<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class CustomerAuthController extends Controller
{
    /**
     * Handle customer registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $customer = Customer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::guard('customer')->login($customer);

        return redirect()->route('home')->with('success', 'Account created successfully! Welcome to AzureSkill.');
    }

    /**
     * Handle customer login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('customer')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle customer logout
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show customer profile
     */
    public function profile()
    {
        $customer = Auth::guard('customer')->user();
        
        // Ensure we have the latest data
        $customer->refresh();
        
        return Inertia::render('Customer/Profile', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update customer profile
     */
    public function updateProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'unique:customers,email,' . $customer->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'gender' => ['nullable', 'in:male,female,other,prefer_not_to_say'],
            'qualification' => ['nullable', 'string', 'max:255'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'interests' => ['nullable', 'array'],
        ]);

        // Remove null values to only update provided fields
        $dataToUpdate = array_filter($validated, function($value) {
            return $value !== null && $value !== '';
        });

        // Update the customer
        $customer->update($dataToUpdate);

        // Refresh the customer model to get updated data
        $customer->refresh();

        return redirect()->route('customer.profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Update customer password
     */
    public function updatePassword(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password:customer'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $customer->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
}
