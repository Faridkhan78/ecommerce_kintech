@include('frontend.header')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">OrderList</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
        <li class="breadcrumb-item active text-white">OrderList</li>
    </ol>
</div>
<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">

            {{-- @if (!empty($total)) --}}

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Order List</th>
                        <th scope="col">Description</th>
                        {{-- <th scope="col">Status</th> --}}
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        {{-- <th scope="col">Handle</th> --}}
                    </tr>
                </thead>
                <tbody>

                    @foreach ($total as $data)
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
                                <p class="mb-0 mt-4"><b> Customer Name:</b> &nbsp; &nbsp; {{ $data->firstname }}</p>
                                <p class="mb-0 mt-4"><b> Customer Lastname:</b> &nbsp; &nbsp; {{ $data->lastname }}</p>
                                <p class="mb-0 mt-4"><b> Mobile Number:</b> &nbsp; &nbsp; {{ $data->mobile}}</p>
                                <p class="mb-0 mt-4"><b> Product Name:</b> &nbsp; &nbsp; {{ $data->name }}</p>
                                <p class=""><b>Delivery Status:</b> &nbsp; {{ $data->status }}</p>
                                <p class=""><b> Payment Status:</b> &nbsp;  {{ $data->payment_status }}</p>
                                <p class=""><b> Payment Method:</b> &nbsp; {{ $data->payment_method}}</p>
                                <p class=""><b> Delivery Address:</b> &nbsp;  {{ $data->address2}}</p>
                                {{-- <p class=""><b>Price:</b>&nbsp;  {{ $data->price}}</p> --}}
                            </td>
                            {{-- <td>
                                    <p class="mb-0 mt-4">{{ $data->status}}</p>
                                    {{-- @dd($data->status) --}}
                            {{-- </td> --}}
                            <td>
                                <p class="mb-0 mt-4">{{ $data->price }}</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    {{-- <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            {{-- <i class="fa fa-minus"></i> --}}
                                        {{-- </button> --}}
                                    {{-- </div> --}} 
                                    <input type="text" class="form-control form-control-sm text-center border-0"
                                        value="{{ $data->quantity }}">
                                    {{-- <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            {{-- <i class="fa fa-plus"></i> --}}
                                        {{-- </button> --}}
                                    {{-- </div> --}} 
                                </div>
                            </td>
                            <td>
                                @php
                                    $totalPrice = $data->quantity * $data->price;
                                @endphp

                                {{-- <td>{{ $item->quantity * $item->product->price }}</td> --}}
                                <p class="mb-0 mt-4">{{ $totalPrice }}</p>
                            </td>
                            {{-- <form method="post" action="{{ route('delete_cartlist', $data->id) }}">
                                {{-- <form> --}}
                                {{-- @csrf
                                @method('DELETE') <!-- Spoof DELETE method -->
                                <td>
                                    <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>
                            </form> --}} 
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
                </tbody>
            </table>



        </div>
                </div>
            </div>
        {{-- </div> --}} 
    </div>
</div>
<!-- Cart Page End -->
@include('frontend.footer')
