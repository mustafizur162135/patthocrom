<!-- School Category Courses -->
<section id="our-top-courses" class="our-courses">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="main-title text-center">
                    <h3 class="mt0">Teacher Package</h3>
                </div>
            </div>
        </div>
         <div class="row">
            
            @if ($teacherpackages->isNotEmpty())
            @foreach ($teacherpackages as $teacherpackage)

            <a href="{{ route('package.show', ['id' => $teacherpackage->id]) }}">


                <div class="col-12 col-4">
                    <div class="top_courses">
                        <div class="thumb">  
                            <img class="img-whp" src="{{ asset('images/teacherpackages/' . $teacherpackage->teacherpackage_image) }}" alt="{{ $teacherpackage->teacherpackage_name }}">
                        </div>
                        <div class="details">
                            <div class="tc_content">
                                <h5>{{ $teacherpackage->teacherpackage_name }}</h5>
                                <!-- Add other teacherpackage details here -->
                            </div>
                            <div class="tc_footer">
                                <div class="tc_price float-right">৳{{ $teacherpackage->teacherpackage_price }}</div>
                                <div class="tc_price float-left">
                                   
                                    @if ($teacherUserData)

                                    <form method="post" action="{{ route('student.checkout') }}">
                                        @csrf <!-- Add a CSRF token for security -->
                                        <input type="text" name="studentPackage_id" value="{{ $teacherpackage->id }}">
                                        <input type="text" name="studentpackage_price" value="{{ $teacherpackage->teacherpackage_price }}">
                                        <input type="text" name="studentpackage_name" value="{{ $teacherpackage->teacherpackage_name }}">
                                        <button type="submit" class="btn btn-success btn-sm">Buy Now</button>
                                        
                                    </form>

                                       {{-- <a href="{{ route('student.checkout') }}" class="btn btn-success btn-sm">Buy Now</a> --}}
                        
                                    @else
                                       <a href="{{ route('teacher.login.form') }}" class="btn btn-success btn-sm">Buy Now</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </a>
            @endforeach

           
        @else
            <div class="col-lg-12">
                <p>No data available.</p>
            </div>
        @endif

            {{-- <div class="col-lg-6 offset-lg-3">
                <div class="courses_all_btn text-center">
                    <a class="btn btn-transparent" href="#">View All Courses</a>
                </div>
            </div> --}}
         </div>
    </div>
</section>