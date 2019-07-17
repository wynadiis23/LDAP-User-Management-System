@extends('admin.admin_template')

@section('content')
	<div class='row'>
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Use aar</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

                </div><!-- /.box-body -->
                <div class="box-footer">
                	@for($i = 0; $i<$hasil["count"]; $i++)
                    <form action="{{route ('home.update', ['id'=>$hasil[$i]["cn"][0]])}}" method="post" enctype="multipart/form-data">
                    	@csrf
                    	<input type="hidden" value="PUT" name="_method">
                    	<label>NIM/NIP</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="uid" value="{{$hasil[$i]["uid"][0]}}" disabled />
                        <!-- <label>posixGroup</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="posixGroup" /> -->
                        <label>Fakultas</label>
                        <select class="form-control input-sm" name="posixGroup" disabled>
                        	<option>{{$fakultas->fakultas_name}}</option>
                        </select>
                        <label>Prodi</label>
                        <input type='text' placeholder='prodi' class='form-control input-sm' name="prodi" value="{{$prodi}}" disabled />
                        <label>User DN</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="userDN" value="{{$hasil[$i]['dn']}}" disabled />
                        <input type='hidden' placeholder='uid' class='form-control input-sm' name="userDN" value="{{$hasil[$i]['dn']}}" />
                        <label>Base DN</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="baseDN" value="dc=ldaps,dc=cs,dc=unud,dc=ac,dc=id" disabled />
                        <label>Username</label>
                        <input type='text' placeholder='common name' class='form-control input-sm' name="CN" value="{{$hasil[$i]["cn"][0]}}" disabled />
                        <label>Nama Lengkap</label>
                        <input type='text' placeholder='sur name' class='form-control input-sm' name="SN" value="{{$hasil[$i]["sn"][0]}}" />
                        <label>Login Shell</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="loginShell" value="/bin/sh" disabled />
                        <input type='hidden' placeholder='uid' class='form-control input-sm' name="loginShell" value="/bin/sh" />
                        <label>uid Number</label>
                        <input type='text' placeholder='uid number mengikuti posixGroup' class='form-control input-sm' name="uid" disabled value="{{$hasil[$i]["uidnumber"][0]}}" />
                        <label>gid Number</label>
                        <input type='text' placeholder='gid number mengikuti posixGroup' class='form-control input-sm' name="gid" disabled value="{{$hasil[$i]["gidnumber"][0]}}" />
                        <!-- <label>Home Directory</label>
                        <input type='text' placeholder='/home/cn+sn atau /home/uid' class='form-control input-sm' name="homeDir" /> -->
                        <label>Object Class</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="" value="{{$hasil[$i]["objectclass"][0]}}" disabled />
                        <label>Object Class</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="" value="{{$hasil[$i]["objectclass"][1]}}" disabled />
                        <label>Object Class</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="" value="{{$hasil[$i]["objectclass"][2]}}" disabled />
                        <label>Password</label>
                        <input type='password' placeholder='password' class='form-control input-sm' name="password" />
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
						<br>
						@endfor
                        <input type="submit" value="update" class="btn btn-primary">
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
@endsection('content')