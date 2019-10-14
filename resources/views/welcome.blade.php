<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">


        <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Banners
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="#">Banners</a></li>
                    <li class="active">Banners list</li>
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
                                <h3 class="box-title" id="prd" >Banners</h3>
                            </div>
                            <div>
                                <a href="{{url('admin1/add_banner')}}" class="btn btn-success" style="float:right; margin:10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add new Banner</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="btable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Banner ID</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th>Status</th>
                                        <th>Create at</th>
                                        <th>Updated at</th>

                                    </tr>
                                    </thead>
                                    {{--<tbody>--}}
                                    {{--@foreach($banners as $banner)--}}
                                    {{--<tr>--}}
                                    {{--<td>{{$banner->id}}</td>--}}
                                    {{--<td>{{$banner->title}}</td>--}}
                                    {{--<td>{{$banner->link}}</td>--}}
                                    {{--<td>--}}
                                    {{--@if(!empty($banner->image))--}}
                                    {{--<img src="{{asset('/images/banners/small/'.$banner->image)}}" style="width:70px;">--}}
                                    {{--@endif--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                    {{--<a href="#" title="Edit Product" class="btn btn-primary">Edit</a>--}}
                                    {{--<a href="#" id="delProduct" title="Delete Product" class="btn btn-danger">Delete</a>--}}
                                    {{--</td>--}}
                                    {{--</tr>--}}
                                    {{--@endforeach--}}
                                    {{--</tbody>--}}
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

        <script type="text/javascript">
            $(document).ready(function() {
                alert("here");
                oTable = $('#btable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('bannerslist.getposts') }}",
                    "columns": [
                        {data: 'id', name: 'id'},
                        {data: 'title', name: 'title'},
                        {data: 'link', name: 'link'},
                        {data: 'image', name: 'image'}
                    ]
                });
            });
        </script>

        {{--<div class="flex-center position-ref full-height">--}}
            {{--@if (Route::has('login'))--}}
                {{--<div class="top-right links">--}}
                    {{--@auth--}}
                        {{--<a href="{{ url('/home') }}">Home</a>--}}
                    {{--@else--}}
                        {{--<a href="{{ url('') }}">Login</a>--}}

                        {{--@if (Route::has('register'))--}}
                            {{--<a href="{{ route('register') }}">Register</a>--}}
                        {{--@endif--}}
                    {{--@endauth--}}
                {{--</div>--}}
            {{--@endif--}}

            {{--<div class="content">--}}
                {{--<div class="title m-b-md">--}}
                    {{--Laravel--}}
                {{--</div>--}}

                {{--<div class="links">--}}
                    {{--<a href="https://laravel.com/docs">Docs</a>--}}
                    {{--<a href="https://laracasts.com">Laracasts</a>--}}
                    {{--<a href="https://laravel-news.com">News</a>--}}
                    {{--<a href="https://blog.laravel.com">Blog</a>--}}
                    {{--<a href="https://nova.laravel.com">Nova</a>--}}
                    {{--<a href="https://forge.laravel.com">Forge</a>--}}
                    {{--<a href="https://github.com/laravel/laravel">GitHub</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </body>
</html>
