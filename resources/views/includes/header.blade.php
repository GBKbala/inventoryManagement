<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
       
        <ul class="navbar-nav flex-row align-items-center ms-auto">
        
    
        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar">
                    <img src="{{ asset('assets/img/avatars/user.png') }}" alt class="w-px-40 h-auto rounded-circle">
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="pages-account-settings-account.html">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                                <img src="{{ asset('assets/img/avatars/user.png') }}" alt class="w-px-40 h-auto rounded-circle">
                            </div>
                        </div>
                      
                        @if(auth()->user())
                        <div class="flex-grow-1">
                        @php
                            $userRole = '';
                            switch(auth()->user()->userRole) {
                                case 0:
                                    $userRole = 'Superadmin';
                                    break;
                                case 1:
                                    $userRole = 'Admin';
                                    break;
                                case 2:
                                    $userRole = 'User';
                                    break;
                                default:
                                    $userRole = 'Unknown';
                                    break;
                            }
                        @endphp
                            <span class="fw-medium d-block">{{auth()->user()->firstname}} {{auth()->user()->lastname}}</span>
                            <small class="text-muted">
                                {{$userRole}}
                            </small>
                        </div>
                        @endif
                    </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('changePassword') }}">
                    <i class="bx bx-lock me-2"></i>
                    <span class="align-middle">Change Password</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout')}}">
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle">Log Out</span>
                    </a>
                </li>
            </ul>
        </li>
        <!--/ User -->
        </ul>
    </div>
    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper  d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
        <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
    </div>
</nav>
<!-- / Navbar -->