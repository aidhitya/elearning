<div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light bg-white con-navbar">
      <a href="#" class="navbar-brand">
        <i class="fas fa-book-open" style="font-size: 1.5em"> Elearning</i>
      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navNomads">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navNomads">
        <ul class="navbar-nav ml-auto mr-3">
          <li class="nav-item mx-md-2"><a href="#" class="nav-link active">Home</a></li>
          <li class="nav-item mx-md-2"><a href="#" class="nav-link">Paket Travel</a></li>
          <li class="nav-item dropdown mx-md-2"><a href="#" class="nav-link dropdown-toggle" id="navbarDrop"
              data-toggle="dropdown">Services</a>
            <div class="dropdown-menu" id="navbarDrop">
              <a href="#" class="dropdown-item">Link1</a>
              <a href="#" class="dropdown-item">Link2</a>
              <a href="#" class="dropdown-item">Link3</a>
            </div>
          </li>
          <li class="nav-item mx-md-2"><a href="#" class="nav-link">Testimonial</a></li>
        </ul>

        <!-- Desktop Button  -->
        @guest
          <a class="btn btn-link form-inline my-2 my-lg-0 d-md-block d-none text-decoration-none" href="{{ route('login') }}">
              {{ __('Log In') }}
          </a>
          {{-- <form action="{{ route('login') }}" class="form-inline my-2 my-lg-0 d-md-block d-none">
            <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">Log In</button>
          </form> --}}
        @endguest
        @auth
          <form action="{{ url('logout') }}" method="POST" class="form-inline my-2 my-lg-0 d-md-block d-none">
            @csrf
            <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">LogOut</button>
          </form>
        @endauth

      </div>
    </nav>
  </div>