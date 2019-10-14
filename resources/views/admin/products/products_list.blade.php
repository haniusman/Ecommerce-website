@extends('layouts.admin_layout.admin_design')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Products
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#">Products</a></li>
                <li class="active">Products list</li>
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
                            <h3 class="box-title" id="prd" >Products</h3>
                        </div>
                        <div>
                            <a href="{{url('admin1/add_product')}}" class="btn btn-success" style="float:right; margin:10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add new Product</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Product code</th>
                                    <th>Product color</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->category_name}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->product_code}}</td>
                                        <td>{{$product->product_color}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>
                                            @if(!empty($product->image))
                                        <img src="{{asset('/images/products/small/'.$product->image)}}" style="width:70px;">
                                        @endif
                                        </td>
                                        <td>
                                            <a href="#myModal{{$product->id}}" data-toggle="modal" title="View Product" class="btn btn-success">View</a>
                                            <a href="{{url('/admin1/add-attribute/'.$product->id)}}" data-toggle="modal" id="add_attribute" title="Add Attributes" class="btn btn-warning">Add</a>
                                            <a href="{{url('/admin1/add-images/'.$product->id)}}" data-toggle="modal" id="add_attribute" title="Add Images" class="btn btn-info">Add</a>
                                            <a href="{{url('/admin1/edit-product/'.$product->id)}}" title="Edit Product" class="btn btn-primary">Edit</a>
                                            <a href="{{url('/admin1/delete-product/'.$product->id)}}" id="delProduct" title="Delete Product" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>


                                    <!--popup -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal{{$product->id}}" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">{{$product->product_name}}  Full Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Product ID : {{$product->id}}</p>
                                                    <p>Category ID : {{$product->category_id}}</p>
                                                    <p>Category Name : {{$product->category_name}}</p>
                                                    <p>Product Name : {{$product->product_name}}</p>
                                                    <p>Product Code : {{$product->product_code}}</p>
                                                    <p>Product Color : {{$product->product_color}}</p>
                                                    <p>Price : {{$product->price}}</p>
                                                    <p>Description : {{$product->description}}</p>
                                                    <p>Care : {{$product->care}}</p>

                                                @if(!empty($product->image))
                                                        <img src="{{asset('/images/products/medium/'.$product->image)}}" style="width:250px; ">
                                                    @endif

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


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
<script>
    $("#delProduct").click(function(){
        if(confirm('Are you sure you want to delete the product?'))
        {
          return true;
        }
        return false;
    });

</script>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



@endsection