<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function incrementQuantity_l(Request $request)
    {
        $product = Cart::find($request->prodid);
        if ($product) {
            $product->quantity += 1;
            $product->save();

            return response()->json([
                'success' => true,
                'quantity' => $product->quantity
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Product not found'], 404);
    }

    // Decrement Quantity
    public function decrementQuantity_l(Request $request)
    {
        $product = Cart::find($request->prodid);
        if ($product && $product->quantity > 1) { // Ensure quantity doesn't go below 1
            $product->quantity -= 1;
            $product->save();

            return response()->json([
                'success' => true,
                'quantity' => $product->quantity
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Product not found or quantity cannot be less than 1'], 404);
    }}
