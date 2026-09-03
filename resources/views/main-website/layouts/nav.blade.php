<div class="col-9 text-right">

    <span class="d-inline-block d-lg-none">
        <a href="#" class="site-menu-toggle js-menu-toggle py-5">
            <span class="icon-menu h3 text-black"></span>
        </a>
    </span>

    <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
        <ul class="site-menu main-menu js-clone-nav ml-auto">
            <li class="active"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
            <li><a href="{{ route('listingcars') }}" class="nav-link">Listing</a></li>
            <li><a href="{{ route('testimonials.index') }}" class="nav-link">Testimonials</a></li>
            <li><a href="{{ route('about-us') }}" class="nav-link">About</a></li>
            <li><a href="{{ route('contact.index') }}" class="nav-link">Contact</a></li>

            @guest
                <!-- only show for guest-->
                <li><a href="{{ route('register') }}" class="nav-link">Register</a></li>
            @endguest

            @auth
                <!-- appear for user after login-->
                <li>
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                        class="nav-link">
                        Dashboard ({{ auth()->user()->full_name }})
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth
        </ul>
    </nav>
</div>
