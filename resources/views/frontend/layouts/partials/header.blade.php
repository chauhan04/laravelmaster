<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center header-inner">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="{{ route('frontend.index') }}">Laravel</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href=index.html" class="logo"><img src="{{ asset('frontend/images/images/logo.png') }}" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{ route('frontend.index') }}">{{ __('Home') }}</a></li>
          <li><a class="nav-link scrollto" href="{{ route('frontend.contactus') }}">{{ __('Contact Us') }}</a></li>
          <li><a class="nav-link scrollto" href="{{ route('frontend.aboutus') }}">{{ __('About Us') }}</a></li>
          @auth
          <li class="dropdown"><a href="{{ route('frontend.dashboard') }}"><span>{{ __('My Account') }}</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li class="dropdown"><a href="{{ route('frontend.profile') }}"><span>{{ __('Profile') }}</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="{{ route('frontend.changepassword') }}">{{ __('Change Password') }}</a></li>
                </ul>
              </li>
              <li><a href="{{ route('frontend.logout') }}">{{ __('Logout') }}</a></li>
            </ul>
          </li>
          @else
          <li><a href="{{ route('frontend.login') }}">{{ __('Sign In') }}</a></li>
          @endauth
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->