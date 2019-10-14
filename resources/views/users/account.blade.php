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
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <h2>Update account</h2>
                        <form id="accountForm" name="accountForm" action="{{url('/account')}}" method="post">
                            {{csrf_field()}}

                            <input id="name" name= "name" type="text" placeholder="Name" value="{{$user_details->name}}"/>
                            <input id="address" name= "address" type="text" placeholder="Address" value="{{$user_details->address}}"/>
                            <input id="city" name= "city" type="text" placeholder="City" value="{{$user_details->city}}"/>
                            <input id="province" name= "province" type="text" placeholder="Province" value="{{$user_details->province}}"/>
                            <select id="country" name="country">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->country_name}}"
                                            @if($country->country_name == $user_details->country)
                                                 selected
                                            @endif>
                                        {{$country->country_name}}
                                    </option>
                                @endforeach
                            </select>
                            <input id="pincode" name= "pincode" type="text" placeholder="Pincode" value="{{$user_details->pincode}}" style="margin-top: 10px;" />
                            <input id="mobile" name= "mobile" type="text" placeholder="Mobile" value="{{$user_details->mobile}}"/>
                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <h2>Update Password</h2>
                        <form id="passwordForm" name="passwordForm" action="{{url('update-user-pwd')}}" method="post">
                            {{csrf_field()}}

                            <input id="current_pwd" name= "current_pwd" type="password" placeholder="Current Pasword" />
                            <span id="chkPwd"></span>
                            <input id="new_pwd" name= "new_pwd" type="password" placeholder="New Password" />
                            <input id="confirm_pwd" name= "confirm_pwd" type="password" placeholder="Confirm Password"/>
                            <button type="submit" class="btn btn-default">Change Password</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/form-->


@endsection