@extends('admin.admin_template')

@section('content')

    <!-- Main content -->
    <section class="content">

      <div class="error-page">
        <h2 class="headline text-red">500</h2>
        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
          <p>
            Terjadi kesalah sistem, pastikan <strong>inputan</strong> dan <strong>kode</strong> anda benar. Cek <strong>config server</strong> dan <strong>API</strong> pada Helper. 
          </p>
          
        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
</div>
@endsection('content')
