<header class="header header-6">

    <!-- ================= HEADER TOP ================= -->
    <div class="header-top">
        <div class="container">

            <!-- Left -->
            <div class="header-left">
                <ul class="top-menu top-link-menu d-none d-md-block">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li>
                                <a href="tel:@lang('translation.webphone')">
                                    <i class="icon-phone"></i>
                                    Call: @lang('translation.webphone')
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Right -->
            <div class="header-right">

                <!-- Social Icons -->
                <div class="social-icons social-icons-color">
                    <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank">
                        <i class="icon-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank">
                        <i class="icon-twitter"></i>
                    </a>
                    <a href="#" class="social-icon social-pinterest" title="Instagram" target="_blank">
                        <i class="icon-pinterest-p"></i>
                    </a>
                    <a href="#" class="social-icon social-instagram" title="Pinterest" target="_blank">
                        <i class="icon-instagram"></i>
                    </a>
                </div>

                <!-- Login -->
                <ul class="top-menu top-link-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li>
																																	@auth
																																	{{-- <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-user"></i>@lang('translation.logoutlink')</a>
																																	<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form> --}}
																																	@else
																																	<a href="#signin-modal" data-toggle="modal" class="header-dropdown"><i class="icon-user"></i> @lang('translation.loginlink')</a>
																																	@endauth
                            </li>
                        </ul>
                    </li>
                </ul>
															@auth
																			<div class="header-dropdown dropdown-icon">
																						<a href="javascript:void(0);"> @lang('translation.myaccount')</a>
																						<div class="header-menu">
																							<ul>
																									   @if(\App\Helpers\Settings::route_exists('dashboard'))
																														<li><a href="{{ route('dashboard') }}">@lang('translation.dashboard')</a></li>
																											@endif
																											<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('translation.logoutlink')</a>
																											<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form></li>
																										</ul>
																						</div><!-- End .header-menu -->
																			</div>
																@endauth

																{{-- <div class="header-dropdown">
																<a href="javascript::void(0);">NGN</a>
																<div class="header-menu">
																<ul>
																<li><a href="#">Eur</a></li>
																<li><a href="#">Usd</a></li>
																</ul>
																</div><!-- End .header-menu -->
																</div><!-- End .header-dropdown --> --}}

																{{-- <div class="header-dropdown">
																<a href="#">Eng</a>
																<div class="header-menu">
																<ul>
																<li><a href="#">English</a></li>
																<li><a href="#">French</a></li>
																<li><a href="#">Spanish</a></li>
																</ul>
																</div><!-- End .header-menu -->
																</div><!-- End .header-dropdown --> --}}
                <!-- Currency -->                

                <!-- Language -->
                {{-- <div class="header-dropdown-" >
                    <a href="#">Eng</a>
                </div> --}}

            </div>
        </div>
    </div>

    <!-- ================= HEADER MIDDLE ================= -->
    <div class="header-middle">
        <div class="container">

            <!-- Search -->
            <div class="header-left">
                <div class="header-search header-search-extended d-none d-lg-block">
                    <a href="#" class="search-toggle">
                        <i class="icon-search"></i>
                    </a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">Search</label>
                            <button class="btn btn-primary" type="submit">
                                <i class="icon-search"></i>
                            </button>
                            <input
                                type="search"
                                class="form-control"
                                name="q"
                                id="q"
                                placeholder="Search product ..."
                                required
                            >
                        </div>
                    </form>
                </div>
            </div>

            <!-- Logo -->
            <div class="header-center">
                <a href="{{url('/')}}" class="logo">
                    <img
                        src="{{ asset('assets/img/brand/logo.png') }}"
                        alt="{{ config('app.name', '') }}"
                        width="82"
                        height="20"
                    >
                </a>
            </div>

            <!-- Wishlist + Cart -->
            <div class="header-right">

                <!-- Wishlist -->
                <a href="wishlist.html" class="wishlist-link">
                    <i class="icon-heart-o"></i>
                    <span class="wishlist-count">0</span>
                    <span class="wishlist-txt">My Wishlist</span>
                </a>

                <!-- Cart -->
                {{-- <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count">2</span>
                        <span class="cart-txt">$164.00</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">

                        <!-- Cart Products -->
                        <div class="dropdown-cart-products">

                            <!-- Product -->
                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="product.html">
                                            Beige knitted elastic runner shoes
                                        </a>
                                    </h4>
                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">1</span> × $84.00
                                    </span>
                                </div>

                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="{{ asset('assets/images/products/cart/product-1.jpg') }}" alt="product">
                                    </a>
                                </figure>

                                <a href="#" class="btn-remove">
                                    <i class="icon-close"></i>
                                </a>
                            </div>

                            <!-- Product -->
                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="product.html">
                                            Blue utility pinafore denim dress
                                        </a>
                                    </h4>
                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">1</span> × $76.00
                                    </span>
                                </div>

                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="{{ asset('assets/images/products/cart/product-2.jpg') }}" alt="product">
                                    </a>
                                </figure>

                                <a href="#" class="btn-remove">
                                    <i class="icon-close"></i>
                                </a>
                            </div>

                        </div>

                        <!-- Cart Total -->
                        <div class="dropdown-cart-total">
                            <span>Total</span>
                            <span class="cart-total-price">$160.00</span>
                        </div>

                        <!-- Cart Actions -->
                        <div class="dropdown-cart-action">
                            <a href="cart.html" class="btn btn-primary">View Cart</a>
                            <a href="checkout.html" class="btn btn-outline-primary-2">
                                <span>Checkout</span>
                                <i class="icon-long-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                </div> --}}

            </div>
        </div>
    </div>

    <!-- ================= HEADER BOTTOM ================= -->
    <div class="header-bottom sticky-header">
        <div class="container">

            <div class="header-left">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="active">
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a href="category.html">Shop</a>
                        </li>
                        <li>
                            <a href="product.html">Product</a>
                        </li>
                        <li>
                            <a href="blog.html">Blog</a>
                        </li>
                    </ul>
                </nav>

                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
            </div>

            <div class="header-right">
                <i class="la la-lightbulb-o"></i>
                <p>Clearance Up to 30% Off</p>
            </div>

        </div>
    </div>

</header>
