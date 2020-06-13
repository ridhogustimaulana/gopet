<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <div class="user-profile"
             style="background: url({{ asset('backend//assets/images/background/user-info.jpg') }}) no-repeat;">
            <div class="profile-img"><img src="{{ asset('images/' . Auth::user()->image) }}" alt="user"/>
            </div>
            <div class="profile-text">
                <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button"
                   aria-haspopup="true" aria-expanded="true">{{ Auth::user()->name }}</a>
                <div class="dropdown-menu animated flipInY">
                    <a href="{{ route('doctor.profile') }}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('doctor.logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="{{ Request::segment(2) === '' || Request::segment(2) === 'home' ? 'active' : null }}">
                    <a href="{{ route('doctor.home') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">&ensp;Dashboard</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'petshop' ? 'active' : null }}">
                    <a href="{{ route('doctor.diagnosa') }}" aria-expanded="false"><i class="fa fa-stethoscope"></i><span class="hide-menu">&ensp;Diagnosis</span></a>
                </li>
            </ul>
        </nav>
    </div>
</aside>