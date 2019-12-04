<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">OPERATIONAL</li>
        <!-- Optionally, you can add icons to the links -->
        <li class=""><a href="{{route ('home.index')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class=""><a href="{{route ('home.create')}}"><i class="fa fa-plus"></i> <span>Tambah User</span></a></li>
        <li><a href="{{route ('cari')}}"><i class="fa fa-search"></i> <span>Cari User</span></a></li>
        <li><a href="{{route ('sinkronisasi')}}"><i class="fa fa-refresh"></i> <span>Sinkronisasi</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Prodi</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route ('prodi.index')}}">Daftar Prodi</a></li>
            <li><a href="{{route ('prodi.create')}}">Tambah Prodi</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Fakultas</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route ('fakultas.index')}}">Daftar Fakultas</a></li>
            <li><a href="{{route ('fakultas.create')}}">Tambah Fakultas</a></li>
          </ul>
        </li>
        <li class="header">SERVER</li>
        <li><a href="{{route ('infoserver')}}"><i class="fa fa-info"></i> <span>Info Server</span></a></li>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>