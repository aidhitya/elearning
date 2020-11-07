<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
      <li class="nav-item {{ \Route::currentRouteName() == 'home.guru' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home.guru') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Home</span></a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item {{ \Route::currentRouteName() == 'data.kelas.guru' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-laptop-house"></i>
          <span>Kelas</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            @foreach ($datakelas->mengajar as $item)
                <a class="collapse-item" href="{{ route('data.kelas.guru', $item->kelas->kelas .'-'. $item->kelas->kode_kelas) }}">Kelas {{ $item->kelas->kelas }}{{ $item->kelas->kode_kelas }}</a>
            @endforeach
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item  {{ request()->is('assets/*') ? 'active' : (\Route::currentRouteName() == 'tugas.index' ? 'active' : (request()->is('guru/tugas/*') ? 'active' : '')) }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
          aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-tasks"></i>
          <span>Assets</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('soal.index') }}">Soal</a>
            <a class="collapse-item" href="{{ route('materi.index') }}">Materi</a>
            <a class="collapse-item" href="{{ route('tugas.index') }}">Tugas</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pengumuman -->
      <li class="nav-item {{ request()->is('guru/soal') ? 'active' : (request()->is('guru/soal/*') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('data.soal.guru') }}">
          <i class="fas fa-book-open"></i>
          <span>Detail Soal</span></a>
      </li>

      <!-- Nav Item - Pengumuman -->
      <li class="nav-item {{ request()->is('pengumuman') ? 'active' : (request()->is('pengumuman/*') ? 'active' : '') }}">
        <a class="nav-link" href="{{ route('pengumuman.index') }}">
          <i class="fas fa-bullhorn"></i>
          <span>Pengumuman</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

</ul>