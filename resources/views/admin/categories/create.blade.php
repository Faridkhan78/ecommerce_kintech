@extends('admin.master')
@section('content')
{{-- <form action=""> --}}
  <div class="container">
    <div class="row mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-5">
            <h1>Add Category</h1>
            <form action="{{url('store-category')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="text" name="cname" class="form-control" placeholder="Name"><br>
             
                <select name="cstatus" id="" class="form-control">
                  <option value="0">Select Status</option>
                  <option value="active">Active</option>
                  <option value="deactive">Deactive</option>
                </select>
                <input type="submit" value="Submit" class="btn btn-primary mt-3">
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
  </div>
{{-- </form> --}}
@endsection