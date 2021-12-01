<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="{{ route('ogani-shop')}}"><i class="fa fa-shopping-bag"></i> <span>{{ \Cart::getTotalQuantity()}}</span></a></li>
        </ul>
        <div class="header__cart__price">total: <span>${{ \Cart::getTotalQuantity()}}</span></div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            <img src="img/language.png" alt="">
            <div>English</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="#">English</a></li>
            </ul>
        </div>
        <div class="header__top__right__auth">
            <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/ogani-shop">Shop</a></li>
            <li><a href="#">Shopping</a>
                <ul class="header__menu__dropdown">
                    <li><a href="/ogani-cart">Shoping Cart</a></li>
                    <li><a href="/ogani-checkout">Check Out</a></li>
                </ul>
            </li>
            <li><a href="/ogani-contact">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> theembroideryshopzw@gmail.com</li>
            <li>confirm shipping for all items bought.</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->
