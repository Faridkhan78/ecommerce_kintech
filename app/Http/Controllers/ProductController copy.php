<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Laravel\Prompts\Prompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::all();
        return view('admin.product.index', compact('products'));
        // return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prod = new Product();

        $prod->name = $request->name;
        $prod->desc = $request->desc;
        $prod->price = $request->price;
        $prod->qty = $request->qty;

        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->getClientOriginalName();
            $request->image->move(public_path('product_images'), $image);
            $prod->image = 'product_images/' . $image;
        }

        $prod->save();

        return redirect()->back()->with('success', 'Add Product');
        // return 'insert product';

        //return redirect('show-product');
        //return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');

        // $prod->image = $request->image;
        // $prod->desc = $request->desc;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_product(string $id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back();
    }
    public function userpost()
    {
        
        $cartItemIds = session()->get('cart', []); // Get the cart or an empty array
        $cartItemIds = collect($cartItemIds)->pluck('prodid'); // Convert to collection and pluck 'prodid'
        // dd($cartItemIds);
      //Cart::where('id',$cartItemIds)->first();
        $products = Product::all();
        return view('welcome', compact('products'));
//        return view('welcome')->with('products',$products);
        // return view('admin.product.index');
    }

    // public function addToCart(Request $req)
    // {

    //     if ($req->session()->has('user')) {
    //         $cart = new  Cart;
    //         $cart->userid = $req->session()->get('user')['id'];
    //         $cart->prodid = $req->prodid;
    //         $cart->save();
    //         return "hello";
    //     } else {
    //         $cart = new  Cart;
    //         dd($cart);
    //         $cart->userid = $req->userid;
    //         $cart->prodid = $req->prodid;
    //         $cart->quantity = 1;

    //         $cart->save();
    //         return redirect('/login');
    //     }

    //     // if ($req->session()->has('user')) {
    //     //     // Create a new Cart instance
    //     //     $cart = new Cart;
    //     //     $cart->userid = $req->session()->get('user')['id']; // Get user ID from session
    //     //     $cart->prodid = $req->prodid; // Get product ID from request

    //     //     // Save the cart data in the database
    //     //     $cart->save();

    //     //     // Save the product ID in the session (optional)
    //     //     $req->session()->push('cart_items', $req->prodid);

    //     //     // Return success message or redirect
    //     //     return "Product added to cart!";
    //     // } else {
    //     //     // Redirect to login if the user is not logged in
    //     //     return redirect('/login')->with('message', 'Please log in to add items to your cart.');
    //     // }
    // }
    public function addToCart(Request $request)

    {

        try {
            //dd($request->all());
            $productId = $request->input('prodid');
            // dd($productId);

            $quantity = $request->input('quantity', 1);
            // dd($quantity);      //  1
            if (Auth::check()) {

                $userId = Auth::id();
                //dd($userId);
                $cartItem = Cart::where('userid', $userId)
                    ->where('prodid', $productId)
                    ->first();
                //dd($cartItem);

                if ($cartItem) {

                  $cartItem->quantity += $quantity;

                  //dd($cartItem);



                    // if($cartItem->quantity += $quantity){
                    //     // Decrement quantity
                    //    // $cartItem->quantity -= 1;
                    //     if($cartItem->quantity >= 0){
                    //         $cartItem->save();
                    //     }
                    // }

                    // if($cartItem->quantity -= $quantity){
                    //     // Decrement quantity
                    //    // $cartItem->quantity -= 1;
                    //     if($cartItem->quantity <= 0){
                    //         $cartItem->delete();
                    //     }
                    // }
                    //  decrement quantity

                     $cartItem->save();
                    // return response()->json(['new_quantity' => $cartItem->quantity]);

                    //    new code here
                    if ($request->has($cartItem->quantity += $quantity)) {
                        $cartItem->quantity += $quantity; // Increase quantity by $quantity
                        $cartItem->save(); // Save the updated quantity
                        return response()->json(['message' => 'Quantity increased', 'new_quantity' => $cartItem->quantity]);
                    }

                    if ($request->has('decrement')) {
                        $cartItem->quantity -= $quantity; // Decrease quantity by $quantity
                        if ($cartItem->quantity > 0) {
                            $cartItem->save(); // Save the updated quantity if it's still greater than 0
                            return response()->json(['message' => 'Quantity decreased', 'new_quantity' => $cartItem->quantity]);
                        } else {
                            $cartItem->delete(); // Remove the cart item if the quantity reaches 0
                            return response()->json(['message' => 'Item removed from cart', 'new_quantity' => 0]);
                        }
                    }
                } else {

                    Cart::create([

                        'userid' => $userId,

                        'prodid' => $productId,

                        'quantity' => $quantity,
                    ]);
                    //$cart->save();
                }

                //return response()->json(['message' => 'Item added to cart in database']);
                //return view('addtocart', compact('cart'));
                //return view('frontend.cart', compact('cartItem'));
                //return view(compact('cartItem'));
                //$cartItem->save();
                return redirect()->back();
            } else {
                /* 
                 if (auth()->check() && session()->has('cart')) {
                    $sessionCart = session('cart');
                    foreach ($sessionCart as $productId => $quantity) {
                        \App\Models\CartItem::updateOrCreate(
                            ['user_id' => auth()->id(), 'product_id' => $productId],
                            ['quantity' => $quantity]
                        );
                    }
                    session()->forget('cart');
            */

                $cart = session()->get('cart', []);
                //dd($cart);

                if (isset($cart[$productId])) {

                    $cart[$productId]['quantity'] += $quantity;
                } else {

                    $cart[$productId] = [

                        'prodid' => $productId,

                        'quantity' => $quantity,

                    ];
                }
                session()->put('cart', $cart);

                session()->save();


                //return view('frontend.cart', compact('cart'));
                // return response()->json(['message' => 'Item added to cart in session']);
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    static function carItem()
    {
        $userId =  Session::get('user')['id'];
        return Cart::where('userId', $userId)->count();
    }
    public function cartList()
    {
        //return "hi";
        //   dd(1);
      //  $userId = Session::get('users')['id'];
        
        //$userId = Auth::id();
       
        // $data = DB::table('cart')
        //     ->join('products', 'cart.prodid', 'product.id')
        //     ->select('product.*')
        //     ->where('cart.userid', $userId)
        //     ->get();

        //return view('frontend.cartlist', ['products' => $data]);
       // return view('frontend.cartlist');

        //return "hello";
        // if(Auth::check()){
        //     $cart = Cart::where('userid', Auth::id())->get();
        //     return view('cart', compact('cart'));
        // }else{
        //     $cart = session()->get('cart', []);
        //     return view('cart', compact('cart'));
        // }
    }
    public function storeajx(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Process your form data (e.g., save to database)
        // Example: User::create($validated);

        return response()->json(['message' => 'Form submitted successfully!']);
    }
}
