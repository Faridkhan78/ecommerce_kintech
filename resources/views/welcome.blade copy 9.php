<?php
//use App\Http\Controllers\ProductController;
// $total = 0;
// if (auth()->user()) {
//     // $total = ProductController::catItem();
//     $total = \App\Models\Cart::where('userId', auth()->user()->id)
//         ->pluck('quantity')
//         ->sum();
//     //$total = Session::get('user')['cart_total'];
// }

$total = 0;

if (auth()->check()) {
    // Fetch total quantity for authenticated user
    $total = \App\Models\Cart::where('userId', auth()->user()->id)->sum('quantity');
    // Update the session with the current total quantity for later use
    // session(['cart_total' => $total]);
} else {
    // Fetch total from session if available

    $total = array_sum(array_column(session('cart', []), 'quantity'));
    //dd($total);
    // $total = session('cart', 0); // Defaults to 0 if 'cart_total' does not exist
    //     $cart_total = $totalQuantity;
    //    $total =session(['cart_total' => $totalQuantity]);
    //$total = session(['cart_total' => $total]);
    //$total = session(['cart' => $totalQuantity]);
}
?>

@if (session('message'))
    <div>{{ session('message') }}</div>
@endif

<body>
    @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</body>

{{-- template --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-item {
            border: none;
            background: none;
            padding: 8px;
            cursor: pointer;
            color: #333;
            text-decoration: none;
        }

        .dropdown-item:hover {
            background-color: #ddd;
        }
    </style>

</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                            class="text-white">123 Street, New York</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                            class="text-white">Email@Example.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and
                            Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.html" class="navbar-brand">

                    <h1 class="text-primary display-6">Shopping</h1>

                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                        <a href="{{ url('shop') }}" class="nav-item nav-link">Shop</a>
                        <a href="{{ url('shopdetails') }}" class="nav-item nav-link">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{ url('cartlist') }}" class="dropdown-item">Cart</a>
                                <a href="{{ url('checkout') }}" class="dropdown-item">Chackout</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                <a href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div>
                        <a href="{{ url('contact') }}" class="nav-item nav-link">Contact</a>
                        <a href="{{ url('myorder') }}" class="nav-item nav-link">Order</a>
                    </div>
                    {{-- login logout --}}
                    {{-- <div class="d-flex m-3 me-0">
                        <button
                            class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                            data-bs-toggle="modal" data-bs-target="#searchModal"><i
                                class="fas fa-search text-primary"></i></button>
                        <a href="#" class="position-relative me-4 my-auto">
                            <a href="{{ route('clearlist') }}">Add To Cart({{ $total }})
                                <i class="fa fa-shopping-bag fa-2x"></i>
                            </a>

                            @if (Session::has('user'))
                                <a href="">{{ Session::get('user')['name'] }}</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Log Outt') }}
                                    </x-dropdown-link>
                                </form>
                            @else
                                <a href="/login">Logout
                                </a>
                            @endif
                            <span
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">

                            </span>
                        </a>


                        <a href="#" class="my-auto">
                            <i class="fas fa-user fa-2x"></i>
                        </a>

                    </div> --}}
                    {{-- loging logout

                    {{-- <div class="dropdown">
                        @if (Session::has('user'))
                            <!-- Display user's name and logout option -->
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-expanded="false">
                                {{ Session::get('user')['name'] }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fa fa-sign-out"></i> Log Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <!-- Login link for guests -->
                            <a href="{{ route('login') }}">Login</a>
                        @endif
                    </div>
                    <!-- Optional user icon with dropdown -->
                    <a href="#" class="my-auto">
                        <i class="fas fa-user fa-2x"></i>
                    </a> --}}

                    <div class="d-flex m-3 me-0">
                        <!-- Search Button -->
                        <button
                            class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                            data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="fas fa-search text-primary"></i>
                        </button>

                        <!-- Cart Link -->
                        {{-- <a href="{{ route('clearlist') }}" class="position-relative me-4 my-auto">
                            Add To Cart ({{ $total }})
                            <i class="fa fa-shopping-bag fa-2x"></i>
                        </a> --}}
                        {{-- <a href="{{ route('clearlist') }}" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">{{ $total }}</span>

                        </a> --}}
                        <a href="{{ route('clearlist') }}" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span id="shop_count"
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">{{ $total }}</span>
                        </a>

                        <!-- User Dropdown or Login Button -->
                        {{-- @if (Session::has('user'))
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ Session::get('user')['name'] }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fa fa-sign-out"></i> Log Out
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="/login" class="btn btn-primary">Login</a>
                        @endif --}}

                        @if (Auth::check())
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fa fa-sign-out"></i> Log Out
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="fas fa-user fa-2x"></a>
                        @endif

                        <!-- User Icon -->
                        {{-- <a href="" class="my-auto">
                            <i class="fas fa-user fa-2x"></i>
                        </a> --}}
                    </div>


                    {{-- end login logout --}}

                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Hero Start -->
    {{-- <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">100% Organic Foods</h4>
                    <h1 class="mb-5 display-3 text-primary">Organic Veggies & Fruits Foods</h1>
                    <div class="position-relative mx-auto">
                        <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill"
                            type="number" placeholder="Search">
                        <button type="submit"
                            class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100"
                            style="top: 0; right: 25%;">Submit Now</button>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="img/hero-img-1.png" class="img-fluid w-100 h-100 bg-secondary rounded"
                                    alt="First slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Fruites</a>
                            </div>
                            <div class="carousel-item rounded">
                                <img src="img/hero-img-2.jpg" class="img-fluid w-100 h-100 rounded"
                                    alt="Second slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Vesitables</a>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Hero End -->


    <!-- Featurs Section Start -->
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-car-side fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Free Shipping</h5>
                            <p class="mb-0">Free on order over $300</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-user-shield fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Security Payment</h5>
                            <p class="mb-0">100% security payment</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-exchange-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>30 Day Return</h5>
                            <p class="mb-0">30 day money guarantee</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-phone-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>24/7 Support</h5>
                            <p class="mb-0">Support every time fast</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs Section End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Products Details</h1>
                    </div>
                    <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                    href="#tab-1">
                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill"
                                    href="#tab-2">
                                    <span class="text-dark" style="width: 130px;">Vegetables</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill"
                                    href="#tab-3">
                                    <span class="text-dark" style="width: 130px;">Fruits</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill"
                                    href="#tab-4">
                                    <span class="text-dark" style="width: 130px;">Bread</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill"
                                    href="#tab-5">
                                    <span class="text-dark" style="width: 130px;">Meat</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    @if (!Auth::check())
                                        @foreach ($products as $product)
                                            {{-- @dd($product); --}}
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img">
                                                        <img src="{{ asset('product_images/' . $product->image) }}"
                                                            alt="" height="100">
                                                    </div>
                                                    {{-- @dd($product->image); --}}
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                        style="top: 10px; left: 10px;">{{ $product->name }}</div>
                                                    <div
                                                        class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4>{{ $product->desc }}</h4>
                                                        <p>Available Quantity:</p>
                                                        <p>{{ $product->qty }}</p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">
                                                                {{ $product->price }}
                                                            </p>
                                                        </div>
                                                        <div class="product-card">

                                                            @php
                                                                $cartItemIds = session()->get('cart', []); // Get the cart or an empty array
                                                                $cartItemIds = collect($cartItemIds)
                                                                    ->keyBy('prodid')

                                                                    ->toArray(); // Convert to collection and pluck 'prodid'
                                                                //dd($cartItemIds);
                                                            @endphp
                                                            {{-- @dd($cartItemIds); --}}
                                                            {{-- @if (in_array($product->id, $cartItemIds)) --}}
                                                            @if (array_key_exists($product->id, $cartItemIds))
                                                                {{-- @dd($product->id); --}}
                                                                <div class="d-flex align-items-center"
                                                                    id="buttons-{{ $product->id }}">
                                                                    <!-- Decrement Button -->
                                                                    <button
                                                                        class="btn btn-outline-danger btn-sm decrease-qty"
                                                                        data-id="{{ $product->id }}">-</button>
                                                                    <!-- Quantity Input -->
                                                                    <input type="text"
                                                                        class="form-control qty-input mx-2"
                                                                        id="qty-{{ $product->id }}"
                                                                        value="{{ $cartItemIds[$product->id]['quantity'] ?? 1 }}"
                                                                        min="1"
                                                                        style="width: 60px; text-align: center;">
                                                                    <!-- Increment Button -->
                                                                    <button
                                                                        class="btn btn-outline-success btn-sm increase-qty"
                                                                        data-id="{{ $product->id }}">+</button>
                                                                </div>
                                                            @else
                                                                <div>
                                                                    {{-- <form action="{{ route('addtocart') }}" method="POST"
                                                                id="">
                                                            <input type="hidden" name="prodid"
                                                                    value="{{ $product->id }}">
                                                                @csrf --}}
                                                                    {{-- <button
                                                                    class="btn border border-secondary add-btn rounded-pill px-3 text-primary add-to-cart"
                                                                    data-id="{{ $product->id }}" name="submit"
                                                                    id="ajaxForm">
                                                                    <i
                                                                        class="fa fa-shopping-bag me-2 text-primary"></i>Add
                                                                    to Cart
                                                                </button> --}}

                                                                    <button id="add-to-cart-btn-{{ $product->id }}"
                                                                        class="btn add-to-cart btn-primary qty-input"
                                                                        data-product-id="{{ $product->id }}">
                                                                        Add to Cart
                                                                    </button>

                                                                    <div id="product-controls-{{ $product->id }}">
                                                                    </div>

                                                                    {{-- </form> --}}
                                                                    {{-- id="qty-{{ $product->id }}" --}}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{-- if user login --}}
                                    @else
                                        @foreach ($products as $product)
                                            {{-- @dd($product); --}}
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img">
                                                        <img src="{{ asset('product_images/' . $product->image) }}"
                                                            alt="" height="100">
                                                    </div>
                                                    {{-- @dd($product->image); --}}
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                        style="top: 10px; left: 10px;">{{ $product->name }}</div>
                                                    <div
                                                        class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4>{{ $product->desc }}</h4>
                                                        <p>Available Quantity:</p>
                                                        <p>{{ $product->qty }}</p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">
                                                                {{ $product->price }}
                                                            </p>
                                                        </div>
                                                        <div class="product-card">

                                                            @php
                                                                //$cartItemIds = session()->get('cart', []); // Get the cart or an empty array
                                                                // $cartItemIds = cart::get();
                                                                $userId = Auth::id();
                                                                $productId = $product->id; // Get the product id
                                                                $cartItemIds = \App\Models\Cart::get();
                                                                $cartItemIds = collect($cartItemIds)
                                                                    ->keyBy('prodid')
                                                                    ->toArray(); // Convert to collection and pluck 'prodid'
                                                                // dd($cartItemIds);
                                                            @endphp
                                                            {{-- @dd($cartItemIds); --}}
                                                            {{-- @if (in_array($product->id, $cartItemIds)) --}}
                                                            {{-- @if ($product->id) --}}
                                                            @if(isset($cartItemIds[$product->id]))
                                                                {{-- @dd($product); --}}
                                                                <div class="d-flex align-items-center"
                                                                    id="buttons-{{ $product->id }}">
                                                                    <!-- Decrement Button -->
                                                                    <button
                                                                        class="btn btn-outline-danger btn-sm decrease-qty"
                                                                        data-id="{{ $product->id }}">-</button>
                                                                    <!-- Quantity Input -->
                                                                    <input type="text"
                                                                            {{-- name="quantity" --}}
                                                                        class="form-control qty-input mx-2"
                                                                        id="qty-{{ $product->id }}"
                                                                        value="{{ $cartItemIds[$product->id]['quantity'] ?? 1 }}"
                                                                        {{-- value="{{ $cartItemIds[$product->id]['quantity'] ?? 1 }}" --}}
                                                                         {{-- value="{{ $cartItemIds[$product->qty]['qty'] ?? 1 }}" --}}
                                                                         {{-- value="{{[$product->id]['quantity'] ?? 1}}" --}}
                                                                         {{-- value="{{[$product->id]['quantity'] ?? 1}}"     --}}
                                                                         {{-- value="{{ optional($product->where('id', $product->id)->first())->quantity ?? 1 }}"  --}}
                                                                        min="1"
                                                                        style="width: 60px; text-align: center;">
                                                                    <!-- Increment Button -->
                                                                    
                                                                    <button
                                                                        class="btn btn-outline-success btn-sm increase-qty"
                                                                        data-id="{{ $product->id }}">+</button>
                                                                </div>
                                                                {{-- @dd($product) --}}
                                                            @else
                                                                <div>
                                                                    <button id="add-to-cart-btn-{{ $product->id }}"
                                                                        class="btn add-to-cart btn-primary qty-input"
                                                                        data-product-id="{{ $product->id }}">
                                                                        Add to Cart
                                                                    </button>

                                                                    <div id="product-controls-{{ $product->id }}">
                                                                    </div>

                                                                    {{-- </form> --}}
                                                                    {{-- id="qty-{{ $product->id }}" --}}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>
    <!-- Fruits Shop End-->





    <!-- Vesitable Shop Start-->

    <!-- Vesitable Shop End -->


    <!-- Banner Section Start-->
    {{-- <div class="container-fluid banner bg-secondary my-5">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="py-4">
                        <h1 class="display-3 text-white">Fresh Exotic Fruits</h1>
                        <p class="fw-normal display-3 text-dark mb-4">in Our Store</p>
                        <p class="mb-4 text-dark">The generated Lorem Ipsum is therefore always free from
                            repetition injected humour, or non-characteristic words etc.</p>
                        <a href="#"
                            class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">BUY</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="img/baner-1.png" class="img-fluid w-100 rounded" alt="">
                        <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute"
                            style="width: 140px; height: 140px; top: 0; left: 0;">
                            <h1 style="font-size: 100px;">1</h1>
                            <div class="d-flex flex-column">
                                <span class="h2 mb-0">50$</span>
                                <span class="h4 text-muted mb-0">kg</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Banner Section End -->


    <!-- Bestsaler Product Start -->

    <!-- Bestsaler Product End -->


    <!-- Fact Start -->

    <!-- Fact Start -->


    <!-- Tastimonial Start -->
    {{-- <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="testimonial-header text-center">
                <h4 class="text-primary">Our Testimonial</h4>
                <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                            style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the
                                industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded"
                                    style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                            style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the
                                industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded"
                                    style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                            style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the
                                industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="img/testimonial-1.jpg" class="img-fluid rounded"
                                    style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Tastimonial End -->


    <!-- Footer Start -->
    {{-- <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0">Fruitables</h1>
                            <p class="text-secondary mb-0">Fresh products</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number"
                                placeholder="Your Email">
                            <button type="submit"
                                class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white"
                                style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Like us!</h4>
                        <p class="mb-4">typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                        <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read
                            More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Shop Info</h4>
                        <a class="btn-link" href="">About Us</a>
                        <a class="btn-link" href="">Contact Us</a>
                        <a class="btn-link" href="">Privacy Policy</a>
                        <a class="btn-link" href="">Terms & Condition</a>
                        <a class="btn-link" href="">Return Policy</a>
                        <a class="btn-link" href="">FAQs & Help</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="">My Account</a>
                        <a class="btn-link" href="">Shop details</a>
                        <a class="btn-link" href="">Shopping Cart</a>
                        <a class="btn-link" href="">Wishlist</a>
                        <a class="btn-link" href="">Order History</a>
                        <a class="btn-link" href="">International Orders</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: 1429 Netus Rd, NY 48247</p>
                        <p>Email: Example@gmail.com</p>
                        <p>Phone: +0123 4567 8910</p>
                        <p>Payment Accepted</p>
                        <img src="img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Footer End -->

    <!-- Copyright Start -->
    {{-- <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your
                            Site Name</a>, All right
                        reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed
                    By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script> --}}
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Libraries Scripts -->
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('user/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template JavaScript -->
    <script src="{{ asset('user/js/main.js') }}"></script>

</body>

</html>

{{-- <script>
        $('.quantity button').on('click', function() {
            var button = $(this);
            var oldValue = button.parent().parent().find('input').val();
            if (button.hasClass('btn-plus')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            button.parent().parent().find('input').val(newVal);
        });
    </script> --}}

{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}

<script>
    // var add_btn = document.querySelector(".add-btn");
    // var buttons = document.querySelector("#buttons");

    // add_btn.addEventListener("click", function() {
    //     buttons.classList.remove("d-none");
    //     add_btn.classList.add("d-none");
    // });


    // document.addEventListener("DOMContentLoaded", function() {
    //     var add_btn = document.querySelector(".add-btn");
    //     var buttons = document.querySelector("#buttons");

    //     add_btn.addEventListener("click", function() { 
    //         buttons.classList.remove("d-none");
    //         add_btn.classList.add("d-none");
    //     });
    // });
</script>
{{-- <script>
            $(document).ready(function() {
                // Increment Quantity
                $('.increase-qty').on('click', function() {
                    let input = $(this).siblings('.qty-input');
                    let currentQty = parseInt(input.val());
                    input.val(currentQty + 1);
                });
        
                // Decrement Quantity
                $('.decrease-qty').on('click', function() {
                    let input = $(this).siblings('.qty-input');
                    let currentQty = parseInt(input.val());
                    if (currentQty > 1) {
                        input.val(currentQty - 1);
                    }
                });
        
                // Add to Cart
                $('.add-to-cart').on('click', function(e) {
                    e.preventDefault();
        
                    let productId = $(this).data('id');
                    let qty = $(this).siblings('.d-flex').find('.qty-input').val();
        
                    $.ajax({
                         url: '{{ route('cart.store') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            prodid: productId,
                            quantity: qty,
                        },
                        success: function(response) {
                            alert(response.message);
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                });
            });
        </script> --}}

{{-- // original --}}
{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add to Cart button click
        document.querySelectorAll('.add-to-cart').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const productId = btn.getAttribute('data-id');
                const buttonGroup = document.getElementById(`buttons-${productId}`);
                buttonGroup.classList.remove('d-none'); // Show increment/decrement buttons
                btn.style.display = 'none'; // Hide "Add to Cart" button
            });
        });

        // Increment button click
        document.querySelectorAll('.increase-qty').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const productId = btn.getAttribute('data-id');
                const qtyInput = document.getElementById(`qty-${productId}`);
                qtyInput.value = parseInt(qtyInput.value) + 1;
            });
        });

        // Decrement button click
        document.querySelectorAll('.decrease-qty').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const productId = btn.getAttribute('data-id');
                const qtyInput = document.getElementById(`qty-${productId}`);
                if (qtyInput.value > 1) {
                    qtyInput.value = parseInt(qtyInput.value) - 1;
                } else {
                    // If quantity is 1, revert UI to show Add to Cart button
                    qtyInput.value = 1; // Ensure the quantity stays at 1
                    const buttonGroup = document.getElementById(`buttons-${productId}`);
                    const addToCartButton = document.querySelector(
                        `.add-to-cart[data-id='${productId}']`);
                    buttonGroup.classList.add('d-none'); // Hide increment/decrement buttons
                    addToCartButton.style.display = 'inline-block'; // Show "Add to Cart" button
                }
            });
        });
    });
</script> --}}

{{-- ajax crud --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Add to Cart button click event
        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            // alert('Product');
            $.ajax({
                url: "{{ route('addtocart') }}",
                // alert(url);
                method: "POST",
                data: {
                    product_id: productId,
                    quantity: 1
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // alert('Product');
                success: function(response) {
                    // dd(response)

                    // $(`#qty-${productId}`).val(response.new_quantity);
                    // $('#shop_count').text(response.total);

                    // if (response) {
                    //     $(`#qty-${productId}`).val(response.new_quantity);
                    //     $('#shop_count').text(response.total);
                    // } else 
                    // {
                    //     $(`#add-to-cart-btn-${productId}`).show();
                    //     $(`#product-controls-${productId}`).empty();
                    // }

                    // if (response) {
                    //     if (response.new_quantity <= 0) {
                    //         $(`#add-to-cart-btn-${productId}`).show();
                    //         $(`#product-controls-${productId}`).empty();
                    //     } 
                    //     $('#shop_count').text(response.total);
                    //     $(`#qty-${productId}`).val(response.new_quantity);
                    // } else {
                    //     // In case of an invalid response, reset controls
                    //     $(`#add-to-cart-btn-${productId}`).show();
                    //     $(`#product-controls-${productId}`).empty();
                    // }
                    if (response) {
                        if (response.new_quantity <= 0) {
                            $(`#add-to-cart-btn-${productId}`).show();
                            $(`#product-controls-${productId}`).empty();
                        }
                        $('#shop_count').text(response.total);
                        $(`#qty-${productId}`).val(response.new_quantity);
                    } else {
                        $(`#add-to-cart-btn-${productId}`).show();
                        $(`#product-controls-${productId}`).empty();
                    }

                    // without load A
                    // if (response.success) {
                    $(`#add-to-cart-btn-${productId}`).hide();

                    $(`#product-controls-${productId}`).html(`
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-danger btn-sm decrease-qty" data-id="${productId}">-</button>
                        <input type="text" class="form-control qty-input mx-2" id="qty-${productId}" value="1" min="1" style="width: 60px; text-align: center;">
                        <button class="btn btn-outline-success btn-sm increase-qty" data-id="${productId}">+</button>
                    </div>
                `);

                    $('#responseMessage').text(response.message).css('color', 'green');
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON?.message || 'An error occurred.';
                    $('#responseMessage').css('color', 'red').text(errorMessage);
                }
            });
        });

        // Increment quantity
        // $(document).on('click', '.increase-qty', function() {
        //     const productId = $(this).data('id');
        //     const qtyInput = $(`#qty-${productId}`);
        //     qtyInput.val(parseInt(qtyInput.val() || 1) + 1);
        // });

        // // Decrement quantity
        // $(document).on('click', '.decrease-qty', function() {
        //     const productId = $(this).data('id');
        //     const qtyInput = $(`#qty-${productId}`);
        //     let currentQty = parseInt(qtyInput.val() || 1);
        //     if (currentQty > 1) {
        //         qtyInput.val(currentQty - 1);
        //     } else {
        //         // Revert to "Add to Cart" button
        //         $(`#add-to-cart-btn-${productId}`).show();
        //         $(`#product-controls-${productId}`).empty();
        //     }
        // });
    });
