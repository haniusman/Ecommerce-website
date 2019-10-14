@extends('layouts.front_layout.front_design')
@section('content')
    <?php use App\Order; ?>
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
                <h3>Your order has been placed!</h3>
                <p>Your order number is {{Session::get('order_id')}} and total amount payable is PKR {{Session::get('grand_total')}}</p>
                <p>Please make payment by clicking on below payment button</p>
                {{--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">--}}
                    {{--{{csrf_field()}}--}}
                    {{--<input type="hidden" name="cmd" value="_s-xclick">--}}
                    {{--<input type="hidden" name="business" value="sb-bpueh338387@business.example.com">--}}
                    {{--<input type="hidden" name="item_name" value="10686868">--}}
                    {{--<input type="hidden" name="amount" value="100.00">--}}
                    {{--<input type="hidden" name="currency_code" value="USD">--}}
                    {{--<input type="image"--}}
                    {{--src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png"--}}
                    {{--alt="Buy Now">--}}
                    {{--<img src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">--}}
                {{--</form>--}}
                <?php
                $orderDetails = Order::getOrderDetails(Session::get('order_id'));
                $orderDetails = json_decode(json_encode($orderDetails));
//               echo"<pre>"; print_r($orderDetails);die;
                    $nameArr = explode(' ',$orderDetails->name);
                $getCountryCode = Order::getCountryCode($orderDetails->country);
//                    print_r($nameArr[1]);die;


                ?>
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="sb-bpueh338387@business.example.com">
                    <input type="hidden" name="item_name" value="{{Session::get('order_id')}}">
                    {{--<input type="hidden" name="item_number" value="1">--}}
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="hidden" name="amount" value="{{Session::get('grand_total')}}">
                    <input type="hidden" name="first_name" value="{{$nameArr[0]}}">
                    <input type="hidden" name="last_name" value="-">
                    <input type="hidden" name="address1" value="{{$orderDetails->address}}">
                    <input type="hidden" name="address2" value="">
                    <input type="hidden" name="city" value="{{$orderDetails->city}}">
                    <input type="hidden" name="state" value="{{$orderDetails->province}}">
                    <input type="hidden" name="zip" value="{{$orderDetails->pincode}}">
                    <input type="hidden" name="night_phone_a" value="{{$orderDetails->mobile}}">
                    <input type="hidden" name="night_phone_b" value="">
                    <input type="hidden" name="night_phone_c" value="">
                    <input type="hidden" name="email" value="{{$orderDetails->user_email}}">
                    <input type="hidden" name="country" value="{{$getCountryCode->country_code}}">

                    {{--<input type="hidden" name="no_shipping" value="0">--}}
                    {{--<input type="hidden" name="no_note" value="1">--}}
                    {{--<input type="hidden" name="lc" value="AU">--}}
                    {{--<input type="hidden" name="bn" value="PP-BuyNowBF">--}}
                    <input type="image" src="https://www.paypal.com/en_AU/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
                    <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>
        </div>
    </section>
<!--    --><?php
//    Session::forget('order_id');
//    Session::forget('grand_total');
//    ?>
@endsection