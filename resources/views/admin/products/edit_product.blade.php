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
                    Edit products
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="#">Products</a></li>
                    <li class="active">Edit product</li>
                </ol>
            </section>
            <br><br>

            <!-- Product form -->
            <form enctype="multipart/form-data" name="edit_product" id="edit_product" method="post" action = "{{url('/admin1/edit-product/'.$productDetails->id)}}"  >
            {{csrf_field()}}

            <!--main-categories -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Under category </label>
                    <select class="form-control" name="category_id">
                        <?php echo $categories_dropdown; ?>
                    </select>
                </div>

                <!--product name -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control"name="product_name" id="product_name" value="{{$productDetails->product_name}}">
                </div>

                <!--product code -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Code</label>
                    <input type="text" class="form-control"name="product_code" id="product_code" value="{{$productDetails->product_code}}">
                </div>

                <!--product color -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Product color</label>
                    <input type="text" class="form-control"name="product_color" id="product_color" value="{{$productDetails->product_color}}">
                </div>

                <!--product description -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Description </label>
                    <textarea class="form-control" name="description" id="description">{{$productDetails->description}}</textarea>
                </div>

                <!--Material and care-->
                <div class="form-group">
                    <label for="exampleInputEmail1">Material & Care </label>
                    <textarea class="form-control" name="care" id="care">{{$productDetails->care}}</textarea>
                </div>

                <!--product price -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="text" class="form-control"name="price" id="price" value="{{$productDetails->price}}">
                </div>

                <!--product image -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Image</label>
                    <input type="file" class="custom-file-input"name="image" id="image">
                    <input type="hidden" name="current_image" value="{{$productDetails->image}}">
                    @if(!empty($productDetails->image))
                    <img src="{{asset('/images/products/small/'.$productDetails->image)}}" style="width:70px;"> | <a href="{{url('admin1/delete-product-image/'.$productDetails->id)}}">Delete </a>
                    @endif
                </div>

                <!--product enable/disable -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Enable </label>
                    <input type="checkbox" class=""name="status" id="status" @if($productDetails->status == '1') checked @endif value="1">
                </div>


                <a href="{{ url()->previous()}}"  class="btn btn-primary"><i class="fa fa-backward"></i> &nbsp;&nbsp;Back</a>
                <button type="submit" class="btn btn-primary" style="float: right">Edit Product</button>
            </form>


        </section>
    </div>

    <!-- /.content-wrapper -->
@endsection