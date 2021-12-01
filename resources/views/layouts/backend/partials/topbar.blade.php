<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
      <ul class="navbar-nav ml-auto">

          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                  <i class="far fa-user"></i> <strong>{{ ucwords(Auth::user()->name) }}</strong>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('user-details.index') }}" class="dropdown-item">
                      <i class="fas fa-users mr-2"></i> My Profile
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('logout') }}" class="nav-link"
                     onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                      <i class="fas fa-door-open mr-2"></i> Logout
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>

                  </a>
              </div>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->
