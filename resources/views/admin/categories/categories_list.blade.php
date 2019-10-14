@extends('layouts.admin_layout.admin_design')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Categories
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#">Categories</a></li>
                <li class="active">Categories list</li>
            </ol>
        </section>

        <!-- Main content -->
        <br>
        @if(Session::has('update_message'))

            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('update_message') !!}</strong>
            </div>
        @endif
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Categories</h3>
                        </div>
                        <div>
                            <a href="{{url('admin1/add-category')}}" class="btn btn-success" style="float:right; margin:10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add new Category</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Category Level</th>
                                    <th>Description</th>
                                    <th>Url</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->parent_id}}</td>
                                        <td>{{$category->description}} </td>
                                        <td>{{$category->url}} </td>
                                        <td>
                                            <a href="{{url('/admin1/edit-category/'.$category->id)}}" class="btn btn-primary">Edit</a>
                                            <a href="{{url('/admin1/delete-category/'.$category->id)}}" id="delCat" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



@endsection