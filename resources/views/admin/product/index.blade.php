@extends('admin.master')
@section('content')
    <div class="midde_cont">
        <div class="container-fluid">
            <div class="row column_title">
                <div class="col-md-12">
                    <div class="page_title">
                        <h2>Tables</h2>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <!-- table section -->

                <!-- table section -->
                <div class="col-md-12">
                    <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>All Product</h2>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-sm">
                                <div class="d-flex justify-content-end">
                                    <a href="{{url('create-product')}}" class="btn btn-primary">Add Product</a>
                                </div>
                                <table class="table mt-2">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @dd($products) --}}
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{$product->id}}</td>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->desc}}</td>
                                                <td>{{$product->price}}</td>
                                                <td>{{$product->qty}}</td>
                                                {{-- <td>{{$product->image}}</td> --}}
                                                
                                                {{-- @dd($product) --}}
                                                <td>
                                                    <img src="{{asset('product_images/'.$product->image)}}" alt="" height="100">
                                                </td>
                                                {{-- <td>  <img src="{{asset($product->image)}}" alt="" height="100">  </td> --}}
                                                 {{-- <td> <img src="{{ $product->image ? asset($product->image) : asset('image/placeholder.png') }}" alt="" height="100"></td> --}}

                                                  {{-- @dd($product->image) --}}
                                                <td>
                                                    <a href="{{url('edit-product',$product->id)}}" class="btn btn-warning">Edit</a>
                                                    <a href="{{url('delete-product',$product->id)}}" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
