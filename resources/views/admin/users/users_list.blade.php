@extends('layouts.admin_layout.admin_design')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Tables
                <small>advanced tables</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#">Users</a></li>
                <li class="active">Users list</li>
            </ol>
        </section>

        <!-- Main content -->
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
                            <h3 class="box-title">Users</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    @if($user->admin != '1')
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}} </td>
                                    <td>User</td>
                                    <td><a href="{{ url('') }}" class="btn btn-success">View</a>
                                        <a href="{{ url('admin1/users',[$user->id,'edit']) }}" class="btn btn-success">Edit</a>
                                        <form method="post" action="{{url('admin1/users',$user->id)}}" style="display:inline;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="submit" name="submit" class="btn btn-success" value="Delete">
                                        </form>
                                    </td>
                                </tr>

                                    @else
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}} </td>
                                            <td>Admin</td>
                                            <td><a href="{{ url('') }}" class="btn btn-success">View</a>
                                                <a href="{{ url('admin1/users',[$user->id,'edit']) }}" class="btn btn-success">Edit</a>
                                                <form method="post" action="{{url('admin1/users',$user->id)}}" style="display:inline;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="submit" name="submit" class="btn btn-success" value="Delete">
                                                </form>
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                               <!-- <tfoot>
                                <tr>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Role</th>
                                </tr>
                                </tfoot>
                                -->
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


<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>



@endsection