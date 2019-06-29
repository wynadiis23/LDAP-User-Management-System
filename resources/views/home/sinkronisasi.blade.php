@extends('admin.admin_template')

@section('content')
	<div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sinkronisasi User</h3>
                    <p>Berikut merupakan daftar user yang belum termasuk di dalam LDAP Server</p>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                
                <div class="box-body">
                    
                    <table class="table table-bordered" id="table">
                        
                        <thead>
                            <tr>
                                <th><b>NIM/NIP</b></th>
                                <th><b>Username</b></th>
                                <th><b>Nama Lengkap</b></th>
                                <th><b>Email</b></th>
                                <th><b>Fakultas</b></th>
                                <th><b>Prodi</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)    
                            <tr>
                                <td>{{$data->nimnip}}</td>
                                <td>{{$data->username}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->fakultas}}</td>
                                <td>{{$data->prodi}}</td>
                            </tr>
                        @endforeach    
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                    A separate section to add any kind of widget. Feel free
                    to explore all of AdminLTE widgets by visiting the demo page
                    on <a href="https://almsaeedstudio.com">Almsaeed Studio</a>.
                </div><!-- /.box-body -->
                
                <div class="box-footer">
                    <br>


                    <form action="{{route('sinkronkanDataUser')}}" onsubmit="return confirm('Tambahkan data user ke server LDAP?')" method="POST">
                        @csrf

                        <!-- <input type="hidden" name="_method" value="DELETE"> -->
                        <input type="submit" value="Sync" class="btn btn-info btn-sm">
                    </form>
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection('content')