@extends('admin.admin_template')

@section('content')
	<div class='row'>
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cari User</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                    <br>
                    <br>
                </div>
                <div class="box-body">

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <form action="{{route ('letscari')}}" method="post" enctype="multipart/form-data">
                    	@csrf
                        <input type='text' placeholder='Cari user' class='form-control input-sm' name="filter" />
                        <br>
                        <input type="submit" name="cari" value="Cari" class="btn btn-primary">
                    </form>
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Second Box</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    A separate section to add any kind of widget. Feel free
                    to explore all of AdminLTE widgets by visiting the demo page
                    on <a href="https://almsaeedstudio.com">Almsaeed Studio</a>.
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
    <!-- <div class="row">
        <div class='col-md-12'>
            
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Second Box</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th><b>CN</b></th>
                                <th><b>SN</b></th>
                                <th><b>UID</b></th>
                                <th><b>Email</b></th>
                                <th><b>Object Class</b></th>
                                <th><b>Object Class</b></th>
                                <th><b>Object Class</b></th>
                                <th><b>Login Shell</b></th>
                                <th><b>Home Directory</b></th>
                                <th><b>uid Number</b></th>
                                <th><b>gid Number</b></th>
                                <th><b>DN</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i<$data["count"]; $i++)
                            <tr>
                                <td>{{$data[$i]["cn"][0]}}</td>
                                <td>{{$data[$i]["sn"][0]}}</td>
                                <td>{{$data[$i]["uid"][0]}}</td>
                                <td>{{$data[$i]["mail"][0]}}</td>
                                <td>{{$data[$i]["objectclass"][0]}}</td>
                                <td>{{$data[$i]["objectclass"][1]}}</td>
                                <td>{{$data[$i]["objectclass"][2]}}</td>
                                <td>{{$data[$i]["loginshell"][0]}}</td>
                                <td>{{$data[$i]["homedirectory"][0]}}</td>
                                <td>{{$data[$i]["uidnumber"][0]}}</td>
                                <td>{{$data[$i]["gidnumber"][0]}}</td>
                                <td>{{$data[$i]["dn"]}}</td>
                            </tr>
                            @endfor
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                    A separate section to add any kind of widget. Feel free
                    to explore all of AdminLTE widgets by visiting the demo page
                    on <a href="https://almsaeedstudio.com">Almsaeed Studio</a>.
                </div>
            </div>
        </div>
    </div> -->
@endsection('content')