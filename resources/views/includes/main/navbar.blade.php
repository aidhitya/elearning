<div class="container">
        <nav class="navbar navbar-expand-lg justify-content-between">
            <a href="{{ route('home') }}" class="navbar-brand b-xs text-center text-navbar">
                <img src="{{ url('https://www.smpn4pemalang.sch.id/upload/imagecache/72798512logo-97x100.png') }}" alt="elearning" class="rounded w-50 h-50">
                <h6>SMPN 4 PEMALANG</h6>
            </a>
            @if (\Route::currentRouteName() == 'home')
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navelearning">
                  <i class="fas fa-bars" style="color:#FFFFFF; font-size: 28px;"></i>
              </button>
            @endif

            <div class="collapse navbar-collapse" id="navelearning">
              <ul class="navbar-nav mx-auto break-tog">
                <li class="nav-item mr-5"><a href="{{ route('home') }}" class="nav-link text-navbar {{ \Route::currentRouteName() == 'home' ? 'active' : '' }}">HOME</a></li>
                <li class="nav-item mr-5"><a href="{{ \Route::currentRouteName() == 'home' ? '#pengumuman' : route('home').'#pengumuman' }}" class="nav-link text-navbar {{ \Route::currentRouteName() == 'home.pengumuman' ? 'active' : (\Route::currentRouteName() == 'detail.pengumuman' ? 'active' : '') }}">PENGUMUMAN</a></li>
                <li class="nav-item mr-5"><a href="{{ \Route::currentRouteName() == 'home' ? '#panduan' : route('home').'#panduan' }}" class="nav-link text-navbar">PANDUAN</a></li>
                <li class="nav-item mr-5"><a href="{{ \Route::currentRouteName() == 'home' ? '#kontak' : route('home').'#kontak' }}" class="nav-link text-navbar">KONTAK</a></li>
                @auth
                  <div class="mb-1 d-lg-none d-block">
                    <li class="nav-item mt-3 mb-2">
                      <a class="text-navbar" href="{{ Auth::user()->role == 0 ? route('home.admin') : (Auth::user()->role == 1 ? route('home.guru') : route('murid.index'))  }}">
                        Dashboard
                      </a>
                    </li>
                      <hr>
                    <li class="nav-item mt-3 mb-2">
                      <a class="text-navbar m-2" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                      </a>
                    </li>
                  </div>
                @endauth
              </ul>

                <!-- Mobile Button  -->
                @guest
                  <div class="d-sm-block d-md-none d-inline float-right mb-1">
                    <a href="{{ route('login') }}" class="btn my-2 my-sm-0 float-left text-navbar {{ \Route::currentRouteName() == 'login' ? 'active' : '' }}">MASUK</a>
                  </div>
                  <!-- Desktop Button  -->
                  <div class="d-inline my-2 my-lg-0 d-md-block d-none">
                    <a href="{{ route('login') }}" class="btn btn-navbar-right my-2 my-sm-0 px-4 text-navbar {{ \Route::currentRouteName() == 'login' ? 'active' : '' }}">MASUK</a>
                  </div>
                @endguest
                @auth
                    <div class="dropdown no-arrow d-lg-block d-none">
                      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle w-75" src="https://ui-avatars.com/api/name={{ Auth::user()->nama }}">
                      </a>
                    <!-- Dropdown - User Information -->
                      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ Auth::user()->role == 0 ? route('home.admin') : (Auth::user()->role == 1 ? route('home.guru') : route('murid.index'))  }}">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Dashboard
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                      </div>
                    </div>
                @endauth
            </div>
        </nav>
    </div>

    <!-- Header -->
    <header class="text-center justify-content-center">
      @if (\Route::currentRouteName() == 'home')
        <img src="{{ asset('assets/images/design2.png') }}" alt="brand" class="w-50 h-auto" style="margin-top: 80px;">
      @endif
    </header>