</script>

{{-- <script>
    $(document).ready(function() {
        // Add to Cart button click event
        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');

            $.ajax({
                url: "{{ route('addtocart') }}",
                method: "POST",
                data: {
                    product_id: productId,
                    quantity: 1
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    let qty = response.cart[productId]?.quantity ||
                    1; // Get updated quantity
                    $(`#add-to-cart-btn-${productId}`).hide();
                    $(`#product-controls-${productId}`).html(`
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-danger btn-sm decrease-qty" data-id="${productId}">-</button>
                        <input type="text" class="form-control qty-input mx-2" id="qty-${productId}" value="${qty}" min="1" style="width: 60px; text-align: center;">
                        <button class="btn btn-outline-success btn-sm increase-qty" data-id="${productId}">+</button>
                    </div>
                `);
                    $('#responseMessage').text(response.message).css('color', 'green');
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON?.message || 'An error occurred.';
                    $('#responseMessage').css('color', 'red').text(errorMessage);
                }
            });
        });

        // Increase quantity
        $(document).on('click', '.increase-qty', function() {
            let productId = $(this).data('id');
            updateCart(productId, 1);
        });

        // Decrease quantity
        $(document).on('click', '.decrease-qty', function() {
            let productId = $(this).data('id');
            updateCart(productId, -1);
        });

        function updateCart(productId, change) {
            let currentQty = parseInt($(`#qty-${productId}`).val()) || 1;
            let newQty = currentQty + change;
            if (newQty < 1) return;

            $.ajax({
                url: "{{ route('addtocart') }}",
                method: "POST",
                data: {
                    product_id: productId,
                    quantity: change
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $(`#qty-${productId}`).val(response.cart[productId].quantity);
                }
            });
        }
    });
</script> --}}



{{-- button increment + and - decrement  --}}
<script>
    $(document).on('click', '.increase-qty', function() {
        // e.preventDefault();
        const productId = $(this).data('id');

        $.ajax({
            url: "{{ route('cart.increment_new') }}",
            method: "POST",
            data: {
                prodid: productId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // alert(1);
                //  console.log(response);
                $(`#qty-${productId}`).val(response.new_quantity);
                $('#shop_count').text(response.total);
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    });

    $(document).on('click', '.decrease-qty', function() {
        // e.preventDefault();
        const productId = $(this).data('id');

        $.ajax({
            url: "{{ route('cart.decrement_new') }}",
            method: "POST",
            data: {
                prodid: productId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.new_quantity > 0) {
                    $(`#qty-${productId}`).val(response.new_quantity);
                    $('#shop_count').text(response.total);
                } else {
                    $(`#add-to-cart-btn-${productId}`).show();
                    $(`#product-controls-${productId}`).empty();
                    $(`#qty-${productId}`).val(response.new_quantity);
                    $('#shop_count').text(response.total);
                }
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    });
</script>
