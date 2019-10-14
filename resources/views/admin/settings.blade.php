@extends('layouts.admin_layout.admin_design')

@section('content')
<h1 style="background-color: #00cc66; color: black; ">Settings</h1>
<form method="post" action="{{url('admin1/settings/changePassword')}}">
    <button type="button" class="btn btn-success">Change Password</button>
</form>

@endsection