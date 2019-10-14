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
                    Edit coupons
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="#">Coupons</a></li>
                    <li class="active">Edit coupon</li>
                </ol>
            </section>
            <br><br>

            <!-- Coupon form -->
            <form  name="edit_coupon" id="edit_coupon" method="post" action = "{{url('admin1/edit-coupon/'.$couponDetails->id)}}"  >
            {{csrf_field()}}

            <!--coupon_code -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Code</label>
                    <input type="text" class="form-control"name="coupon_code" id="coupon_code" value="{{$couponDetails->coupon_code}}" minlength="5" maxlength="15" required>
                </div>

                <!--coupon amount -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="number" min="1" class="form-control"name="amount" id="amount" value="{{$couponDetails->amount}}" required>
                </div>

                <!--Amount type -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Amount Type </label>
                    <select class="form-control" name="amount_type" id="amount_type">
                        <option @if($couponDetails->amount_type == "Percentage") selected @endif value="Percentage">Percentage</option>
                        <option  @if($couponDetails->amount_type == "Fixed") selected @endif value="Fixed">Fixed</option>
                    </select>
                </div>

                <!--Expiry date -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Expiry Date </label>
                    <input type="text" class="form-control"name="expiry_date" id="expiry_date"  value="{{$couponDetails->expiry_date}}" autocomplete="off" required>
                </div>

                <!--Coupon enable/disable -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Enable </label>
                    <input type="checkbox" class=""name="status" id="status"@if($couponDetails->status == '1') checked @endif >
                </div>

                <a href="{{ url()->previous()}}"  class="btn btn-primary"><i class="fa fa-backward"></i> &nbsp;&nbsp;Back</a>
                <button type="submit" class="btn btn-primary" style="float: right">Edit Coupon</button>
            </form>


        </section>
    </div>

    <!-- /.content-wrapper -->
@endsection