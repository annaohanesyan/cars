    <!-- partial:partials/_navbar.html -->
    <nav class="navbar p-0 fixed-top d-flex flex-row" style="left:120px">
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
       
        <ul class="navbar-nav w-100">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('user') }}">
                    <img class="img-xs rounded-circle" src="{{asset('images/car-logo.png')}}" alt="">
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('carsmakes.index') }}">
                    <span>Makes</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('carsmodels.index') }}">
                    <span>Models</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link" href="#">
                <i class="mdi mdi-view-grid"></i>
            </a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                <div class="navbar-profile">
                <img class="img-xs rounded-circle" src="{{asset('images/img_avatar3.png')}}" alt="">
                <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                <h6 class="p-3 mb-0">Profile</h6>
                <div class="preview-item-content">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout text-danger"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <p class="p-3 mb-0 text-center">Advanced settings</p>
            </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
        </button>
        </div>
    </nav>
    <!-- partial -->