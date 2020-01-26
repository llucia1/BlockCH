<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">

        <a class="navbar-brand brand-logo" href="{{ route('home') }}"><img src="{{asset('/images/cabecera_web_eicbi-01.png')}}" alt="logo"/></a>
        
        <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img src="{{asset('/images/cabecera_web_eicbi-01_mini.png')}}" alt="logo"/></a>
    
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-stretch">

        <div class="search-field d-none d-md-block">

        </div>

        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item nav-profile dropdown">

                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                    <img src="{{asset('/images/faces/face1.jpg')}}" alt="image">
                    <span class="availability-status online"></span>             
                    </div>
                    <div class="nav-profile-text">
                    <p class="mb-1 text-black">{{Auth::user()->name}}</p>
                    </div>
                </a>

                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout mr-2 text-primary"></i>
                        {{ trans('app.signout') }} 
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </div>

            </li>
            
            @if ( App\Helpers\Alerts::getAlert('Webminar') )

                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                      <i class="mdi mdi-at"></i>
                      <span class="count-symbol bg-danger"></span>
                    </a>
                </li>
            
            @endif

        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>

    </div>

</nav>