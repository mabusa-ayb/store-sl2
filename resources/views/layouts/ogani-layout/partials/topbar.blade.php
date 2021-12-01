<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> info@sl2.co.za</li>
                            <li>Confirm shipping costs for All orders</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="https://www.facebook.com/theembroideryshopzw" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="img/language.png" alt="">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>

                        @auth
                            <div class="header__top__right__auth">
                                    <a href="{{ url('/profile/logout') }}"><i class="fa fa-sign-out"></i>Logout</a>
                            </div>
                                @else
                            <div class="header__top__right__auth">
                                    <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login</a>
                            </div>
                        |
                            <div class="header__top__right__auth">
                                    <a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> Register</a>
                            </div>

                        @endauth
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
                    <a href="index.html"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ Request::is('ogani') ? 'active': '' }}"><a href="/ogani">Home</a></li>
                        <li class="{{ Request::is('ogani-shop') || Request::is('ogani-category*') ? 'active': '' }}"><a href="/ogani-shop">Shop</a></li>
                        <li class="{{ Request::is('ogani-cart') || Request::is('ogani-checkout') ? 'active': '' }}"><a href="#">Shopping</a>
                            <ul class="header__menu__dropdown">
                                <li class="{{ Request::is('ogani-cart') ? 'active': '' }}"><a href="/ogani-cart">Shopping Cart</a></li>
                                <li class="{{ Request::is('ogani-checkout') ? 'active': '' }}"><a href="/ogani-checkout">Check Out</a></li>
                            </ul>
                        </li>
                        @auth
                        <li class="{{ Request::is('profile') || Request::is('ogani-checkout') ? 'active': '' }}"><a href="#">Profile</a>
                            <ul class="header__menu__dropdown">
                                <li class="{{ Request::is('profile') ? 'active': '' }}"><a href="/profile">Orders</a></li>
                                <li class="{{ Request::is('profile') ? 'active': '' }}"><a href="/profile/details">User Details</a></li>
                            </ul>
                        </li>
                        @endauth
                        <li class="{{ Request::is('ogani-contact') ? 'active': '' }}"><a href="/ogani-contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        @if( \Cart::getTotalQuantity() != 0)
                        <li><a href="{{ route('ogani-cart') }}"><i class="fa fa-shopping-cart"></i> <span>{{ \Cart::getTotalQuantity()}}</span></a></li>
                        @else
                        <li><a href="{{ route('ogani-shop') }}"><i class="fa fa-shopping-cart"></i> <span>{{ \Cart::getTotalQuantity()}}</span></a></li>
                        @endif
                    </ul>
                    <div class="header__cart__price">total: <span>${{ \Cart::getTotal() }}</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
