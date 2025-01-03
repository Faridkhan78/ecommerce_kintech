@extends('admin.master')
@section('content')
{{-- <form action=""> --}}
  <div class="container">
    <div class="row mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-5">
            <h1>Add Product</h1>
            <form action="{{url('store-product')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="text" name="name" class="form-control" placeholder="Name"><br>
                <input type="text" name="desc" class="form-control" placeholder="Desc"><br>
                <input type="number" name="price" class="form-control" placeholder="price"><br>
                <input type="number" name="qty" class="form-control" placeholder="Quantity"><br>
              
                <input type="file" name="image" class="form-control" placeholder="Image"><br>
                <input type="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
  </div>
{{-- </form> --}}
@endsection