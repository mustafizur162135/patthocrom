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


                        <div class="col-12 col-4">
                            <div class="top_courses">
                                <div class="thumb">
                                    <div class="thumb">
                                        <img class="img-whp"
                                            src="{{ asset('storage/images/studentpackages/' . $studentpackage->studentpackage_image) }}"
                                            alt="{{ $studentpackage->studentpackage_name }}">
                                    </div>

                                </div>

                                <div class="details">
                                    <div class="tc_content">
                                        <h5>{{ $studentpackage->studentpackage_name }}</h5>
                                        <!-- Add other studentpackage details here -->
                                    </div>
                                    <div class="tc_footer">
                                        <div class="tc_price float-right">৳{{ $studentpackage->studentpackage_price }}
                                        </div>
                                        <div class="tc_price float-left">

                                            @if ($studentUserData)
                                                <form method="post" action="{{ route('student.checkout') }}">
                                                    @csrf <!-- Add a CSRF token for security -->
                                                    <input type="hidden" name="studentPackage_id"
                                                        value="{{ $studentpackage->id }}">
                                                    <input type="hidden" name="studentpackage_price"
                                                        value="{{ $studentpackage->studentpackage_price }}">
                                                    <input type="hidden" name="studentpackage_name"
                                                        value="{{ $studentpackage->studentpackage_name }}">
                                                    <button type="submit" class="btn btn-success btn-sm">Buy
                                                        Now</button>

                                                </form>

                                                {{-- <a href="{{ route('student.checkout') }}" class="btn btn-success btn-sm">Buy Now</a> --}}
                                            @else
                                                <a href="{{ route('student.login.form') }}"
                                                    class="btn btn-success btn-sm">Buy Now</a>
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
