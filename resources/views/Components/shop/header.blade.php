<div class="header__top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="header__top__left">
                    <ul>
                        <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                        <li>Free Shipping for all Order of $99</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="header__top__right">
                    <div class="header__top__right__social">
                        <a href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-twitter"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-pinterest-p"></i></a>
                    </div>
                    <div class="header__top__right__auth">

                        <ul class="navbar-nav" id="login_or_succ">
                            @guest('web')
                            <li class="nav-item">
                                <a href="{{route('login')}}"><i class="fa fa-user"></i> Login</a>
                            </li>
                            @else
                            <div class="dropdown">
                                <a href="javascript:void(0);" onclick="toggleDropdown()" class="dropbtn">{{ Auth::user()->us_name }}<span id="arr">&#9660;</span></a>
                                <div id="myDropdown" class="dropdown-content" style="display: none;">
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="nav-icon fa fa-address-card" aria-hidden="true"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="nav-icon fa fa-sign-out" aria-hidden="true"></i> Logout
                                    </a>
                                </div>
                            </div>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="header__logo">
                <a href="{{ route('home') }}"><img src="{{asset('img/logo.png')}}" alt=""></a>
            </div>
        </div>
        <div class="col-lg-6">
            <nav class="header__menu">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('category.showAll') }}">Shop</a></li>
                    <li><a href="javascript:void(0);">Pages</a>
                        <ul class="header__menu__dropdown">
                            <li><a href="./shop-details.html">Shop Details</a></li>
                            <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                            <li><a href="./checkout.html">Check Out</a></li>
                            <li><a href="./blog-details.html">Blog Details</a></li>
                        </ul>
                    </li>
                    <li><a href="./blog.html">Blog</a></li>
                    <li><a href="./contact.html">Contact</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-lg-3">
            <div class="header__cart">
                <ul>
                    <li><a href="javascript:void(0);"><i class="fa fa-heart"></i> <span>1</span></a></li>
                    <li><a href="javascript:void(0);"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                </ul>
                <div class="header__cart__price">item: <span>$150.00</span></div>
            </div>
        </div>
    </div>
    <div class="humberger__open">
        <i class="fa fa-bars"></i>
    </div>
</div>

<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="{{ route('home') }}"><img src="img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="javascript:void(0);"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="javascript:void(0);"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="./shop-grid.html">Shop</a></li>
            <li><a href="javascript:void(0);">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="./shop-details.html">Shop Details</a></li>
                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                    <li><a href="./checkout.html">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="./blog.html">Blog</a></li>
            <li><a href="./contact.html">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
        <a href="javascript:void(0);"><i class="fa fa-twitter"></i></a>
        <a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a>
        <a href="javascript:void(0);"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
            <li>Free Shipping for all Order of $99</li>
        </ul>
    </div>
</div>