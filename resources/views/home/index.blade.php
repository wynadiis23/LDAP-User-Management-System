@extends('admin.admin_template')

@section("title")
    Dashboard
@endsection

@section('content')
    <div class='row'>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$jumFak}}</h3>

              <p>Fakultas</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$jumProd}}</h3>

              <p>Prodi</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{$jumlah}}</h3>

              <p>User</p>
            </div>
            <div class="icon">
              <i class="ion-ios-school"></i>
            </div>
          </div>
        </div>
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Info LDAP Server</h3>
                    <br>
                    <!-- <h5 class="box-title">Server LDAP: {{$ldap_data['ldap_server']}}</h5>
                    <br>
                    <h5 class="box-title">Base LDAP Tree: {{$ldap_data['ldap_dn']}}</h5> -->
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                  <span>LDAP Server : {{$ldap_data['ldap_server']}}</span>
                  <br>
                  <span>Base LDAP Tree : {{$ldap_data['ldap_dn']}}</span>
                  <!-- <br>
                  <span>API Data Mahasiswa : {{$api_data['getUser']}}</span> -->
                  <hr>
                  <span>LDAP User Management merupakan aplikasi berbasis Web yang mengintegrasikan data baik mahasiswa maupun dosen data database SIMAK. Aplikasi ini dalam tahap pengembangan 
                  menggunakan data dari database data mahasiswa. Dalam pengembangannya, aplikasi ini menjadi wadah data terpusat dalam penggunakan aplikasi E-Learning LMS Moodle. </span>
                </div><!-- /.box-body -->
                
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi Halaman</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- A separate section to add any kind of widget. Feel free
                    to explore all of AdminLTE widgets by visiting the demo page
                    on <a href="https://almsaeedstudio.com">Almsaeed Studio</a>. -->
                    <label for="">Fakultas</label>
                    <span>Informasi jumlah fakultas yang telah terdaftar di server LDAP</span>
                    <br>
                    <label for="">Prodi</label>
                    <span>Informasi jumlah prodi yang telah terdaftar di server LDAP.</span>
                    <br>
                    <label for="">User</label>
                    <span>Jumlah total user yang terdaftar di server LDAP. </span>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        

    </div><!-- /.row -->
@endsection