@extends('frontend.front_app')

@section('title', 'Course')

@section('css')

<style>

svg.w-5.h-5 {
    width: 20px !important;
}

svg {
    overflow: hidden;
    vertical-align: middle;
    width: 20px !important;
}

</style>
    
@endsection

@section('frontend-content')

<!-- Inner Page Breadcrumb -->
<section class="inner_page_breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 text-center">
                <div class="breadcrumb_content">
                    <h4 class="breadcrumb_title">Courses</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Courses</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Team Members -->
<section class="our-team pb40">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="row">
                    @if ($courses->isNotEmpty())
                        @foreach ($courses as $course)
                            <div class="col-lg-6 col-xl-4">
                                <div class="top_courses">
                                    <div class="thumb">
                                        <img class="img-whp" src="{{ ($course->class_image) }}" alt="{{ $course->class_name }}">
                                    </div>
                                    <div class="details">
                                        <div class="tc_content">
                                            <p>{{ $course->class_name }}</p>
                                            <h5>{{ $course->class_code }}</h5>
                                            <!-- Add other course details here -->
                                        </div>
                                        <div class="tc_footer">
                                            <div class="tc_price float-right">৳{{ $course->class_price }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Pagination links -->
                        <div class="col-lg-12 page_navigation">
                            {{ $courses->links() }}
                        </div>
                    @else
                        <div class="col-lg-12">
                            <p>No data available.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
