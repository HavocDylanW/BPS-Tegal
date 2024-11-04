<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle the authentication attempt
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Flash message for successful login
            $request->session()->flash('success', 'Login berhasil!');

            return $this->redirectBasedOnRole($user);
        }

        return redirect()->route('login')->withErrors('Invalid credentials.');
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }

    // Redirect the user to a single dashboard view based on their role
    protected function redirectBasedOnRole($user)
    {
        // Assuming roles are not empty and user has at least one role
        $roleName = $user->roles->first()->name;

        switch ($roleName) {
            case 'Employee':
                return redirect()->route('employee.dashboard');
            case 'Admin':
                return redirect()->route('admin.dashboard');
            case 'Super Admin':
                return redirect()->route('superAdmin.dashboard');
            default:
                return abort(403, 'Unauthorized');
        }
    }
}
