@extends('layouts.admin_layout.admin_design')

@section('content')
    <div class="content-wrapper">



        @if(Session::has('error'))

            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('error') !!}</strong>
            </div>
    @endif
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="box-header">
                <h3 class="box-title">ADD NEW USER</h3>
            </div>
            <br><br>
            <form method="post" action = "{{url('admin1/users')}}" >
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control"name="name" placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name ="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Retype Password</label>
                    <input type="password" class="form-control" name="r_password" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="admin" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Admin</label>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </section>
    </div>

    <!-- /.content-wrapper -->
@endsection