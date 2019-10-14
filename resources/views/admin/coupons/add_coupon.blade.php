@extends('layouts.admin_layout.admin_design')
@section('content')
    <div class="content-wrapper">

<!--Session messages -->
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
                    Add coupons
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="#">Coupons</a></li>
                    <li class="active">Add new coupon</li>
                </ol>
            </section>
            <br><br>

            <!-- Coupon form -->
            <form  name="add_coupon" id="add_coupon" method="post" action = "{{url('admin1/add-coupon')}}"  >
            {{csrf_field()}}

                <!--coupon_code -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Code</label>
                    <input type="text" class="form-control"name="coupon_code" id="coupon_code" placeholder="Enter coupon code" minlength="5" maxlength="15" required>
                </div>

                <!--coupon amount -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="number" min="1" class="form-control"name="amount" id="amount" placeholder="Enter amount" required>
                </div>

                <!--Amount type -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Amount Type </label>
                    <select class="form-control" name="amount_type" id="amount_type">
                        <option value="Percentage">Percentage</option>
                        <option value="Fixed">Fixed</option>
                    </select>
                </div>

                <!--Expiry date -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Expiry Date </label>
                    <input type="text" class="form-control"name="expiry_date" id="expiry_date" placeholder="Enter expiry date" autocomplete="off" required>
                </div>

                <!--Coupon enable/disable -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Enable </label>
                    <input type="checkbox" class=""name="status" id="status" value="1">
                </div>

                <a href="{{ url()->previous()}}"  class="btn btn-primary"><i class="fa fa-backward"></i> &nbsp;&nbsp;Back</a>
                <button type="submit" class="btn btn-primary" style="float: right">Add Coupon</button>
            </form>


        </section>
    </div>

    <!-- /.content-wrapper -->
@endsection