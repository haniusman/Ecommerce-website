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
                <li><a href="#">Orders</a></li>
                <li class="active">Orders list</li>
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
                            <h3 class="box-title" id="prd" >Orders</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Ordered Products</th>
                                    <th>Order Amount</th>
                                    <th>Order Status</th>
                                    <th>Payment Method</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->user_email}}</td>
                                       <td> @foreach($order->orders as $pro)
                                               <a href="{{url('orders/'.$order->id)}}">
                                                   {{$pro->product_code}}
                                                   ({{$pro->product_qty}})
                                               </a><br>
                                           @endforeach</td>
                                        <td>{{$order->grand_total}}</td>
                                        <td>{{$order->order_status}}</td>
                                        <td>{{$order->payment_method}}</td>

                                        <td>
                                            <a href="{{url('admin1/orderslist/'.$order->id)}}" target="_blank" title="View Order" class="btn btn-success">View Order Details</a>
                                        </td>
                                    </tr>

                                    <!--popup -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal{{$order->id}}" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">{{$order->product_name}}  Full Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Product ID : {{$order->id}}</p>


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

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



@endsection