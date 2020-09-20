<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home.admin') }}">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-user-graduate"></i>
    </div>
    <div class="sidebar-brand-text mx-3">DASHBOARD</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
    <a class="nav-link" href="{{ route('home.admin') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Home</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-bullhorn"></i>
        <span>Pengumuman</span></a>
    </li>

    <!-- Nav Item - Users -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
        <div id="collapseUser" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">Guru</a>
            <a class="collapse-item" href="#">Siswa</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
    <a class="nav-link" href="{{ route('kelas.index') }}">
        <i class="fas fa-chalkboard-teacher"></i>
        <span>Kelas</span></a>
    </li>

    <!-- Nav Item - Mapel -->
    <li class="nav-item">
    <a class="nav-link" href="{{ route('mapel.index') }}">
        <i class="fas fa-book-open"></i>
        <span>Mapel</span></a>
    </li>

    <!-- Nav Item - Assets -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAssets" aria-expanded="true" aria-controls="collapseAssets">
            <i class="fas fa-scroll"></i>
            <span>Assets</span>
        </a>
        <div id="collapseAssets" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('materi.index') }}">Materi</a>
            <a class="collapse-item" href="#">Soal</a>
            </div>
        </div>
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