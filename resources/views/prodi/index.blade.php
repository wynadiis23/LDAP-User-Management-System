@extends('admin.admin_template')

@section('content')
<div class="row">
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
                    <table class="table table-bordered" id="laravel_datatable">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Email</th>
                  </tr>
               </thead>
            </table>
                    A separate section to add any kind of widget. Feel free
                    to explore all of AdminLTE widgets by visiting the demo page
                    on <a href="https://almsaeedstudio.com">Almsaeed Studio</a>.
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