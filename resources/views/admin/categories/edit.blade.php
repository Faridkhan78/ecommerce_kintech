@extends('admin.master')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <h1>Edit Category</h1>
                {{-- <form action="{{url('update_user'}}" enctype="multipart/form-data" method="POST"> --}}
                <form action="{{ url('update-category', $cat->id)}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="text" value="{{ $cat->name }}" name="cname" class="form-control"
                        placeholder="Name"><br>

                    <select name="cstatus" id="" class="form-control">
                        <option value="">Select Status</option>
                        <option value="active"{{($cat->status=="active")?"selected":""}}> Active</option>
                        <option value="deactive"{{($cat->status=="deactive")?"selected":""}}>Deactive</option>
                    </select>

                    <input type="submit" value="Submit" class="btn btn-primary mt-3">
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
