  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
      <img id="logoNavbar" src="{{ asset('assets/img/logo/logo.png') }}">
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::segment(2) == '' ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item  {{ Request::segment(3) == 'artikel' || Request::segment(3) == 'foto' || Request::segment(3) == 'video' || Request::segment(3) == 'publikasi' || Request::segment(3) == 'audio'  ? 'active' : '' }}">
      <a class="nav-link  {{ Request::segment(3) == 'artikel' || Request::segment(3) == 'foto' || Request::segment(3) == 'video' || Request::segment(3) == 'publikasi' || Request::segment(3) == 'audio'  ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded=" {{ Request::segment(3) == 'artikel' || Request::segment(3) == 'foto' || Request::segment(3) == 'video' || Request::segment(3) == 'publikasi' || Request::segment(3) == 'audio' ? 'true' : 'false' }}" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-th-large"></i>
        <span>Konten</span>
      </a>
      <div id="collapseTwo" class="collapse  {{ Request::segment(3) == 'artikel' || Request::segment(3) == 'foto' || Request::segment(3) == 'video' || Request::segment(3) == 'publikasi' || Request::segment(3) == 'audio' ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
        <div class="bg-submenu-nav py-2 collapse-inner rounded">
          <a class="collapse-item {{ Request::segment(3) == 'artikel' ? 'active' : '' }}" href="{{ route('admin.article.index') }}"><i class="fas fa-fw fa-newspaper mr-1"></i> Artikel</a>
          <a class="collapse-item {{ Request::segment(3) == 'foto' ? 'active' : '' }}" href="{{ route('admin.photo.index') }}"><i class="fas fa-fw fa-image mr-1"></i>Foto</a>
          <a class="collapse-item {{ Request::segment(3) == 'video' ? 'active' : '' }}" href="{{ route('admin.video.index') }}"><i class="fas fa-fw fa-video mr-1"></i>Video</a>
          <a class="collapse-item {{ Request::segment(3) == 'publikasi' ? 'active' : '' }}" href="{{ route('admin.publication.index') }}"><i class="fas fa-fw fa-newspaper mr-1"></i>Publikasi</a>
          <a class="collapse-item {{ Request::segment(3) == 'audio' ? 'active' : '' }}" href="{{ route('admin.audio.index') }}"><i class="fas fa-fw fa-volume-up mr-1"></i>Audio</a>
        </div>
      </div>
    </li>
    <li class="nav-item {{ Request::segment(3) == 'kegiatan' || Request::segment(3) == 'kerjasama' ? 'active' : '' }}">
      <a class="nav-link {{ Request::segment(3) == 'kegiatan' || Request::segment(3) == 'kerjasama' ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseTwoa" aria-expanded="false" aria-controls="collapseTwoa">
        <i class="fas fa-fw fa-info"></i>
        <span>Informasi</span>
      </a>
      <div id="collapseTwoa" class="collapse {{ Request::segment(3) == 'kegiatan' || Request::segment(3) == 'kerjasama' ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
        <div class="bg-submenu-nav py-2 collapse-inner rounded">
          <a class="collapse-item {{ Request::segment(3) == 'kegiatan' ? 'active' : '' }}" href="{{ route('admin.kegiatan.index') }}"><i class="fas fa-fw fa-newspaper mr-1"></i> Kegiatan</a>
          <a class="collapse-item {{ Request::segment(3) == 'kerjasama' ? 'active' : '' }}" href="{{ route('admin.kerjasama.index') }}"><i class="fas fa-fw fa-image mr-1"></i>Kerja sama</a>
        </div>
      </div>
    </li>
    <!-- Divider -->
    <li class="nav-item {{ Request::segment(2) == 'artikel-kontributor' ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.contributor_article.index') }}">
        <i class="fas fa-fw fa-edit"></i>
        <span>Kiriman Kontributor</span></a>
    </li>
    <hr class="sidebar-divider">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::segment(3) == 'rempah' || Request::segment(3) == 'kontributor' ? 'active' : '' }}">
      <a class="nav-link {{ Request::segment(3) == 'rempah' || Request::segment(3) == 'kontributor' ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#masterData" aria-expanded="false" aria-controls="masterData">
        <i class="fas fa-fw fa-database"></i>
        <span>Master Data</span>
      </a>
      <div id="masterData" class="collapse {{ Request::segment(3) == 'rempah' || Request::segment(3) == 'kontributor' ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
        <div class="bg-submenu-nav py-2 collapse-inner rounded">
          <a class="collapse-item {{ Request::segment(3) == 'rempah' ? 'active' : '' }}" href="{{ route('admin.rempah.index') }}"><i class="fas fa-fw fa-leaf mr-1"></i>Jenis Rempah</a>
          <a class="collapse-item {{ Request::segment(3) == 'kontributor' ? 'active' : '' }}" href="{{ route('admin.contributor.index') }}"><i class="fas fa-fw fa-edit mr-1"></i>Kontributor</a>
        </div>
      </div>
    </li>
    @if( auth()->user()->role == 'super admin' )
    <li class="nav-item {{ Request::segment(2) == 'user' ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.user.index') }}">
        <i class="fas fa-fw fa-user-circle"></i>
        <span>User</span></a>
    </li>
    @endif
    <li class="nav-item {{ Request::segment(2) == 'pengaturan' ? 'active' : '' }}" >
      <a class="nav-link" href="{{ route('admin.setting.index') }}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Pengaturan</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <!-- <button class="rounded-circle border-0" id="sidebarToggle"></button> -->
    </div>
  </ul>
  <!-- End of Sidebar -->
