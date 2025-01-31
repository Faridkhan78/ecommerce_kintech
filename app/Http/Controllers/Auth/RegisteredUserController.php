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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'number' => ['required', 'numeric'],
            'address' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'number' => $request->number,
            'address' => $request->address,
            'image' => null,
            'role' => 'customer'
        ]);

        event(new Registered($user));

        Auth::login($user);


        if (Auth::user()->role == 'admin') {
            return redirect(to: 'admin-dashboard');
        } else {
           // return redirect(to: 'login');
             return redirect(to: 'user-side');
        }

        // return redirect(route('dashboard', absolute: false));
    }
}
