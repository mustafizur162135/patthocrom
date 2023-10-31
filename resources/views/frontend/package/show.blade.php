@extends('frontend.front_app')

@section('title', 'Single Student Package')

@section('css')

    
@endsection

@section('frontend-content')


    <!-- Inner Page Breadcrumb -->
	<section class="inner_page_breadcrumb style2 pb20">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="courses_single_container mt50">
						<div class="cs_row_one">
							<div class="cs_ins_container">
								<h1 class="cs_title style2">{{ $studentPackage->studentpackage_name }}</h1>
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Top Courses -->
	<section id="top-courses" class="blog-post pt0">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-xl-9">
					<div class="blog_post_home6 style2 video">
						<div class="bg_img_video_widget h500 thumb">
							
							<div class="video-container">
								<img class="img-whp" src="{{ asset('images/studentpackages/' . $studentPackage->studentpackage_image) }}" alt="{{ $studentPackage->studentpackage_name }}">
							</div>
						</div>
					</div>
					<div class="courses_single_container">
                        <div class="about_box_home6">
                            <div class="details">
                              
                                <p>{{ $studentPackage->studentpackage_des }}</p>
                             
                            </div>
                        </div>
						
					</div>
				</div>
				<div class="col-lg-4 col-xl-3 pl-lg-0 pr-lg-0">
					<div class="sidebar_course_widget style2">
						<div class="course_list_details">
							<div class="price_title df">৳ <span class="custome_price pr10 pl10 vas">{{ $studentPackage->studentpackage_price }}</span></div>

                            @if ($studentUserData)

                            <a class="btn btn-block buy_now_btn dbxshad btn-lg btn-thm3 mt20" href="#">Buy Now</a>
                        
                            <!-- Add more user information as needed -->
                        @else
                        <a class="btn btn-block buy_now_btn dbxshad btn-lg btn-thm3 mt20" href="###">Buy Now</a>
                        @endif

							
							{{-- <ul class="icon-box-list mt20 mb0">
								<li><span class="fwb fz15 icon flaticon-clock"></span> <span class="fwb fz15 pl10 title">Duration</span> <span class="para"> 15 weeks</span></li>
								<li><span class="fwb fz15 icon flaticon-creative-idea"></span> <span class="fwb fz15 pl10 title">SKILL LEVEL</span> <span class="para"> Professional</span></li>
								<li><span class="fwb fz15 icon flaticon-ebook"></span> <span class="fwb fz15 pl10 title">LECTURES</span> <span class="para"> 24 lessons</span></li>
								<li><span class="fwb fz15 icon flaticon-account"></span> <span class="fwb fz15 pl10 title">ENROLLED</span> <span class="para"> 34 students</span></li>
								<li><span class="fwb fz15 icon flaticon-resume"></span> <span class="fwb fz15 pl10 title">LANGUAGE</span> <span class="para"> English</span></li>
							</ul> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


</section>

@endsection
