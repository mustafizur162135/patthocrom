<!-- School Category Courses -->
<section id="our-top-courses" class="our-courses">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="main-title text-center">
                    <h3 class="mt0">Student Package</h3>
                </div>
            </div>
        </div>
         <div class="row">
            
            @if ($studentpackages->isNotEmpty())
            @foreach ($studentpackages as $studentpackage)

            <a href="{{ route('package.show', ['id' => $studentpackage->id]) }}">


                <div class="col-lg-6 col-xl-4">
                    <div class="top_courses">
                        <div class="thumb">  
                            <img class="img-whp" src="{{ asset('images/studentpackages/' . $studentpackage->studentpackage_image) }}" alt="{{ $studentpackage->studentpackage_name }}">
                        </div>
                        <div class="details">
                            <div class="tc_content">
                                <h5>{{ $studentpackage->studentpackage_name }}</h5>
                                <!-- Add other studentpackage details here -->
                            </div>
                            <div class="tc_footer">
                                <div class="tc_price float-right">৳{{ $studentpackage->studentpackage_price }}</div>
                                <div class="tc_price float-left">
                                    <a href="#" class="btn btn-success btn-sm">Buy Now</a>
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