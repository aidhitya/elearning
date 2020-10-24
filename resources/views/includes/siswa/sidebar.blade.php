<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-user-graduate"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DASHBOARD</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ \Route::currentRouteName() == 'murid.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('murid.index') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Home</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item {{ request()->is('mapel') ? 'active' : (request()->is('mapel/*') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('list.mapel') }}">
          <i class="fas fa-book-open"></i>
          <span>Mata Pelajaran</span></a>
      </li>

      <li class="nav-item {{ request()->is('tugas') ? 'active' : (request()->is('tugas/*') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('list.tugas') }}">
          <i class="fas fa-swatchbook"></i>
          <span>Tugas</span></a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item {{ request()->is('soal') ? 'active' : (request()->is('soal/*') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('list.soal') }}">
          <i class="fas fa-tasks"></i>
          <span>Soal</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>