@extends('admin.admin_template')

@section("title")
    Daftar Prodi
@endsection

@section('content')
<div class="row">
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tabel Daftar Prodi</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" id="laravel_datatable">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Prodi</th>
                     <th>Id Fakultas</th>
                     <th>Action</th>
                  </tr>
               </thead>
            </table>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>

   <script>
   $(document).ready( function () {
    $('#laravel_datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: 
           {
           	url : '{{ url("getProdi")}}',
           	type : "GET",
           },
           columns: [
                    { data: 'prodi_id', name: 'prodi_id' },
                    { data: 'prodi_name', name: 'prodi_name' },
                    { data: 'fakultas_id', name: 'fakultas_id' },
                    { data: 'action', orderable: false, searchable: false}
            ],
        });
     });
  </script>
@endsection