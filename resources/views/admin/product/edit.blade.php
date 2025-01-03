@extends('admin.master')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <h1>Edit Customer</h1>
                {{-- <form action="{{url('update_user'}}" enctype="multipart/form-data" method="POST"> --}}
                <form  action="{{url('update-user', $user->id)}}"  enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="text" value="{{ $user->name}}"  name="cname" class="form-control" placeholder="Name"><br>
                    <input type="email" value="{{ $user->email}}" name="cemail" class="form-control" placeholder="Email"><br>
                    <input type="password" value="{{ $user->password}}" name="cpass" class="form-control" placeholder="Password"><br>
                    <input type="number" value="{{ $user->number}}" name="cnum" class="form-control" placeholder="Number"><br>
                    <input type="text" value="{{ $user->address}}" name="caddress" class="form-control" placeholder="Address"><br>
                    <img src="{{asset($user->image)}}" alt=""/>
                    <input type="file" name="cimg" class="form-control" placeholder="Image"><br>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
