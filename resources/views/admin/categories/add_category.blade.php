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
            <section class="content-header">
                <h1>
                    Add categories
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="#">Categories</a></li>
                    <li class="active">Add new category</li>
                </ol>
            </section>
            <br><br>

            <!-- Category form -->
            <form  name="add_category" id="add_category" method="post" action = "{{url('admin1/add-category')}}"  >
                {{csrf_field()}}
                <!--category name -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" class="form-control"name="category_name" id="category_name" placeholder="Enter category name">
                </div>

                    <!--main-categories -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Level</label>
                        <select class="form-control" name="parent_id">
                            <option value="0">Main Category</option>
                            @foreach($levels as $val)
                                <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!--category description -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Description </label>
                    <textarea class="form-control" name="description" id="description"></textarea>
                    </div>

                    <!--category url -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Url </label>
                        <input type="text" class="form-control"name="url" id="url" placeholder="Enter url">
                    </div>

                    <!--category enable/disable -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enable </label>
                        <input type="checkbox" class=""name="status" id="status" value="1">
                    </div>

                    <a href="{{ url()->previous()}}"  class="btn btn-primary"><i class="fa fa-backward"></i> &nbsp;&nbsp;Back</a>
                    <button type="submit" class="btn btn-primary" style="float: right">Add Category</button>
            </form>


        </section>
    </div>

    <!-- /.content-wrapper -->
@endsection