<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cart;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // session stored data into database

        // if (Auth::user()->role == 'admin') {
        //     return redirect(to: 'admin-dashboard');
        //     //return redirect(to:'/');
        // } else {
        //     // return redirect(to: 'user-side');
        //     return redirect(to: 'login');
        // }


        $userId = Auth::id();
        // Retrieve session cart items
        $cart = session()->get('cart', []);

        foreach ($cart as $productId => $item) {
            // Check if the product exists in the database
            $existingCartItem = Cart::where('userid', $userId)->where('prodid', $item['prodid'])->first();

            if ($existingCartItem) {
                // Increment quantity if item already exists
                $existingCartItem->quantity += $item['quantity'];
                $existingCartItem->save();
            } else {
                // Create a new cart item
                Cart::create([
                    'userid' => $userId,
                    'prodid' => $item['prodid'],
                    'quantity' => $item['quantity'],
                ]);
            }
        }
        // Clear session cart after storing to database

        session()->forget('cart');

        return redirect()->route('ordernow')->with('success', 'Cart stored in database.');

        // end session stored data into database


        if (Auth::user()->role == 'admin') {
            return redirect(to: 'admin-dashboard');
            //return redirect(to:'/');
        } else {
            // return redirect(to: 'user-side');
            return redirect(to: 'login');
        }

        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
