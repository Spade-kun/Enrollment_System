<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:1'],
            'phone' => ['required', 'string', 'max:20'],
            'gender' => 'required|string|max:10',
            'year_level' => 'required|integer|min:1|max:6',
            'course' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student', // Set default role to student
            'address' => $request->address,
            'age' => $request->age,
            'phone' => $request->phone,
            'status' => 'not_added_as_student',
            'gender' => $request->gender,
            'year_level' => $request->year_level,
            'course' => $request->course,
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Account created successfully. Please wait for the admin to approve your account.');
    }
}
