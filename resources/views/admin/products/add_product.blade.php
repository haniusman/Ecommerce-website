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
                    Add products
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="#">Products</a></li>
                    <li class="active">Add new product</li>
                </ol>
            </section>
            <br><br>

            <!-- Product form -->
            <form enctype="multipart/form-data" name="add_product" id="add_product" method="post" action = "{{url('admin1/add_product')}}"  >
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
                    <input type="text" class="form-control"name="product_name" id="product_name" placeholder="Enter product name">
                </div>

                <!--product code -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Code</label>
                    <input type="text" class="form-control"name="product_code" id="product_code" placeholder="Enter product code">
                </div>

                <!--product color -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Product color</label>
                    <input type="text" class="form-control"name="product_color" id="product_color" placeholder="Enter product color">
                </div>

                <!--product description -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Description </label>
                    <textarea class="form-control" name="description" id="description"></textarea>
                </div>

                <!--Material and care-->
                <div class="form-group">
                    <label for="exampleInputEmail1">Material & Care </label>
                    <textarea class="form-control" name="care" id="care"></textarea>
                </div>

                <!--product price -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="text" class="form-control"name="price" id="price" placeholder="Enter price">
                </div>

                <!--product image -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Image</label>
                    <input type="file" class="custom-file-input"name="image" id="image">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>

                <!--product enable/disable -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Enable </label>
                    <input type="checkbox" class=""name="status" id="status" value="1">
                </div>

                <a href="{{ url()->previous()}}"  class="btn btn-primary"><i class="fa fa-backward"></i> &nbsp;&nbsp;Back</a>
                <button type="submit" class="btn btn-primary" style="float: right">Add Product</button>
            </form>


        </section>
    </div>

    <!-- /.content-wrapper -->
@endsection