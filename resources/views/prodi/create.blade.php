@extends('admin.admin_template')

@section('content')
	<div class='row'>
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Prodi</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <form action="{{route ('prodi.store')}}" method="post" enctype="multipart/form-data">
                    	@csrf
                    	<label>Prodi</label>
                        <input type='text' placeholder='Inputkan Prodi' class='form-control input-sm' name="prodi" required>
                        <!-- <label>posixGroup</label>
                        <input type='text' placeholder='uid' class='form-control input-sm' name="posixGroup" /> -->
                        <label>Fakultas</label>
                        <select class="form-control input-sm" name="fakultas">
                            @foreach($data as $fakultas)
                            <option value="{{$fakultas->fakultas_id}}">{{$fakultas->fakultas_name}}</option>
                            @endforeach
                        </select>   
						<br>
                        <input type="submit" value="save" class="btn btn-primary">
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
                    <p>
                        <b>NIM/NIP</b> isikan sesuai dengan NIM mahasiswa atau NIP Dosen/Pegawai. <br>
                        <b>Fakultas</b> sesuaikan dengan fakultas mahasiswa atau dosen/pegawai. <br>
                        
                    </p>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection('content')