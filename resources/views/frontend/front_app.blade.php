<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="academy, college, coursera, courses, education, elearning, kindergarten, lms, lynda, online course, online education, school, training, udemy, university">
<meta name="description" content="Patthokrom">
<meta name="CreativeLayers" content="ATFN">

<style>

	svg.w-5.h-5 {
		width: 20px !important;
	}
	
	svg {
		overflow: hidden;
		vertical-align: middle;
		width: 20px !important;
	}
	.flex.justify-between.flex-1.sm\:hidden {
    margin-bottom: 20px;
}
	
	</style>

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

	

    @yield('frontend-content')

	<!-- Testimonials -->
	
    {{-- @include('frontend.testimonial') --}}


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