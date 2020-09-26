<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> 097-97-01-804</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> support@electro.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> Kyiv, Maidan Nezaleznosti street, 8-A</a></li>
            </ul>
            <ul class="header-links pull-right">
                <li class="nav-item dropdown">
                    @guest
                        <a href="#"><i class="fa fa-dollar"></i> USD</a>
                    @else
                        <a href="#">&nbsp {{ Auth::user()->currency->currency }} <i class="fa fa-dollar"></i></a>
                    @endguest
                </li>
                @guest
                    <li><a href="{{ route('home') }}"><i class="fa fa-user-o"></i> My Account</a></li>
                @else
                    <!-- <li><a href="{{ route('home') }}"><i class="fa fa-user-o"></i>  {{ Auth::user()->name }}</a></li> -->

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-user-o"></i> {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" style="background-color: #2E3440;">
                            <a class="dropdown-item" href="{{ route('home') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('home-form').submit();">
                                <i class="fa fa-home"></i> {{ __('Home') }}
                                <form id="home-form" action="{{ route('home') }}" method="GET" class="d-none">
                                    @csrf
                                </form>
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </li>
                        @if (Auth::user()->isAdmin())
                            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-cogs"></i> Admin Panel</a></li>
                        @endif
                @endguest
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="{{ route('store') }}" class="logo">
                            <img src="{{ asset('./img/logo.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form method="GET" action="{{ route('store.search') }}">
                            <select class="input-select" name="select" id="select">
                                <option value="electronics">All Categories</option>
                                <option value="laptops">Laptops</option>
                                <option value="smartphones">Smartphones</option>
                            </select>
                            <input class="input" placeholder="Search here" name="search">
                            <button class="search-btn" type="submit">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                @auth
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            <a href=" {{ route('home.wishlist') }}">
                                <i class="fa fa-heart-o"></i>
                                <span>Your Wishlist</span>
                                <div class="qty">{{ count(Auth::user()->wishlist()) }}</div>
                            </a>
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <div class="qty">{{ count(Auth::user()->wishlist('cart')) }}</div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-btns">
                                    <a href="{{ route('home.cart') }}">View Cart</a>
                                    <a href="{{ route('checkout') }}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                @endauth
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
