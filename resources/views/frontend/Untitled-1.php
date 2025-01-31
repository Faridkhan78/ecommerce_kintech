<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">

            <div class="site-blocks-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="product-thumbnail">Image</th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-total">Total</th>
                            <th class="product-remove">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session()->has('user'))
                        @foreach($products as $product)

                        <tr>
                            <td class="product-thumbnail">
                                <img src="{{ asset('storage/' . $product->image_1) }}" alt="Image" class="img-fluid">
                            </td>
                            <td class="product-name">
                                <h2 class="h5 text-black">{{ $product->f_name }}</h2>
                            </td>
                            <td>₹<span class="product-price">{{ $product->price }}</span></td>
                            <td>
                                <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                    <div class="input-group">
                                        <button class="btn btn-outline-black decrease" type="button" data-cart-id="{{ $product->id }}" onclick="decrease({{ $product->id }})">&minus;</button>
                                        <input type="text" class="form-control text-center quantity-amount" data-cart-id="{{ $product->id }}" value="{{ $product->quantity }}" />
                                        <button class="btn btn-outline-black increase" type="button" data-cart-id="{{ $product->id }}" onclick="increase({{ $product->id }})">&plus;</button>
                                    </div>
                                </div>
                            </td>
                            <td>₹<span class="item-total">{{ $product->total_price }}</span></td>
                            <td>
                                <!-- Correctly pass the cart_id to the route -->
                                <a href="{{ route('remove.cart', ['id' => $product->id]) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">X</a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        @foreach(session('cart', []) as $item)

                        <tr>
                            <td class="product-thumbnail">
                                @if(isset($item['image_1']) && !empty($item['image_1']))
                                <img src="{{ asset('storage/' . $item['image_1']) }}" alt="Image" class="img-fluid">
                                @else
                                <img src="{{ asset('storage/default-image.jpg') }}" alt="Default Image" class="img-fluid">
                                @endif
                            </td>
                            <td class="product-name">
                                <h2 class="h5 text-black">{{ $item['f_name'] }}</h2>
                            </td>
                            <td>₹<span class="product-price">{{ $item['price'] }}</span></td>
                            <td>

                                @if(isset($item['id']) && isset($item['quantity']))

                                <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                    <div class="input-group">
                                        <button class="btn btn-outline-black decrease" type="button" data-cart-id="{{ $item['id'] }}" onclick="decrease_s({{ $item['id'] }})">&minus;</button>

                                        <input type="text" class="form-control text-center quantity-amount" data-cart-id="{{ $item['id'] }}" value="{{ $item['quantity'] }}" />
                                        <button class="btn btn-outline-black increase" type="button" data-cart-id="{{ $item['id'] }}" onclick="increase_s({{ $item['id'] }})">&plus;</button>
                                        @else
                                        <!-- Handle the case where 'cart_id' or 'quantity' is not set -->
                                        <!-- <p>Cart ID or Quantity missing</p> -->
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>₹<span class="item-total">{{ $item['total_price'] }}</span></td>
                            <td>
                                @if(isset($item['id']))
                                <!-- Correctly pass the cart_id to the route -->
                                <a href="{{ route('remove.cart', ['id' => $item['id']]) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">X</a>
                                @else

                                <!-- <span>Cart ID Missing</span> -->
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif