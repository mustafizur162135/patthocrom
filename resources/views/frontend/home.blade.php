<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="academy, college, coursera, courses, education, elearning, kindergarten, lms, lynda, online course, online education, school, training, udemy, university">
<meta name="description" content="Patthokrom">
<meta name="CreativeLayers" content="ATFN">
<!-- css file -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
<!-- Title -->
<title>@yield('title') | {{ 'Patthokrom' }}</title>
<!-- Favicon -->
<link href="{{ asset('frontend/images/favicon.ico') }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="{{ asset('frontend/images/favicon.ico') }}" sizes="128x128" rel="shortcut icon" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @stack('css')

</head>
<body>
<div class="wrapper">
	<div class="preloader"></div>

    @include('layouts.frontend.partials.header')

	<!-- 6th Home Slider -->
	<div class="home11-slider">
		<div class="container maxw1500">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-banner-wrapper">
					    <div class="banner-style-one owl-theme owl-carousel home11">
					        <div class="slide slide-one home11" style="background-image: url({{ asset('frontend/images/home/1.jpg') }});">
					            <div class="container">
					                <div class="row">
					                    <div class="col-lg-8 offset-lg-2 text-center">
					                        <div class="banner-sub-title text-capitalize fw400">We Take Learning to</div>
					                        <div class="banner-title text-capitalize fwb mb25">New Heights</div>
					                        <div class="btn-block">
					                            <a href="#" class="banner-btn bdrs3">FIND COURSES</a>
					                        </div>
					                    </div>
					                </div>
					            </div>
					        </div>
					        <div class="slide slide-one home11" style="background-image: url({{ asset('frontend/images/home/h2.jpg') }});">
					            <div class="container">
					                <div class="row">
					                    <div class="col-lg-8 offset-lg-2 text-center">
					                        <div class="banner-sub-title text-capitalize fw400">We Take Learning to</div>
					                        <div class="banner-title text-capitalize fwb mb25">New Heights</div>
					                        <div class="btn-block">
					                            <a href="#" class="banner-btn bdrs3">FIND COURSES</a>
					                        </div>
					                    </div>
					                </div>
					            </div>
					        </div>
					        <div class="slide slide-one home11" style="background-image: url({{ asset('frontend/images/home/h3.jpg') }});">
					            <div class="container">
					                <div class="row">
					                    <div class="col-lg-8 offset-lg-2 text-center">
					                        <div class="banner-sub-title text-capitalize fw400">We Take Learning to</div>
					                        <div class="banner-title text-capitalize fwb mb25">New Heights</div>
					                        <div class="btn-block">
					                            <a href="#" class="banner-btn bdrs3">FIND COURSES</a>
					                        </div>
					                    </div>
					                </div>
					            </div>
					        </div>
					    </div>
					    <div class="carousel-btn-block banner-carousel-btn">
					        <span class="carousel-btn left-btn"><i class="flaticon-back left"></i></span>
					        <span class="carousel-btn right-btn"><i class="flaticon-right-arrow right"></i></span>
					    </div><!-- /.carousel-btn-block banner-carousel-btn -->
					</div><!-- /.main-banner-wrapper -->
				</div>
			</div>
		</div>
	</div>

    @include('frontend.category_courses')

    @include('frontend.about')

    @include('frontend.popular_course')

    @yield('frontend-content')

	<!-- Testimonials -->
	
    @include('frontend.teacher')

    @include('frontend.testimonial')

    <!-- Our Newslatters -->
	<section id="our-newslatters" class="our-newslatters bgc-white">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="newslatter_title text-center">
						<h3 class="mt0">Subscribe our newsletter</h3>
						<p class="fz16">Your download should start automatically, if not Click here. Should I give up, huh?.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="footer_apps_widget_home1 home11">
						<form class="form-inline mailchimp_form">
							<input type="email" class="form-control" placeholder="Email address">
							<button type="submit" class="btn btn-lg btn-thm4">Subscribe <span class="flaticon-right-arrow-1"></span></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>


    @include('layouts.frontend.partials.footer')

<a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
</div>
<!-- Wrapper End -->
<script type="text/javascript" src="{{ asset('frontend/js/jquery-3.3.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery-migrate-3.0.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.mmenu.all.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/ace-responsive-menu.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/isotop.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/snackbar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/simplebar.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/parallax.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/scrollto.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery-scrolltofixed-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.counterup.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/progressbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/timepicker.js') }}"></script>
<!-- Custom script for all pages --> 
<script type="text/javascript" src="{{ asset('frontend/js/script.js') }}"></script>

@stack('js')

</body>
</html>