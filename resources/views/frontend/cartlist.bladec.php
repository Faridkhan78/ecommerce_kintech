@include('frontend.header')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">

            @if (!empty($datas))

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                      {{-- if(){ --}}
                        @foreach ($datas as $data)
                            {{-- @dd($data)                    --}}

                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        {{-- <img src="{{ asset('user/img/vegetable-item-3.png') }}" --}}
                                        <img src="{{ asset('product_images/' . $data->image) }}"
                                            class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                            alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $data->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ $data->price }}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0"
                                            value="{{ $data->quantity }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $totalPrice = $data->quantity * $data->price;
                                    @endphp

                                    {{-- <td>{{ $item->quantity * $item->product->price }}</td> --}}
                                    <p class="mb-0 mt-4">{{ $totalPrice }}</p>
                                </td>
                                <form method="post" action="{{ route('delete_cartlist', $data->id) }}">
                                    {{-- <form> --}}
                                    @csrf
                                    @method('DELETE') <!-- Spoof DELETE method -->
                                    <td>
                                        <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>
                                </form>
                                {{-- <form method="post" action="">
                                    <td>
                                        <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>
                                </form> --}}

                                {{-- "{{url('delete-user',$user->id)}}" --}}

                            </tr>
                        @endforeach
                      {{-- }else{
                        
                      } --}}
                    </tbody>
                </table>
        </div>
        <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply
                Coupon
            </button>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>

                            {{-- <p class="mb-0"> {{ array_sum(array_column($datas, 'quantity')) }}</p> --}}
                            {{-- <p class="mb-0"> {{array_sum($totalPrice)}}</p> --}}

                            @php
                                $totalPrice = $datas->sum(fn($data) => $data->quantity * $data->price);
                            @endphp

                            <p class="mb-0">Total Price:
                                {{-- <b>{{ $datas->sum(fn($data) => $data->quantity * $data->price) }}</b> --}}
                                <b>{{ $totalPrice }}</b>
                            </p>

                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div class="">
                                <p class="mb-0">Flat rate: $3.00</p>
                            </div>
                        </div>
                        <p class="mb-0 text-end">Shipping to Ukraine.</p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        @php
                            $GtotalPrice = $totalPrice + 3;
                        @endphp
                        <p class="mb-0 pe-4">{{ $GtotalPrice }}</p>
                    </div>

                    @endif
                    {{-- <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                        type="button">Proceed Checkout</button> --}}
                    <div class="">
                        <a class="btn btn-success" href="/checkout">Order Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->
@include('frontend.footer')
