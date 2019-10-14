@extends('layouts.admin_layout.admin_design')
@section('content')
    <div class="content-wrapper">
    <!--main-container-part-->
    <div id="content">
        <section class="content-header">
            <h1>
                Orders #{{$orderDetails->id}}
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#">Orders</a></li>
                <li class="active">Orders list</li>
            </ol>
        </section>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span6">
                    {{--Order details--}}
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                            <h5>Order Details</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-striped table-bordered">

                                <tbody>
                                <tr>
                                    <td class="taskDesc">Order Date</td>
                                    <td class="taskStatus">{{$orderDetails->created_at}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Order Status</td>
                                    <td class="taskStatus"><span class="pending">{{$orderDetails->order_status}}</span></td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Order Total</td>
                                    <td class="taskStatus"><span class="pending">{{$orderDetails->grand_total}}</span></td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Shipping Charges </td>
                                    <td class="taskStatus"><span class="pending">PKR {{$orderDetails->shipping_charges}}</span></td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Coupon Code </td>
                                    <td class="taskStatus"><span class="pending">{{$orderDetails->coupon_code}}</span></td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Coupon Amount</td>
                                    <td class="taskStatus"><span class="pending">PKR {{$orderDetails->coupon_amount}}</span></td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Payment Method</td>
                                    <td class="taskStatus"><span class="pending">{{$orderDetails->payment_method}}</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                      {{--customer details--}}
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                            <h5>Customer Details</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-striped table-bordered">

                                <tbody>
                                <tr>
                                    <td class="taskDesc">Customer Name </td>
                                    <td class="taskStatus">{{$orderDetails->name}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Customer Email</td>
                                    <td class="taskStatus"><span class="pending">{{$orderDetails->user_email}}</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{--billing shipping details--}}
                    <div class="accordion" id="collapse-group">
                        <div class="accordion-group widget-box">
                            <div class="accordion-heading">
                                <div class="widget-title">
                                    <h5><strong>Billing Details</strong></h5>
                                   </div>
                            </div>
                            <div class="collapse in accordion-body" id="collapseGOne">
                                <div class="widget-content">
                                    {{$userDetails->name}}<br>
                                    {{$userDetails->address}}<br>
                                    {{$userDetails->city}}<br>
                                    {{$userDetails->province}}<br>
                                    {{$userDetails->country}}<br>
                                    {{$userDetails->pincode}}<br>
                                    {{$userDetails->mobile}}<br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  id="collapse-group">
                        <div>
                            <div class="accordion-heading">
                                <div class="widget-title">
                                    <h5><strong>Shipping Details</strong></h5>
                                </div>
                            </div>
                            <div class="collapse in accordion-body" id="collapseGOne">
                                <div class="widget-content">
                                    <div class="widget-content">
                                        {{$orderDetails->name}}<br>
                                        {{$orderDetails->address}}<br>
                                        {{$orderDetails->city}}<br>
                                        {{$orderDetails->province}}<br>
                                        {{$orderDetails->country}}<br>
                                        {{$orderDetails->pincode}}<br>
                                        {{$orderDetails->mobile}}<br>
                                     </div>
                            </div>
                        </div>
                    </div>
                </div>
                    {{--update order status--}}
                    <div  id="collapse-group">
                        <div>
                            <div class="accordion-heading">
                                <div class="widget-title">
                                    <h5><strong>Update Order Status</strong></h5>
                                </div>
                            </div>
                            <div class="collapse in accordion-body" id="collapseGOne">
                                <div class="widget-content">
                                    <form action="" method="post">
                                        <table width="100%">
                                            <tr>
                                            <td>
                                        <select name="order_status" id="order_status" required="">
                                            <option value="New">New</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                            </td>
                                            <td>
                                        <input type="submit" value="Update Status">
                                            </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>

                <th>Product Code</th>
                <th>Product Name</th>
                <th>Product Size</th>
                <th>Product Color</th>
                <th>Product Price</th>
                <th>Product Quantity</th>

            </tr>
            </thead>
            <tbody>
            @foreach($orderDetails->orders as $pro)
                <tr>
                    <td>{{$pro->product_code}}</td>
                    <td>{{$pro->product_name}}</td>
                    <td>{{$pro->product_size}}</td>
                    <td>{{$pro->product_color}}</td>
                    <td>{{$pro->product_price}}</td>
                    <td>{{$pro->product_qty}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    <!--main-container-part-->
    </div>
    </div>
@endsection