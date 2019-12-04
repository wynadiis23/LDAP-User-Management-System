@extends('admin.admin_template')

@section("title")
    Info Server
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Info Server</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <label for="">LDAP Server</label>
                    <br>
                    <span>LDAP Server Address: {{$ldap_data['ldap_server']}}</span>
                    <br>
                    <span>LDAP Distinguish Name: {{$ldap_data['ldap_dn']}}</span>
                    <br>
                    <span>LDAP User: {{$ldap_data['ldap_user']}}</span>
                    <br><br>

                    <label for="">API Config</label>
                    <br>
                    <span>API Retrieve User Data: {{$api_data['getUser']}}</span>
                    <br>
                    <span>API Update Flag Data: {{$api_data['setFlag']}}</span>
                </div><!-- /.box-body -->
                <div class="box-footer">
                </div><!-- /.box-footer-->
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
                    <span>Kostumisasi Data LDAP Server dan API dapat dilakukan pada file <b>globalHelper</b> pada /app/Helpers/globalHelpers.php.</span>
                    <br>
                    <span>Fungsi config => Konfigurasi LDAP Server</span>
                    <br>
                    <span>Fungsi apiConfig => Konfigurasi API</span>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
		</div>
	</div>
@endsection('content')