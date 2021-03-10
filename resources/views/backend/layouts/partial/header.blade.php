
<!-- header area start -->
<div class="header-area">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-6 col-sm-8 clearfix ">
            <div class="header-left">
                <div class="nav-btn pull-left">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="search-box pull-left">
                    <form action="#">
                        <input type="text" name="search" placeholder="Search here" required>
                        <i class="ti-search"></i>
                    </form>
                </div>
            </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
                <li id="full-view"><i class="ti-fullscreen"></i></li>
                <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                {{-- Profile part start --}}
                <li class="dropdown">
                    <div class="profile">
                        <img src="{{asset('images/admin.png')}}" alt="">
                        <span class="user-name dropdown-toggle" data-toggle="dropdown"> {{ Auth::guard()->user()->name }}<i class="ti-angle-down pl-1"></i></span>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
                {{-- Profile part end --}}
            </ul>
        </div>
    </div>
</div>
<!-- header area end -->
