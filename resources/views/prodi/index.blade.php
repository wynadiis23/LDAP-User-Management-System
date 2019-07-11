@extends('admin.admin_template')

@section('content')
<div class='row'>
        <div class="col-lg-3 col-xs-12">
          <div class="container">
               <h2>Laravel DataTable - Tuts Make</h2>
            <table class="table table-bordered" id="laravel_datatable">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Email</th>
                  </tr>
               </thead>
            </table>
         </div>
    </div><!-- /.row -->
	


   <script>
   $(document).ready( function () {
    $('#laravel_datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ url('getProdi') }}",
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'prodi', name: 'prodi' },
                    { data: 'kode', name: 'kode' }
                 ]
        });
     });
  </script>
@endsection