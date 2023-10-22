<!-- School Category Courses -->
<section id="our-courses" class="our-courses pb80 pt90">
    <div class="container">
        <div class="main-title mb30">
            <div class="row">
                <div class="col-lg-6 text-md-center text-lg-left">
                    <h3 class="mt0">Via School Categories Courses</h3>
                </div>
                <div class="col-lg-6 text-md-center text-lg-right">
                    <a class="text-thm6" href="#">View All Course</a>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($courses->isEmpty())
            <p>No courses available</p>
        @else
        @foreach ($courses as $course)
        <div class="col-sm-6 col-lg-3"> <!-- Adjust the class to col-lg-4 to make it larger -->
            <div class="img_hvr_box home12" style="background-image: url({{ asset('images/courses/' . $course->image) }});">
                <div class="overlay">
                    <div class="details">
                        <div class="icon text-white fz50 mb25"><span class="flaticon-online-learning"></span></div>
                        <h5>{{ $course->class_name }}</h5>
                        <p>{{ $course->class_note }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
        @endif
            
        </div>
    </div>
</section>