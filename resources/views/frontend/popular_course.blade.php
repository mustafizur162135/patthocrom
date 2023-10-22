<!-- Our Popular Courses -->
<section class="popular-courses bgc-thm2">
    <div class="container-fluid style2">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="main-title text-center">
                    <h3 class="mt0 color-white">Courses</h3>
                   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="popular_course_slider">

                    @if ($courses->isEmpty())
                            <p>No courses available</p>
                        @else
                            @foreach ($courses as $course)

                    <div class="item">
                        
                            <div class="top_courses home2 mb0">
                                <div class="thumb">
                                    {{-- <img class="img-whp" src="{{ asset('frontend/images/courses/' . $course->image) }}" alt="demo_image.jpg"> --}}
                                    <img class="img-whp" src="{{ asset('frontend/images/courses/t1.jpg') }}" alt="t1.jpg">
                                </div>
                                <div class="details">
                                    <div class="tc_content">
                                        <p>{{ $course->class_name }}</p>
                                        <h5>{{ $course->class_note }}</h5>
                                    </div>
                                    <div class="tc_footer">
                                        <div class="tc_price float-right">${{ $course->class_name }}</div>
                                    </div>
                                </div>
                            </div>
                           
                    </div>
                    @endforeach
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</section>