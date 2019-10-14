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
                    Add Product Images
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="#">Products</a></li>
                    <li class="active">Add Product Images</li>
                </ol>
            </section>
            <br><br>

            <!-- Product form -->
            <form enctype="multipart/form-data" name="add_attribute" id="add_attribute" method="post" action = "{{url('admin1/add-images/'.$productDetails->id)}}"  >
            {{csrf_field()}}

            <!-- product id hidden field to pass to addAttribute function -->
                <input type="hidden" name="product_id" value="{{$productDetails->id}}"/>

                <!--product name -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <h4 class="control-label">{{$productDetails->product_name}}</h4>
                </div>

                <!--product code -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Code</label>
                    <h4 class="control-label">{{$productDetails->product_code}}</h4>
                </div>

                <!--product image -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Alternate Image(s)</label>
                    <input type="file" class="custom-file-input"name="image[]" id="image" multiple="multiple">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>


                <a href="{{ url()->previous()}}"  class="btn btn-primary"><i class="fa fa-backward"></i> &nbsp;&nbsp;Back</a>
                <button type="submit" class="btn btn-primary" style="float: right">Add Images</button>
            </form>
            <br><br><br>

            <!--  product attributes data table start -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title" id="prd" >Product Images</h3>
                        </div>

                        <div class="box-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Image ID</th>
                                    <th>Product ID</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productImages as $image)
                                    <tr>
                                        <td>{{$image->id}}</td>
                                        <td>{{$image->product_id}}</td>
                                        <td>
                                            @if(!empty($image->image))

                                                <img src="{{asset('/images/products/small/'.$image->image)}}" style="width:70px;">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('admin1/delete-alt-image/'.$image->id)}}" id="delImage" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- product attributes data table end -->


        </section>
    </div>

    <!-- /.content-wrapper -->
@endsection