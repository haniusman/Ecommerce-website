@extends('layouts.admin_layout.admin_design')
@section('content')

    <div class="content-wrapper">



        @if(Session::has('error'))

            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('error') !!}</strong>
            </div>
        @endif

        @if(Session::has('update_message'))

            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('update_message') !!}</strong>
            </div>
    @endif
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <section class="content-header">
                <h1>
                    Add banners
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="#">Banners</a></li>
                    <li class="active">Add new banner</li>
                </ol>
            </section>
            <br><br>

            <!-- Banners form -->
            <form enctype="multipart/form-data" name="add_banner" id="add_banner" method="post" action = "{{url('admin1/add-banner')}}"  >
            {{csrf_field()}}

            <!--Banner image -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Banner Image</label>
                    <input type="file" class="custom-file-input"name="image" id="image">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>

                <!--Banner Title -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control"name="title" id="title" placeholder="Enter title">
                </div>

                <!--Link -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Link</label>
                    <input type="text" class="form-control"name="link" id="link" placeholder="Enter Link">
                </div>


                <!--Banner enable/disable -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Enable </label>
                    <input type="checkbox" class=""name="status" id="status" value="1">
                </div>

                <a href="{{ url()->previous()}}"  class="btn btn-primary"><i class="fa fa-backward"></i> &nbsp;&nbsp;Back</a>
                <button type="submit" class="btn btn-primary" style="float: right">Add Banner</button>
            </form>


        </section>
    </div>

    <!-- /.content-wrapper -->
@endsection