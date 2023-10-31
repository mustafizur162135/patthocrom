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
@if ($setting && $setting->logo)
    <link href="{{ asset('images/setting/' . $setting->logo) }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
@else
    <link href="{{ asset('frontend/images/favicon.ico') }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
@endif


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
	{{-- <div class="preloader"></div> --}}

    @include('layouts.frontend.partials.header')

	<!-- 6th Home Slider -->
	<div class="home11-slider">
		<div class="container maxw1500">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-banner-wrapper">
					    <div class="banner-style-one owl-theme owl-carousel home11">
					       
					        
							
								@if ($sliders->isEmpty())
									<p>No sliders available</p>
								@else
									@foreach ($sliders as $slider)
										<div class="slide slide-one home11" style="background-image: url({{ asset('images/sliders/' . $slider->slider_image) }});">
											<div class="row">
												<div class="col-lg-8 offset-lg-2 text-center">
													<div class="banner-sub-title text-capitalize fw400">{{ $slider->slider_name }}</div>
													<div class="banner-title text-capitalize fwb mb25">{{ $slider->slider_des }}</div>
													<div class="btn-block">
														<a href="{{ route('allcourse') }}" class="banner-btn bdrs3">FIND COURSES</a>
													</div>
												</div>
											</div>
										</div>
									@endforeach
								@endif
							
							
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

	@include('frontend.studentpackage')
	
    @include('frontend.teacher')

   

  


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