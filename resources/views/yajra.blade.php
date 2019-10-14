
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
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Image</th>
                                    <th>Action</th>
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

