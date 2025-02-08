@extends('admin.master')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <h1>Edit Customer</h1>
                {{-- <form action="{{url('update_user'}}" enctype="multipart/form-data" method="POST"> --}}
                <form  action="{{url('update-product', $product->id)}}"  enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="text" value="{{ $product->name}}"  name="name" class="form-control" placeholder="Name"><br>
                    <input type="text" value="{{ $product->desc}}" name="desc" class="form-control" placeholder="Description"><br>
                    <input type="number" value="{{ $product->price}}" name="price" class="form-control" placeholder="Price"><br>
                    <input type="number" value="{{ $product->qty}}" name="qty" class="form-control" placeholder="Quantity"><br>
                    {{-- <input type="text" value="{{ $product->address}}" name="caddress" class="form-control" placeholder="Address"><br> --}}
                    <img src="{{asset('product_images/'.$product->image)}}" alt=""/>
                    {{-- @dd($product->image) --}}
                    <input type="file" name="image" class="form-control" placeholder="Image"><br>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
