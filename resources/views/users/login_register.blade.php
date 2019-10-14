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
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form id="loginForm" name="loginForm" action="{{url('user-login')}}" method="post">
                            {{csrf_field()}}
                            <input name= "email" type="email" placeholder="Email Address" />
                            <input name="password" type="password" placeholder="Password" />
                            {{--<span>--}}
								{{--<input type="checkbox" class="checkbox">--}}
								{{--Keep me signed in--}}
							{{--</span>--}}
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form id="registerForm" name="registerForm" action="{{url('user-register')}}" method="POST">
                            {{csrf_field()}}
                            <input id="name" name="name" type="text" placeholder="Name"/>
                            <input id="email" name="email" type="email" placeholder="Email Address"/>
                            <input id="myPassword" name="password" type="password" placeholder="Password"/>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->


@endsection