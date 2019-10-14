@extends('layouts.admin_layout.admin_design')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <form method="post" action = "{{url('admin1/users',$users->id)}}">
                <input type="hidden" name="_method" value="PUT">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control"name="name" placeholder="" value="{{$users->name}}">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name ="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$users->email}}">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="admin" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Admin</label>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </section>
    </div>

<!-- /.content-wrapper -->
    @endsection