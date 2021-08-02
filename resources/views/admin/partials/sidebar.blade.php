<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <img id="logoNavbar" src="{{ asset('assets/img/logo/logo.png') }}">
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-th-large"></i>
        <span>Konten</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
        <div class="bg-submenu-nav py-2 collapse-inner rounded">
          <a class="collapse-item {{ Request::segment(3) == 'artikel' ? 'active' : '' }}" href="{{ route('admin.article.index') }}"><i class="fas fa-fw fa-newspaper mr-1"></i> Artikel</a>
          <a class="collapse-item {{ Request::segment(3) == 'foto' ? 'active' : '' }}" href="{{ route('admin.photo.index') }}"><i class="fas fa-fw fa-image mr-1"></i>Foto</a>
          <a class="collapse-item {{ Request::segment(3) == 'video' ? 'active' : '' }}" href="{{ route('admin.video.index') }}"><i class="fas fa-fw fa-video mr-1"></i>Video</a>
          <a class="collapse-item {{ Request::segment(3) == 'publikasi' ? 'active' : '' }}" href="{{ route('admin.publication.index') }}"><i class="fas fa-fw fa-newspaper mr-1"></i>Publikasi</a>
          <a class="collapse-item {{ Request::segment(3) == 'audio' ? 'active' : '' }}" href="{{ route('admin.audio.index') }}"><i class="fas fa-fw fa-volume-up mr-1"></i>Audio</a>
        </div>
      </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link" href="master-data.html">
        <i class="fas fa-fw fa-database"></i>
        <span>Master Data</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="user.html">
        <i class="fas fa-fw fa-user-circle"></i>
        <span>User</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pengaturan.html">
        <i class="fas fa-fw fa-cog"></i>
        <span>Pengaturan</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
  </ul>
  <!-- End of Sidebar -->