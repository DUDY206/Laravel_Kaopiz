@extends('layouts.app')

@section('content')
    <div class="content-wrapper" style="min-height: 2366.94px;">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Find user</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{url('/users/find1')}}"
                                  method="GET">
                                <div class="card-body row">
                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">User ID</label>
                                        <input type="text" class="form-control"
                                               placeholder="Enter user_id" name="user_id">
                                    </div>
                                    @csrf
                                    <div class="form-group col-md-4">
                                        <label for="exampleInputPassword1">
                                            Name</label>
                                        <input type="text" class="form-control"
                                               placeholder="Enter name" name="user_name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="exampleInputPassword1">
                                            Phone number</label>
                                        <input type="text" class="form-control"
                                               placeholder="Phone number"
                                               name="phone_number">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn
                                        btn-primary">Search</button>
                                    </div>
                                    <div class="form-group col-md-12">
                                        @if(isset($users))
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>UserName</th>
                                                    <th>Name</th>
                                                    <th>PhoneNumber</th>
                                                    <th>Role</th>
                                                    <th>Active</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    @endphp
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td>{{$loop->index-4+$users->currentPage()*5}}</td>
                                                        <td>{{$user->user_name}}</td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->phone_number}}</td>
                                                        <td>{{$user->role}}</td>
                                                        <td>{{$user->is_active}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    @if(isset($users))
                                        {{$users->links()}}
                                    @endif
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->



                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
