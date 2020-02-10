@extends('admin.admin_template')

@section("title")
    Daftar Fakultas
@endsection

@section('content')
<div class="row">
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tabel Data User - Server LDAP</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" id="datatable">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>SN</th>
                     <th>UID</th>
                     <th>Class Object</th>
                     <th>UID Number</th>
                     <th>gid Number</th>
                     <th>DN</th>
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
    $('#datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: 
           {
           	url : '{{ url("getDataUserJS")}}',
           	type : "GET",
           },
           columns: [
                    { data: 'fakultas_id', name: 'fakultas_id' },
                    { data: 'fakultas_id', name: 'fakultas_id' },
                    { data: 'fakultas_id', name: 'fakultas_id' },
                    { data: 'fakultas_id', name: 'fakultas_id' },
                    { data: 'fakultas_id', name: 'fakultas_id' },
                    { data: 'fakultas_id', name: 'fakultas_id' },
                    { data: 'fakultas_name', name: 'fakultas_name' },
                    { data: 'action', orderable: false, searchable: false}
            ],
        });
     });
  </script>
@endsection