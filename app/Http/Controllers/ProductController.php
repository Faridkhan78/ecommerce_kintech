<?php

namespace App\Http\Controllers;

use id;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Laravel\Prompts\Prompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\alert;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            $prod->image = $image;
            // $prod->image = 'product_images/' .$image;
        }
        // if ($request->hasFile('image')) {
        //     // Generate a unique name for the image
        //     $imageName = time() . '.' . $request->image->getClientOriginalExtension();

        //     // Move the uploaded file to the public/product_images directory
        //     $request->image->move(public_path('product_images'), $imageName);

        //     // Save the file path in the database
        //     $prod->image = 'product_images/' . $imageName;
        // }


        // dd($prod);

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
    public function edit_product(string $id)
    {

        $product = Product::find($id);
        return view('admin.product.edit', compact('product'));
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
        $products = Product::all();
        //echo "testing hwwe"; exit;
        return view('welcome', compact('products'));
        //return view('admin.product.index');
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
        //  dd(1);
        // dd($request->all());
        // product_id 
        // quantity

        try {
            // dd($request->all());
            $productId = $request->input('product_id');
            //$productId = $request->prodid;

            //  dd($productId);
            // 28
            $quantity = $request->input('quantity');
            //dd($quantity);      //  1
            if (Auth::check()) {

                $userId = Auth::id();
                // dd($userId);
                $cartItem = Cart::where('userid', $userId)
                    ->where('prodid', $productId)
                    ->first();
                //  dd($cartItem);   
                //null
                if ($cartItem) {
                    //$cartItem->quantity += $quantity;

                    // dd($cartItem);

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
                    // if($cartItem->quantity == 0){
                    //     $cartItem->delete();
                    // }
                    //  decrement quantity

                    // $cartItem->save();
                    // return response()->json(['new_quantity' => $cartItem->quantity]);

                    //    new code here
                    // if ($request->has($cartItem->quantity += $quantity)) {

                    if ($cartItem->quantity += $quantity) {
                        // $cartItem->quantity += $quantity; // Increase quantity by $quantity
                        $cartItem->save(); // Save the updated quantity

                        $total = Cart::where('userId', auth()->user()->id)->sum('quantity');

                        return response()->json([
                            'message' => 'Quantity updated',
                            'new_quantity' => $cartItem->quantity,
                            'total' => $total
                        ]);

                        // return response()->json(['message' => 'Quantity increased', 'new_quantity' => $cartItem->quantity]);
                    }

                    // if ($request->has('decrement')) {
                    if ($cartItem->quantity -= $quantity) {
                        $cartItem->quantity -= $quantity; // Decrease quantity by $quantity
                        if ($cartItem->quantity > 0) {
                            $cartItem->save(); // Save the updated quantity if it's still greater than 0

                            $total = Cart::where('userId', auth()->user()->id)->sum('quantity');
                            // dd($total);

                            return response()->json([
                                'message' => 'Quantity updated',
                                'new_quantity' => $cartItem->quantity,
                                'total' => $total
                            ]);

                            // return response()->json(['message' => 'Quantity decreased', 'new_quantity' => $cartItem->quantity]);
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

                    $total = Cart::where('userid', auth()->user()->id)->sum('quantity');
                    // dd($total);

                    return response()->json([
                        'message' => 'Quantity updated',
                        'new_quantity' => 1,
                        'total' => $total
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

                //     $cart = session()->get('cart', []);
                //    dd($cart);

                //     if (isset($cart[$productId])) {

                //         $cart[$productId]['quantity'] += $quantity;
                //     } else {

                //         $cart[$productId] = [

                //             'prodid' => $productId,

                //             'quantity' => $quantity,

                //         ];
                //     }
                //     session()->put('cart', $cart); 

                //     session()->save();

                $productId = $request->input('product_id');
                $quantity = $request->input('quantity', 1);

                // Retrieve current session cart or initialize an empty array
                $cart = session()->get('cart', []);
                // dd($cart);
                // dd(session()->get('cart'));

                // Check if the product already exists in the cart
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] += $quantity;  // Increment quantity
                } else {
                    // Add a new product to the cart
                    $cart[$productId] = [
                        'prodid' => $productId,
                        'quantity' => $quantity,
                    ];
                }
                // Store the updated cart back in the session
                session()->put('cart', $cart);
                // dd($cart);
                $total = array_sum(array_column($cart, 'quantity'));

                //  session()->save();  // Save the session (optional, usually automatic)
                // response
                // dd($total);

                // $total_q = [];
                // foreach ($cart as $carts) {
                //     $total_q[] = $carts['quantity'];
                // }
                // $total = array_sum($total_q);
                return response()->json([
                    'message' => 'Cart updated!',
                    'cart' => $cart,
                    'total' => $total
                ]);

                //end response


                return response()->json(['message' => 'Item added to cart in session', 'cart' => $cart]);

                // dd($cart);
                // $request->session()->put('cart', $cart);
                // echo  $request->session()->get('cart');
                //$request->session()->forget('cart');
                //This will delete session values 
                //$request->session()->flush();
                //  $request->session()->flush('message','Your Add to cart has been strored successfully');
                // Debugging to check cart content

                //dd($cart);

                //return view('frontend.cart', compact('cart'));
                // return response()->json(['message' => 'Item added to cart in session']);
                //return redirect()->back();
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    static function carItem()
    {
        $userId =  Session::get('user')['id'];

        return Cart::where('userId', $userId)->count();


        // $userId = auth()->id(); // Or session user id
        // return Cart::where('user_id', $userId)->sum('quantity');
    }
    public function cartList1()
    {
        //  dd(1);
        //  $userId = Session::get('users')['id'];

        $userId = Auth::id();

        //dd($userId);
        //$userId = User::find($id);
        //$userId = User::find($id);
        //dd($userId);
        if ($userId) {
            $datas = DB::table('cart')
                ->join('products', 'cart.prodid', '=', 'products.id')
                ->select('products.*', 'cart.quantity')
                ->where('cart.userid', $userId)
                ->get();
        } else {
            // Fetch cart data from session for guest users
            $datas = session('cart', []); // Default to an empty array if no cart session exists

            //dd($datas);
        }
        //dd($datas);
        return view('frontend.cartlist', ['datas' => $datas]);

        //return view('frontend.cartlist',compact('userId'));
        //return view('frontend.cartlist', compact('userId'));
        // return "hello";

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
    public function cartList()
    {
        // dd(1);
        // $cartId = cart::get();
        // dd($cartId);
        // if (!Auth::check()) {
        //     // Redirect to login page with a message
        //     return redirect()->route('login')->with('message', 'Please login to continue.');
        // }
        //  dd(1);
        $userId = Auth::id();
        //$userId = Session::get('users')['id'];
        // dd($userId);
        if ($userId) {
            $datas = DB::table('cart')
                ->join('products', 'cart.prodid', '=', 'products.id')
                ->select('products.id as prodid', 'products.name', 'products.desc', 'products.image', 'products.price', 'cart.quantity', 'cart.id as cartid') // Add more fields as needed
                ->where('cart.userid', $userId)
                ->get();
            // ->toArray();
        } else {

            // Fetch cart data from session for guest users
            $datas = session('cart', []); // Default to an empty array if no cart session exists
            //  dd($datas);
            // Exit

            // Example of updating session cart data to include additional fields
            foreach ($datas as $key => $item) {
                //dd($key, $item);
                //  dd($item);

                $product = DB::table('products')->where('id', $item['prodid'])->first();

                // $product = DB::table('products')->where('id', $item->prodid)->first();

                //  dd($product);
                if ($product) {
                    $datas[$key] = [
                        'prodid' => $product->id,
                        'name' => $product->name,
                        // 'description' => $product->description,
                        'image' => $product->image,
                        'price' => $product->price,
                        'quantity' => $item['quantity'],                                                           // Example additional field
                        // 'brand' => $product->brand,        // Example additional field
                    ];
                }
            }
            // Update session with enriched data (optional if you want to save it)
            session()->put('cart', $datas);
        }

        // Example response (optional)
        //  return response()->json(['cart' => $datas]);
        return view('frontend.cartlist', ['datas' => $datas]);
        // return response()->json(['frontend.cartlist','cart' => $datas]);
        //return view(['frontend.cartlist','datas' => $datas]);
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

    public function incrementQuantity(Request $request)
    {
        // dd($request->all());
        try {
            $productId = $request->input('prodid');
            $quantity = 1;

            if (Auth::check()) {

                $userId = Auth::id();
                $cartItem = Cart::where('userid', $userId)
                    ->where('prodid', $productId)
                    ->first();

                if ($cartItem) {
                    $cartItem->quantity += $quantity;
                    $cartItem->save();
                    $total = Cart::where('userId', auth()->user()->id)->sum('quantity');
                    return response()->json([
                        'message' => 'Quantity updated',
                        'new_quantity' => $cartItem->quantity,
                        'total' => $total
                    ]);

                    // return response()->json(['new_quantity1' => $cartItem->quantity]);
                }
            } else {

                // dd(1);

                $cart = session()->get('cart', []);
                // dd($cart);
                $cart[$productId]['quantity'] = ($cart[$productId]['quantity'] ?? 0) + $quantity;
                session()->put('cart', $cart);
                $cartd = session()->get('cart');

                $total_q = [];
                foreach ($cartd as $carts) {
                    $total_q[] = $carts['quantity'];
                }

                $total = array_sum($total_q);
                return response()->json([
                    'new_quantity' => $cart[$productId]['quantity'],
                    'total' => $total
                ]);

                //  dd($cart);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public  function decrementQuantity(Request $request)
    {
        // dd($request->all);
        try {
            $productId = $request->input('prodid');

            if (Auth::check()) {
                $userId = Auth::id();
                $cartItem = Cart::where('userid', $userId)
                    ->where('prodid', $productId)
                    ->first();

                if ($cartItem) {
                    if ($cartItem->quantity > 1) {
                        $cartItem->quantity -= 1;
                        $cartItem->save();
                        $total = Cart::where('userId', auth()->user()->id)->sum('quantity');
                        return response()->json([
                            'message' => 'Quantity updated',
                            'new_quantity' => $cartItem->quantity,
                            'total' => $total
                        ]);
                        // return response()->json(['new_quantity' => $cartItem->quantity]);
                    } else {
                        $cartItem->delete();
                        return response()->json(['new_quantity' => 0]);
                    }
                }
            } else {
                $cart = session()->get('cart', []);
                if (isset($cart[$productId])) {
                    if ($cart[$productId]['quantity'] > 1) {
                        $cart[$productId]['quantity'] -= 1;
                        session()->put('cart', $cart);


                        $total_q = [];
                        foreach ($cart as $carts) {
                            $total_q[] = $carts['quantity'];
                        }
                        $total = array_sum($total_q);
                        return response()->json([
                            'new_quantity' => $cart[$productId]['quantity'],
                            'total' => $total
                        ]);

                        // return response()->json(['new_quantity' => $cart[$productId]['quantity']]);
                    } else {
                        unset($cart[$productId]);
                        session()->put('cart', $cart);
                        return response()->json(['new_quantity' => 0]);
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    private function storeSessionCartIntoDatabase()
    {
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

        return redirect()->route('welcome')->with('success', 'Cart stored in database.');
    }


    public function storeCartInDatabase()
    {
        $userId = Auth::id(); // Ensure the user is authenticated
        if (!$userId) {
            return redirect()->route('welcome')->with('error', 'Please log in to save your cart.');
        }

        // Retrieve session cart items
        $cart = session()->get('cart', []);

        if (!empty($cart)) {
            foreach ($cart as $item) {
                // Check if the product exists in the database
                $existingCartItem = Cart::where('userid', $userId)
                    ->where('prodid', $item['prodid'])
                    ->first();

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

            // Clear session cart after storing to the database
            session()->forget('cart');

            return redirect()->route('welcome')->with('success', 'Cart stored in the database.');
        } else {
            return redirect()->route('welcome')->with('info', 'No items in the cart to store.');
        }
    }
    public function removeCart($id)
    {
        Cart::remove($id);
        return redirect()->route('cartlist')->with('success', 'Item removed from cart.');
    }

    function orderNow()
    {
        if (!Auth::check()) {
            // Redirect to login page with a message
            return redirect()->route('login')->with('message', 'Please login to continue.');
        }
        //$userId = Session::get('users')['id'];

        $userId = Auth::id();

        $total  = DB::table('cart')
            ->join('products', 'cart.prodid', '=', 'products.id')
            ->where('cart.userid', $userId)
            ->sum('products.price');

        // dd($total);

        //dd($datas);

        return view('frontend.checkout', ['total' =>  $total]);
    }
    // function orderPlace(Request $req)
    // {
    //     //  $cartItems = \App\Models\Cart::where('user_id', auth()->id())->get();

    //     //dd($req->all());
    //     $userId = Auth::id();
    //     // echo "<pre>"; 
    //     // print_r($req); exit;
    //     //echo $userId; exit;
    //     //  $allCart = Cart::where('user_id', $userId)->get();
    //     $cartItems = \App\Models\Cart::where('userid', $userId)->get(); //select * from table cart where userid = 2
    //     foreach ($cartItems as $cart) {

    //         $order = new Order();
    //         $order->userid = $cart['userid'];
    //         $order->prodid = $cart['prodid'];
    //         $order->quantity = $cart['quantity'];
    //         $order->address2 = $req->address;    // $req->address
    //         $order->status = 'pending';
    //         $order->payment_method = $req->payment;
    //         $order->payment_status = "pending status";

    //         //'payment_method' => $request->payment_method,  // Make sure this is set

    //         // $order->user_id = $userId;
    //         // $order->total_amount = $cart->price * $cart->quantity;
    //         // $order->status = 'pending';
    //         // $order->payment_status = 'unpaid';
    //         // $order->payment_method = 'cod';

    //         $order->save(); //insert into table order ()
    //     }

    //     //$userId = Session::get('users')['id'];

    //     // return  $req->input();
    // }
    public function orderPlace(Request $req)
    {

        $req->validate([
            'address' => 'required|string|max:255',
            'payment' => 'required|in:cash,card', // You can adjust allowed payment methods
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'mobile' => 'required|digits:10', // Assuming a 10-digit mobile number
        ]);
        //$userId = auth()->id(); // Retrieve the authenticated user's ID

        $userId = Auth::id();
        // Fetch cart items for the user
        $cartItems = Cart::where('userid', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'No items in the cart to place an order.');
            //return redirect()->route('orderplace')->with('success', 'Order placed successfully!');
        }

        foreach ($cartItems as $cart) {

            // dd($cart);
            // Create a new Order
            $order = new Order();
            $order->userid = $cart->userid;
            $order->prodid = $cart->prodid;
            $order->quantity = $cart->quantity;
            $order->address2 = $req->address;  // Get address from request
            $order->status = 'pending';
            $order->payment_method = $req->payment;  // Get payment method from request
            $order->payment_status = "pending status";
            $order->firstname = $req->firstname;
            $order->lastname = $req->lastname;
            $order->mobile = $req->mobile;
            $order->save(); //Save the order
            //dd($cart);
            // Delete the item from cart
            $cart->delete();
        }

        return redirect()->route('myorder')->with('success', 'Order placed successfully!');

        // if (!Auth::check()) {
        //     // Redirect to login page with a message
        //     return redirect()->route('login')->with('message', 'Please login to continue.');
        // }

    }

    public function delete_cartlist($id)
    {
        //  dd($id);   
        $cart = Cart::find($id);
        //  $cart = Cart::findOrFail($id);
        //  dd($cart);
        $cart->delete(); // Soft delete the record

        return redirect()->back();
        // if ($cart) {
        //     $cart->delete();

        //     //return redirect('cartlist')->with('success', 'Cartlist deleted successfully.');
        //     return redirect()->back()->with('success', 'CartLIst deleted successfully!');
        // }
        // else {
        //     return redirect('show-user')->with('error', 'User not found.');
        // }

        // $students = Student::find($id);
        // $students->delete();
        // return redirect('show-student');
    }
    public function myOrder()
    {
        $userId = Auth::id();
        //dd($userId);
        // DB::table('orders')->where('userid', $userId)->delete();

        $total = DB::table('orders')

            ->join('products', 'orders.prodid', '=', 'products.id')
            //->select('orders.id', 'orders.quantity', 'orders.status', 'products.name', 'products.price', 'orders.created_at')
            ->select('orders.*', 'products.name', 'products.image', 'products.price', 'products.status as productstatus')
            ->where('orders.userid', $userId)
            //->where('orders.status')
            ->get();
        //dd($datas);
        return view('frontend.myorder', ['total' => $total]);
        // $userId = Auth::id();
        // $orders = Order::where('userid', $userId)->get();
        // return view('frontend.myorder', compact('orders'));
    }
    public function myOrder1()
    {
        $userId = Auth::id();

        // Remove previous order data for the user
        DB::table('orders')->where('userid', $userId)->delete();

        // Fetch new order data after deletion
        $total = DB::table('orders')
            ->join('products', 'orders.prodid', '=', 'products.id')
            ->select('orders.*', 'products.name', 'products.image', 'products.price', 'products.status as productstatus')
            ->where('orders.userid', $userId)
            ->get();

        return view('frontend.myorder', ['total' => $total]);
    }

    // public function placeOrder(Request $request)
    // {
    //     $order = Order::create([
    //         'user_id' => auth()->id(),
    //         'total_amount' => $request->total_amount,
    //         'status' => 'pending',
    //         'payment_status' => 'unpaid',
    //         'payment_method' => $request->payment_method,
    //     ]);

    //     foreach ($request->products as $product) {
    //         OrderItem::create([
    //             'order_id' => $order->id,
    //             'product_id' => $product['id'],
    //             'quantity' => $product['quantity'],
    //             'price' => $product['price'],
    //         ]);
    //     }

    //     return response()->json(['message' => 'Order placed successfully!']);
    // }
    // public function checkout()
    // {
    //     $userId = auth()->id();
    //     $cartItems = Cart::where('user_id', $userId)->get();
    //     $totalAmount = $cartItems->sum('quantity * price');    

    public function delete_session(Request $request)
    {        // session()->forget('cart'); // Specify the key to be deleted
        $itemIdToRemove = $request->input('id');
        //dd($request->all());
        // dd($itemIdToRemove);    // 22
        $cart = session('cart', []);
            // dd($cart);             
        $updatedCart = array_filter($cart, function ($item) use ($itemIdToRemove) {
            // dd($item['prodid'] != $itemIdToRemove);
            return $item['prodid'] != $itemIdToRemove;
        });
        // dd($updatedCart);
        session(['cart' => $updatedCart]);
        // session(['cart' => array_values($updatedCart)]); // Re-index the array
        session()->save(); // Ensure session is updated immediately
        // dd(session('cart', []));
        // return response()->json(['success' => true, 'message' => 'Item removed successfully']);
        return redirect()->back()->with('message', 'Session data cleared successfully.');
    }
    public function delete_session11(Request $request)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$request->id])) {
        unset($cart[$request->id]);
        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Item deleted successfully!']);
    }

    return response()->json(['success' => false, 'message' => 'Item not found.']);
}
//     public function delete_session(Request $request)
// {
//     $itemIdToRemove = $request->input('id');
//     $cart = session('cart', []);

//     // Remove the item with the matching prodid
//     $updatedCart = array_filter($cart, function ($item) use ($itemIdToRemove) {
//         return $item['prodid'] != $itemIdToRemove;
//     });

//     // Re-index the array to avoid gaps in keys
//     session(['cart' => array_values($updatedCart)]);
//     session()->save(); // Ensure session updates immediately

//     // Return JSON response instead of redirect
//     return response()->json(['success' => true, 'message' => 'Item removed successfully']);
// }

    public function deleteSessionItem(Request $request)
    {
        $itemIdToRemove = $request->input('id');
        $cart = session('cart', []);

        $updatedCart = array_filter($cart, function ($item) use ($itemIdToRemove) {
            return $item['prodid'] != $itemIdToRemove;
        });

        session(['cart' => array_values($updatedCart)]); // Re-index the array

        // return response()->json(['success' => true, 'message' => 'Item removed successfully']);

        return redirect()->back()->with('message', 'Session data cleared successfully.');
    }


    public function increment(Request $request)
    {

        //  dd($request);
        if (Auth::check()) {
            //$productId = $request->input('id');

            // $cart = Cart::where('userid', Auth::id())->where('id', $request->id)->first();
            $cart = Cart::find($request->prodid);

            // $cart = Cart::where ();
            //  dd($request->prodid);
            //    dd($cart);
            if ($cart) {
                // dd($cart);
                $cart->quantity += 1;
                $cart->save();
            }
            //  dd($cart);
            return response()->json([
                'success' => true,
                'quantity' => $cart->quantity,
                'message' => 'Quantity updated in database'
            ]);
        } else {

            $productId = $request->input('prodid');
            //  dd($productId);
            $cart = session('cart', []);
            // dd($cart);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += 1; // Increment quantity
            }
            // dd($cart[$productId]);
            session(['cart' => $cart]); // Update session

            // dd($cart);
            return response()->json(['success' => true, 'cart' => $cart]);
        }
    }

    // Decrement the quantity of a product in the session
    public function decrement(Request $request)
    {

        if (Auth::check()) {
            // Find the cart item for the logged-in user
            $cart = Cart::where('userid', Auth::id())->where('id', $request->prodid)->first();
            //  dd($cart);

            if ($cart && $cart->quantity > 1) {
                $cart->quantity -= 1;
                $cart->save();

                return response()->json([
                    'success' => true,
                    'quantity' => $cart->quantity,
                    'message' => 'Quantity updated in database'
                ]);
            }
        } else {

            $productId = $request->input('prodid');
            // dd($productId);
            $cart = session('cart',[]);

            if (isset($cart[$productId]) && $cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity'] -= 1; // Decrement quantity
            } elseif (isset($cart[$productId]) && $cart[$productId]['quantity'] === 1) {
                // unset($cart[$productId]); // Remove the item if quantity becomes 0
            }

            session(['cart' => $cart]); // Update session
            return response()->json(['success' => true, 'cart' => $cart]);
        }
    }
    // public function incrementSession(Request $request)
    // {
    //     $cart = session('cart', []);
    //     $productId = $request->input('id');

    //     foreach ($cart as &$item) {
    //         if ($item['id'] == $productId) {
    //             $item['quantity']++;
    //             break;
    //         }
    //     }

    //     session(['cart' => $cart]);
    //     return redirect()->back()->with('success', 'Product quantity incremented.');
    // }


    // public function decrementSession(Request $request)
    // {
    //     $cart = session('cart', []);
    //     $productId = $request->input('id');

    //     foreach ($cart as &$item) {
    //         if ($item['id'] == $productId) {
    //             if ($item['quantity'] > 1) {
    //                 $item['quantity']--;
    //             } else {
    //                 $cart = array_filter($cart, function ($item) use ($productId) {
    //                     return $item['id'] != $productId;
    //                 });
    //             }
    //             break;
    //         }
    //     }

    //     session(['cart' => $cart]);
    //     return redirect()->back()->with('success', 'Product quantity decremented.');
    // }
}

// $cartItems = Cart::all();
// foreach ($cartItems as $cart) {
//     $product = Product::find($cart->prodid);
//     if ($product->stock < $cart->quantity) {
//         return redirect()->back()->with('error', 'Not enough stock for the selected quantity.');
//     }
// }