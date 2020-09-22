<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-user-graduate"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DASHBOARD</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Home</span></a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-laptop-house"></i>
          <span>Kelas</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            @foreach ($data->mengajar as $item)
                <a class="collapse-item" href="#">Kelas {{ $item->kelas->kelas }}{{ $item->kelas->kode_kelas }}</a>
            @endforeach
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
          aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-tasks"></i>
          <span>Soal</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">Ulangan</a>
            <a class="collapse-item" href="#">Quiz</a>
            <a class="collapse-item" href="#">Tugas</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pengumuman -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-book-open"></i>
          <span>Materi</span></a>
      </li>

      <!-- Nav Item - Pengumuman -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-star-half-alt"></i>
          <span>Nilai</span></a>
      </li>

      <!-- Nav Item - Pengumuman -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-scroll"></i>
          <span>Pengumuman</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

</ul>