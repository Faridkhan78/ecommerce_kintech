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
                                <h2>All Customer</h2>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-sm">
                                <div class="d-flex justify-content-end">
                                    <a href="{{url('create-user')}}" class="btn btn-primary">Add User</a>
                                </div>
                                <table class="table mt-2">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>Address</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->number}}</td>
                                                <td>{{$user->address}}</td>
                                                <td><img src="{{asset($user->image)}}" alt="" height="100">  </td>
                                                <td>
                                                    <a href="{{url('edit-user',$user->id)}}" class="btn btn-warning">Edit</a>
                                                    <a href="{{url('delete-user',$user->id)}}" class="btn btn-danger">Delete</a>
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
