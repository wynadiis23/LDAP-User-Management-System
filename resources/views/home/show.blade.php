@extends('admin.admin_template')

@section('content')<!-- 
	@php var_dump($hasil["count"]); @endphp
	@for($i = 0; $i<$hasil["count"]; $i++)
		{{$hasil[$i]["cn"][0]}}
		{{$hasil[$i]["sn"][0]}}
		{{$hasil[$i]["homedirectory"][0]}}
		{{$hasil[$i]["objectclass"][0]}}
		{{$hasil[$i]["objectclass"][1]}}
		{{$hasil[$i]["objectclass"][2]}}
		
	@endfor -->
@if(!empty($success))
  <div class="alert alert-success"> 
  	<button type="button" class="close" data-dismiss="alert">×</button>
  	<strong>{{ $success }}</strong>
  </div>
@endif
        <div class='col-md-12'>
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
        <div class='col-md-12'>
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
                	<table class="table table-bordered" id="table">
				        <thead>
				            <tr>
				                <th><b>CN</b></th>
				                <th><b>SN</b></th>
				                <th><b>UID</b></th>
				                <th><b>Object Class</b></th>
				                <th><b>Object Class</b></th>
				                <th><b>Object Class</b></th>
				                <th><b>Login Shell</b></th>
				                <th><b>Home Directory</b></th>
				                <th><b>uid Number</b></th>
				                <th><b>gid Number</b></th>
				                <th><b>DN</b></th>
				                <th><b>Action</b></th>
				            </tr>
				        </thead>
				        <tbody>
				            @for($i = 0; $i<$hasil["count"]; $i++)
				            <tr>
				                <td>{{$hasil[$i]["cn"][0]}}</td>
				                <td>{{$hasil[$i]["sn"][0]}}</td>
				                <td>{{$hasil[$i]["uid"][0]}}</td>
				                <td>{{$hasil[$i]["objectclass"][0]}}</td>
				                <td>{{$hasil[$i]["objectclass"][1]}}</td>
				                <td>{{$hasil[$i]["objectclass"][2]}}</td>
				                <td>{{$hasil[$i]["loginshell"][0]}}</td>
				                <td>{{$hasil[$i]["homedirectory"][0]}}</td>
				                <td>{{$hasil[$i]["uidnumber"][0]}}</td>
				                <td>{{$hasil[$i]["gidnumber"][0]}}</td>
				                <td>{{$hasil[$i]["dn"]}}</td>
				                <td>
				                	<a href="{{route('home.edit', ['id'=>$hasil[$i]["cn"][0]])}}" class="btn btn-info btn-sm">Edit</a>
		                            <form action="{{route('home.destroy', ['id'=>$hasil[$i]["cn"][0]])}}" class="d-inline" onsubmit="return confirm('Hapus User?')" method="POST">
		                                @csrf
		                                <input type="hidden" name="_method" value="DELETE">
		                                <input type="submit" value="Hapus" class="btn btn-danger btn-xsm">
		                            </form>
				                </td>
				            </tr>
				            @endfor
				        </tbody>
				        <tfoot>
				        </tfoot>
				    </table>
                    A separate section to add any kind of widget. Feel free
                    to explore all of AdminLTE widgets by visiting the demo page
                    on <a href="https://almsaeedstudio.com">Almsaeed Studio</a>.
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
@endsection('content')