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
                    Add product attributes
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="#">Products</a></li>
                    <li class="active">Add product attributes</li>
                </ol>
            </section>
            <br><br>

            <!-- Product form -->
            <form enctype="multipart/form-data" name="add_attribute" id="add_attribute" method="post" action = "{{url('admin1/add-attribute/'.$productDetails->id)}}"  >
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

                <!--product color -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Product color</label>
                    <h4 class="control-label">{{$productDetails->product_color}}</h4>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <div class="field_wrapper">
                        <div>
                            <input type="text" name="sku[]" id="sku" placeholder="SKU" required/>
                            <input type="text" name="size[]" id="size" placeholder="Size" required/>
                            <input type="text" name="price[]" id="price" placeholder="Price" required/>
                            <input type="text" name="stock[]" id="stock" placeholder="Stock" required/>

                            <a href="javascript:void(0);" class="add_button" title="Add field">
                                Add
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ url()->previous()}}"  class="btn btn-primary"><i class="fa fa-backward"></i> &nbsp;&nbsp;Back</a>
                <button type="submit" class="btn btn-primary" style="float: right">Add</button>
            </form>
<br><br><br>

            <!--  product attributes data table start -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title" id="prd" >Product Attributes</h3>
                        </div>

                        <div class="box-body">
                            <form action="{{url('/admin1/edit-attribute/'.$productDetails->id)}}" method="post">
                                {{csrf_field()}}
                                <table id="table" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Attribute ID</th>
                                        <th>SKU</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($productDetails['attributes'] as $attribute)
                                        <tr>
                                            <td><input type="hidden" name="idAttr[]" value="{{$attribute->id}}">{{$attribute->id}}</td>
                                            <td>{{$attribute->sku}}</td>
                                            <td>{{$attribute->size}}</td>
                                            <td><input type="text" name="price[]" value="{{$attribute->price}}"></td>
                                            <td><input type="text" name="stock[]" value="{{$attribute->stock}}"></td>
                                            <td>
                                                <input type="submit" value="Update" class="btn btn-primary btn-mini">
                                                <a href="{{url('/admin1/delete-attribute/'.$attribute->id)}}" id="delAttribute" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        <!--popup -->
                                    @endforeach
                                    </tbody>
                                </table>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- product attributes data table end -->


        </section>
    </div>

    <!-- /.content-wrapper -->
@endsection