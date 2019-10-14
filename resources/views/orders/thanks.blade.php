@extends('layouts.front_layout.front_design')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Thanks</li>
                </ol>
            </div>
        </div>
    </section>

    <section id="do_action">
        <div class="container">
            <div class="heading" align="center">
                <h3>Your COD order has been placed!</h3>
                <p>Your order number is {{Session::get('order_id')}} and total amount payable is PKR {{Session::get('grand_total')}}</p>
            </div>
        </div>
    </section>
    <?php
    Session::forget('order_id');
    Session::forget('grand_total');
    ?>
@endsection