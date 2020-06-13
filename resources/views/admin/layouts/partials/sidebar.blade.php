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
                    <a href="{{ route('admin.logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="{{ Request::segment(2) === '' || Request::segment(2) === 'home' ? 'active' : null }}">
                    <a href="{{ route('admin.home') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">&ensp;Dashboard</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'petshop' ? 'active' : null }}">
                    <a href="{{ route('admin.petshop') }}" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">&ensp;PetShop</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'washing-and-spa' ? 'active' : null }}">
                    <a href="{{ route('admin.washing-and-spa') }}" aria-expanded="false"><i class="fa fa-shower"></i><span class="hide-menu">&ensp;Washing and Spa</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'buying-animal' ? 'active' : null }}">
                    <a href="{{ route('admin.buying-animal') }}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">&ensp;Buying Animal</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'community' ? 'active' : null }}">
                    <a href="{{ route('admin.community') }}" aria-expanded="false"><i class="mdi mdi-google-circles-communities"></i><span class="hide-menu">&ensp;Community</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'doctor' ? 'active' : null }}">
                    <a href="{{ route('admin.doctor') }}" aria-expanded="false"><i class="fa fa-user-md"></i><span class="hide-menu">&ensp;Doctor</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'user-petshop' ? 'active' : null }}">
                    <a href="{{ route('admin.user-petshop') }}" aria-expanded="false"><i class="fa fa-user-o"></i><span class="hide-menu">&ensp;User Petshop</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'user' ? 'active' : null }}">
                    <a href="{{ route('admin.user') }}" aria-expanded="false"><i class="fa fa-user-o"></i><span class="hide-menu">&ensp;User</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'item' ? 'active' : null }}">
                    <a href="{{ route('admin.item') }}" aria-expanded="false"><i class="fa fa-file-image-o"></i><span class="hide-menu">&ensp;Item</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'order' ? 'active' : null }}">
                    <a href="{{ route('admin.order') }}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">&ensp;Order</span></a>
                </li>
            </ul>
        </nav>
    </div>
</aside>