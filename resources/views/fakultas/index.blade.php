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
                    <table class="table table-bordered" id="datatable">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Fakultas</th>
                     <th>Action</th>
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
    $('#datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: 
           {
           	url : '{{ url("getFakultas")}}',
           	type : "GET",
           },
           columns: [
                    { data: 'fakultas_id', name: 'fakultas_id' },
                    { data: 'fakultas_name', name: 'fakultas_name' },
                    { data: 'action', orderable: false, searchable: false}
            ],
        });
     });
  </script>
@endsection