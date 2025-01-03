@extends('admin.master')
@section('content')
{{-- <form action=""> --}}
  <div class="container">
    <div class="row mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-5">
            <h1>Add Customer</h1>
            <form action="{{route('store_user')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="text" name="cname" class="form-control" placeholder="Name"><br>
                <input type="email" name="cemail" class="form-control" placeholder="Email"><br>
                <input type="password" name="cpass" class="form-control" placeholder="Password"><br>
                <input type="number" name="cnum" class="form-control" placeholder="Number"><br>
                <input type="text" name="caddress" class="form-control" placeholder="Address"><br>
                <input type="file" name="cimg" class="form-control" placeholder="Image"><br>
                <input type="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
  </div>
{{-- </form> --}}
@endsection