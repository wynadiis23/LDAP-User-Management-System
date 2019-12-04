@extends('admin.admin_template')

@section("title")
    Tambah Prodi
@endsection

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
                </div><!-- /.box-body -->
                <div class="box-footer">
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Halaman Prodi</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <label for="">Prodi</label>
                    <span>Inputkan nama prodi.</span>
                    <br>
                    <label for="">Fakultas</label>
                    <span>Fakultas akan menjadi parent dari prodi yang diinputkan</span>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection('content')