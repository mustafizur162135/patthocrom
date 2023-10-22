	<!-- Our Newslatters -->
	{{-- <section id="our-newslatters" class="our-newslatters bgc-white">
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
	</section> --}}

	<!-- Our Footer -->
	<section class="footer_one home11 pb50">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-md-3 col-lg-4">
					<div class="footer_contact_widget home11">
						<h4>CONTACT</h4>
						@if ($setting)
							<p>{{ $setting->address ?? 'Dhaka' }}</p>
							<p>{{ $setting->contact_no ?? '123 456 7890' }}</p>
							<p>{{ $setting->mail ?? 'patthokrombd@gmail.com' }}</p>
						@else
							<p>Dhaka.</p>
							<p>123 456 7890</p>
							<p>patthokrombd@gmail.com</p>
						@endif

					</div>
					<div class="footer_social_widget home11 mt15 text-left">
						<ul>
							@if ($setting)
								<li class="list-inline-item"><a href="{{ $setting->fb_link ?? '#' }}"><i class="fa fa-facebook"></i></a></li>
								<li class="list-inline-item"><a href="{{ $setting->youtube_link ?? '#' }}"><i class="fa fa-youtube"></i></a></li>
							@else
								<li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="fa fa-youtube"></i></a></li>
							@endif

						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-md-3 col-lg-2">
					<div class="footer_company_widget home11 pl30">
						<h4>COMPANY</h4>
						<ul class="list-unstyled">
							<li><a href="#">About Us</a></li>
							<li><a href="#">Blog</a></li>
							<li><a href="page-contact.html">Contact</a></li>
							<li><a href="#">Become a Teacher</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-md-3 col-lg-3">
					<div class="footer_program_widget home11 pl60">
						<h4>PROGRAMS</h4>
						<ul class="list-unstyled">
							<li><a href="#">Nanodegree Plus</a></li>
							<li><a href="#">Veterans</a></li>
							<li><a href="#">Georgia</a></li>
							<li><a href="#">Self-Driving Car</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-md-3 col-lg-3">
					<div class="footer_support_widget home11 pl30">
						<h4>SUPPORT</h4>
						<ul class="list-unstyled">
							<li><a href="#">Documentation</a></li>
							<li><a href="#">Forums</a></li>
							<li><a href="#">Language Packs</a></li>
							<li><a href="#">Release Status</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Footer Bottom Area -->
	<section class="footer_bottom_area home11 pt25 pb25">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="copyright-widget text-center home11">
						<p>Copyright Patthokrom © 2023. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</div>
	</section>