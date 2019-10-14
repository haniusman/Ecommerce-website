@extends('layouts.front_layout.front_design')
@section('content')

    @if(Session::has('update_message'))

        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('update_message') !!}</strong>
        </div>
    @endif
    @if(Session::has('error'))

        <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('error') !!}</strong>
        </div>
    @endif

    <section id="form" style="margin-top: 20px;"><!--form-->
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check Out</li>
                </ol>
            </div>
            <form action="{{url('\checkout')}}" method="post">
                {{csrf_field()}}
                 <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Bill To</h2>
                        <div class="form-group">
                            <input name="billing_name" id="billing_name" class="form-control" type="text" placeholder="Billing Name"
                                   @if(!empty($userDetails->name))value="{{$userDetails->name}}" @endif/>
                        </div>
                        <div class="form-group">
                            <input name="billing_address" id="billing_address" class="form-control" type="text" placeholder="Billing Address"
                                   @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif/>
                        </div>
                        <div class="form-group">
                            <input name="billing_city" id="billing_city" class="form-control" type="text" placeholder="Billing City"
                                   @if(!empty($userDetails->city)) value="{{$userDetails->city}}" @endif/>
                        </div>
                        <div class="form-group">
                            <input name="billing_province" id="billing_province" class="form-control" type="text" placeholder="Billing Province"
                                   @if(!empty($userDetails->province)) value="{{$userDetails->province}}" @endif/>
                        </div>
                        <div class="form-group">
                            <select name="billing_country" id="billing_country" class="form-control" >
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->country_name}}" @if(!empty($userDetails->country) && $country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="billing_pincode" id="billing_pincode"  class="form-control" type="text" placeholder="Billing Pincode"
                                   @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif />
                        </div>
                        <div class="form-group">
                            <input name="billing_mobile" id="billing_mobile" class="form-control" type="text" placeholder="Billing Mobile"
                                   @if(!empty($userDetails->mobile)) value="{{$userDetails->mobile}}" @endif/>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="copyAddress">
                            <label class="form-check-label" for="copyAddress">Shipping address same as billing address</label>

                        </div>


                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2></h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Ship To</h2>
                        <div class="form-group">
                        <input name="shipping_name" id="shipping_name" class="form-control" type="text" placeholder="Shipping Name"
                               @if(!empty($shippingDetails->name)) value="{{$shippingDetails->name}}" @endif/>
                        </div>
                        <div class="form-group">
                        <input name="shipping_address" id="shipping_address" class="form-control"  type="text" placeholder="Shipping Address"
                               @if(!empty($shippingDetails->address)) value="{{$shippingDetails->address}}" @endif/>
                        </div>
                        <div class="form-group">
                        <input name="shipping_city" id="shipping_city" class="form-control" type="text" placeholder="Shipping City"
                               @if(!empty($shippingDetails->city)) value="{{$shippingDetails->city}}" @endif />
                        </div>
                        <div class="form-group">
                        <input name="shipping_province" id="shipping_province" class="form-control" type="text" placeholder="Shipping Province"
                               @if(!empty($shippingDetails->province)) value="{{$shippingDetails->province}}"@endif/>
                        </div>
                        <div class="form-group">
                            <select name="shipping_country" id="shipping_country" class="form-control" >
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->country_name}}"
                                    @if(!empty($shippingDetails->country) && $country->country_name == $shippingDetails->country) selected @endif >{{$country->country_name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                        <input name="shipping_pincode" id="shipping_pincode" class="form-control" type="text" placeholder="Shipping Pincode"
                               @if(!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}" @endif/>
                        </div>
                        <div class="form-group">
                        <input name="shipping_mobile" id="shipping_mobile" class="form-control" type="text" placeholder="Shipping Mobile"
                               @if(!empty($shippingDetails->mobile)) value="{{$shippingDetails->mobile}}" @endif/>
                        </div>
                            <button type="submit" class="btn btn-success">Check Out</button>
                    </div><!--/sign up form-->
                </div>
            </div>
            </form>
        </div>
    </section><!--/form-->


@endsection