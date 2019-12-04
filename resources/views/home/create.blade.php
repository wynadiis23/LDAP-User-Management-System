@extends('admin.admin_template')

@section('content')
	<div class='row'>
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah User</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                <form action="{{route ('home.store')}}" method="post" enctype="multipart/form-data">
                    	@csrf
                    	<label>NIM/NIP</label>
                        <input type='text' placeholder='Inputkan NIM atau NIP' class='form-control input-sm' name="uid" />
                        <!-- <label>posixGroup</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="posixGroup" /> -->
                        <label>Prodi</label>
                        <select class="form-control input-sm" name="posixGroup">
                            @foreach($prodi as $data)
                        	<option value="{{$data->prodi_id}}">{{$data['prodi_name']}}</option>
                            @endforeach
                        </select>
                        <label>Base DN</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="baseDN" value="dc=ldaps,dc=unud,dc=ac,dc=id" disabled />
                        <!-- <label>Username</label>
                        <input type='text' placeholder='Inputkan Username' class='form-control input-sm' name="CN" /> -->
                        <label>Nama Lengkap</label>
                        <input type='text' placeholder='Inputkan Nama Lengkap' class='form-control input-sm' name="SN" />
                        <label>Email</label>
                        <input type='email' placeholder='Inputkan Email' class='form-control input-sm' name="mail" />
                        <label>Login Shell</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="loginShell" value="/bin/sh" disabled />
                        <input type='hidden' placeholder='uid' class='form-control input-sm' name="loginShell" value="/bin/sh" />
                        <!-- <label>uid Number</label>
                        <input type='text' placeholder='{{$lastUID}}' class='form-control input-sm' name="uid" disabled />
                        <label>gid Number</label>
                        <input type='text' placeholder='gid number mengikuti posixGroup' class='form-control input-sm' name="gid" disabled /> -->
                        <!-- <label>Home Directory</label>
                        <input type='text' placeholder='/home/cn+sn atau /home/uid' class='form-control input-sm' name="homeDir" /> -->
                        <!-- <label>Object Class</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="inetOrgPerson" value="top" disabled />
                        <input type='hidden' placeholder='uid' class='form-control input-sm' name="inetOrgPerson" value="inetOrgPerson" />
                        <label>Object Class</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="posixAccount" value="posixAccount" disabled />
                        <input type='hidden' placeholder='uid' class='form-control input-sm' name="posixAccount" value="posixAccount" />
                        <label>Object Class</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="shadowAccount" value="inetOrgPerson" disabled />
                        <input type='hidden' placeholder='uid' class='form-control input-sm' name="shadowAccount" value="inetOrgPerson" /> -->
                        <label>Password</label>
                        <input type='password' placeholder='password' class='form-control input-sm' name="password" />
						<br>
                        <input type="submit" value="save" class="btn btn-primary">
                    </form>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Form</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <label for="">NIM/NIP</label>
                    <span>Sesuaikan dengan NIM/NIP Mahasiswa atau Dosen. Data <b>NIM/NIP</b> akan digunakan sebagai parameter untuk <b>Login</b> pada LMS Moodle</span>
                    <br>
                    <label for="">Prodi</label>
                    <span>Sesuaikan dengan data Mahasiswa atau Dosen</span>
                    <br>
                    <label for="">Nama Lengkap</label>
                    <span>Isikan sesuai dengan data Mahasiswa atau Dosen</span>
                    <br>
                    <label for="">Email</label>
                    <span>Isikan dengan alamat email aktif</span>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection('content')