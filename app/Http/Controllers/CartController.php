<?php

namespace App\Http\Controllers;

use DB;
use id;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userCart = Cart::with('product')->where('userid', 1)->get();

        foreach ($userCart as $item) {
            echo "Product ID: {$item->prodid}, Quantity: {$item->quantity}";
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cart::create([
        //     'userid' => 1, // ID of the logged-in user
        //     'prodid' => 10, // ID of the product to add
        //     'quantity' => 2, // Quantity to add
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Cart::create([
        //     'userid' => 1, // ID of the logged-in user
        //     'prodid' => 10, // ID of the product to add
        //     'quantity' => 2, // Quantity to add
        // ]);
        // Validate the incoming request data
        $validated = $request->validate([
            'prodid' => 'required|exists:products,id', // Ensure product ID exists in the products table
            'quantity' => 'required|integer|min:1',   // Quantity should be a positive integer
        ]);

        // Get the authenticated user's ID
        $userId = auth()->id();

        // Check if the product is already in the cart for this user
        $cartItem = Cart::where('userid', $userId)
            ->where('prodid', $validated['prodid'])
            ->first();

        if ($cartItem) {
            // If the product already exists in the cart, update the quantity
            $cartItem->update([
                'quantity' => $cartItem->quantity + $validated['quantity'],
            ]);
        } else {
            // If the product is not in the cart, create a new cart entry
            Cart::create([
                'userid' => $userId,
                'prodid' => $validated['prodid'],
                'quantity' => $validated['quantity'],
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Cart::where('userid', 1)
            ->where('prodid', 10)
            ->update(['quantity' => 5]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cart::where('userid', 1)
            ->where('prodid', 10)
            ->delete();
    }

    // addtocart increment and decrement
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'prodid' => 'required|exists:products,id',
    //         'quantity' => 'required|integer|min:1',
    //     ]);

    //     Cart::updateOrCreate(
    //         [
    //             'userid' => auth()->id(),
    //             'prodid' => $request->prodid,
    //         ],
    //         [
    //             'quantity' => DB::raw('quantity + ' . $request->quantity),
    //         ]
    //     );

    //     return response()->json(['message' => 'Product added to cart successfully!']);
    // }
}
