
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="{{url('/')}}" class="logo d-flex align-items-center">
    <img src="{{url('assets/img/logo.png')}}" alt="">
    <span class="d-none d-lg-block">{{Helpers::getschool_name()}}</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div>

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="find" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div>

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li> 
    <!-- End Search Icon-->

    <li class="nav-item dropdown">

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number">{{Helpers::Notifcations() ? count(Helpers::Notifcations()) : 0 }}</span>
      </a>

    @if (Helpers::Notifcations())
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">

        <li class="dropdown-header">
          You have  <span class="badge rounded-pill bg-dark p-2 ms-2"> {{ count(Helpers::Notifcations()) ?? 0 }} </span>  new notifications

        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        @forelse (Helpers::Notifcations() as $row)

      <li class="notification-item">
        <i class="bi bi-info-circle text-info"></i>
        <div>
          <h4>{{ $row->data['message'] }}</h4>
          <p class="text-muted">
            <a href="{{ $row->data['link'] }}">View</a>
          </p>
          <p>{{ Helpers::getTime($row->created_at) }}</p>
        </div>
      </li>

      <li>
        <hr class="dropdown-divider">
      </li>
      @empty
           
      <li class="notification-item">
        <div>
          <h4>Empty Notification!</h4>
        </div>
      </li>
      @endforelse

        <li class="dropdown-footer">
          <a href="#">Show all notifications</a>
        </li>

      </ul> 
      <!-- End Notification Dropdown Items -->
      @endif

    </li>       

    <!-- End Notification Nav -->

    <li class="nav-item dropdown">

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-chat-left-text"></i>
        <span class="badge bg-success badge-number">3</span>
      </a>
      <!-- End Messages Icon -->

      <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
        <li class="dropdown-header">
          You have 3 new messages
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="message-item">
          <a href="#">
            <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
            <div>
              <h4>Maria Hudson</h4>
              <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
              <p>4 hrs. ago</p>
            </div>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="message-item">
          <a href="#">
            <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
            <div>
              <h4>Anna Nelson</h4>
              <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
              <p>6 hrs. ago</p>
            </div>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="message-item">
          <a href="#">
            <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
            <div>
              <h4>David Muldon</h4>
              <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
              <p>8 hrs. ago</p>
            </div>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="dropdown-footer">
          <a href="#">Show all messages</a>
        </li>

      </ul> -->
      <!-- End Messages Dropdown Items -->

    </li>
    <!-- End Messages Nav -->

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="{{url('assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2">
          @if(session()->exists("USERS_ROW"))
          {{session()->get('USERS_ROW')->firstname . " " . session()->get('USERS_ROW')->lastname}}
          @endif
        </span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6>
          @if(session()->exists("USERS_ROW"))
          {{session('USERS_ROW')->firstname . " " . session('USERS_ROW')->lastname}}
          @endif
          </h6>
          <span>
            @if(session()->exists("USERS_ROW"))
            {{ strtoupper(session('USERS_ROW')->rank) }}
            @endif
          </span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{url('/profile')}}">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{url('/profile')}}">
            <i class="bi bi-gear"></i>
            <span>Account Settings</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{url('/faq')}}">
            <i class="bi bi-question-circle"></i>
            <span>Need Help?</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{url('/logout')}}">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->
  
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{url('/')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-heading">Pages</li>

      @if ($rank->hasRank('super admin'))
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/schools')}}">
          <i class="bi bi-house-fill"></i>
          <span>Schools</span>
        </a>
      </li>
      @endif

      @if ($rank->hasRank('instructor'))
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/classes')}}">
          <i class="bi bi-house"></i>
          <span>Classes</span>
        </a>
      </li>
      @endif

      @if ($rank->hasRank())
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('myclass')}}">
          <i class="bi bi-house"></i>
          <span>My Classes</span>
        </a>
      </li>
      @endif

      @if ($rank->hasRank('instructor'))
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/staffs')}}">
          <i class="bi bi-person-fill"></i>
          <span>Staffs</span>
        </a>
      </li>
      @endif

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/students')}}">
          <i class="bi bi-person-fill"></i>
          <span>Students</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/contact')}}">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/register')}}">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/login')}}">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->