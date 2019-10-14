@extends('layouts.admin_layout.admin_design')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Coupons
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#">Coupons</a></li>
                <li class="active">Coupons list</li>
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
                            <h3 class="box-title" id="prd" >Coupons</h3>
                        </div>
                        <div>
                            <a href="{{url('admin1/add-coupon')}}" class="btn btn-success" style="float:right; margin:10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add new Coupon</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Coupon ID</th>
                                    <th>Coupon Code</th>
                                    <th>Amount</th>
                                    <th>Amount Type</th>
                                    <th>Expiry Date</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coupons as $coupon)
                                    <tr>
                                        <td>{{$coupon->id}}</td>
                                        <td>{{$coupon->coupon_code}}</td>
                                        <td>
                                            {{$coupon->amount}}
                                            @if($coupon->amount_type == 'Percentage') % @else PKR @endif
                                        </td>
                                        <td>{{$coupon->amount_type}}</td>
                                        <td>{{$coupon->expiry_date}}</td>
                                        <td>{{$coupon->created_at}}</td>
                                        <td>
                                            @if($coupon->status == 1) Active @else Inactive @endif
                                        </td>
                                        <td>
                                            <a href="{{url('admin1/edit-coupon/'.$coupon->id)}}" title="Edit Coupon" class="btn btn-primary">Edit</a>
                                            <a href="{{url('admin1/delete-coupon/'.$coupon->id)}}" id="delProduct" title="Delete Coupon" class="btn btn-danger">Delete</a>
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