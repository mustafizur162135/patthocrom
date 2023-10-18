<div class="header_top home4 style2">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-xl-5">
                <ul class="home4_header_top_contact style2">
                    <li class="list-inline-item"><a href="#">(56) 123 456 789</a></li>
                    <li class="list-inline-item"><a href="#">patthokrombd@gmail.com</a></li>
                </ul>
            </div>
            <div class="col-lg-7 col-xl-7">
                <ul class="sign_up_btn home4 style2 dn-smd text-right">
                    <li class="list-inline-item"><a href="#" class="btn btn-md"><i class="flaticon-megaphone"></i><span class="dn-md">Become an Instructor</span></a></li>
                    <li class="list-inline-item"><a href="{{ route('admin.login.form') }}" class="btn btn-md" ><i class="flaticon-user"></i> <span class="dn-md">Login</span></a></li>
                    
                </ul><!-- Button trigger modal -->
            </div>
        </div>
    </div>
</div>

<!-- Main Header Nav -->
<header class="header-nav menu_style_home_six style2 navbar-scrolltofixed main-menu">
    <div class="container">
        <!-- Ace Responsive Menu -->
        <nav>
            <!-- Menu Toggle btn-->
            <div class="menu-toggle">
                <img class="nav_logo_img img-fluid" src="{{ asset('frontend/images/header-logo2.png') }}" alt="header-logo2.png">
                <button type="button" id="menu-btn">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <a href="#" class="navbar_brand float-left dn-smd">
                <img class="logo1 img-fluid" src="{{ asset('frontend/images/header-logo5.png') }}" alt="header-logo5.png">
                <img class="logo2 img-fluid" src="{{ asset('frontend/images/header-logo5.png') }}" alt="header-logo5.png">
                <span>Patthokrom</span>
            </a>

            {{-- <div class="home5_shop_reg_widget float-right">
                <div class="cart_btn home5 mt20">
                    <ul class="cart">
                        <li>
                            <a href="#" class="btn cart_btn flaticon-shopping-bag"><span><sup>5</sup></span></a>
                            <ul class="dropdown_content">
                                <li class="list_content">
                                    <a href="#">
                                        <img class="float-left" src="http://via.placeholder.com/50x50" alt="50x50">
                                        <p>Dolar Sit Amet</p>
                                        <small>1 × $7.90</small>
                                        <span class="close_icon float-right"><i class="fa fa-plus"></i></span>
                                    </a>
                                </li>
                                <li class="list_content">
                                    <a href="#">
                                        <img class="float-left" src="http://via.placeholder.com/50x50" alt="50x50">
                                        <p>Lorem Ipsum</p>
                                        <small>1 × $7.90</small>
                                        <span class="close_icon float-right"><i class="fa fa-plus"></i></span>
                                    </a>
                                </li>
                                <li class="list_content">
                                    <a href="#">
                                        <img class="float-left" src="http://via.placeholder.com/50x50" alt="50x50">
                                        <p>Is simply</p>
                                        <small>1 × $7.90</small>
                                        <span class="close_icon float-right"><i class="fa fa-plus"></i></span>
                                    </a>
                                </li>
                                <li class="list_content">
                                    <h5>Subtotal: $57.70</h5>
                                    <a href="#" class="btn btn-thm cart_btns">View cart</a>
                                    <a href="#" class="btn btn-thm3 checkout_btns">Checkout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div> --}}

            <!-- Responsive Menu Structure-->
            <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
            <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
                <li class="last">
                    <a href="#"><span class="title">Contact</span></a>
                </li>
               
              
                <li class="list_three">
                    <a href="#"><span class="title">Teacher</span></a>
                    <ul>
                        <li><a href="#">Teacher List</a></li>
                    </ul>
                </li>

                <li class="list_two">
                    <a href="#"><span class="title">Courses</span></a>
                    <!-- Level Two-->
                    <ul>
                        <li>
                            <a href="#">Courses List</a>
                            <!-- Level Three-->
                            <ul>
                                <li><a href="#">Courses v1</a></li>
                                <li><a href="#">Courses v2</a></li>
                                <li><a href="#">Courses v3</a></li>
                            </ul>
                        </li>
                       
                    </ul>
                </li>
                <li class="list_one">
                    <a href="{{ route('home') }}"><span class="title">Home</span></a>
                </li>
            </ul>
        </nav>
        <!-- End of Responsive Menu -->
    </div>
</header>

<!-- Main Header Nav For Mobile -->
<div id="page" class="stylehome1 h0">
    <div class="mobile-menu">
        <div class="header stylehome1 home6">
            <div class="main_logo_home2">
                <img class="nav_logo_img img-fluid float-left mt20" src="{{ asset('frontend/images/header-logo.png') }}" alt="header-logo.png">
                <span>Patthokrom</span>
            </div>
            <ul class="menu_bar_home2">
                <li class="list-inline-item">
                    <div class="search_overlay">
                      <a id="search-button-listener2" class="mk-search-trigger mk-fullscreen-trigger" href="#">
                        <div id="search-button2"><i class="flaticon-magnifying-glass"></i></div>
                      </a>
                        <div class="mk-fullscreen-search-overlay" id="mk-search-overlay2">
                            <a href="#" class="mk-fullscreen-close" id="mk-fullscreen-close-button2"><i class="fa fa-times"></i></a>
                            <div id="mk-fullscreen-search-wrapper2">
                              <form method="get" id="mk-fullscreen-searchform2">
                                <input type="text" value="" placeholder="Search courses..." id="mk-fullscreen-search-input2">
                                <i class="flaticon-magnifying-glass fullscreen-search-icon"><input value="" type="submit"></i>
                              </form>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-inline-item"><a href="#menu"><span></span></a></li>
            </ul>
        </div>
    </div><!-- /.mobile-menu -->
    <nav id="menu" class="stylehome1">
        <ul>
            <li><span><a href="{{ route('home') }}">Home</a></span>
              
            </li>
            <li><span>Courses</span>
                <ul>
                    <li><span>Courses List</span>
                        <ul>
                            <li><a href="#">Courses v1</a></li>
                            <li><a href="#">Courses v2</a></li>
                            <li><a href="#">Courses v3</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </li>
            <li><span>Teacher</span>
                <ul>
                    <li><a href="#">Teacher List</a></li>
                </ul>
            </li>
            
            <li><a href="#">Contact</a></li>
            <li><a href="{{ route('admin.login.form') }}"><span class="flaticon-user"></span> Login</a></li>
            <li><a href="#"><span class="flaticon-edit"></span> Register</a></li>
        </ul>
    </nav>
</div>