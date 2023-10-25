<!-- about Us home6 -->
<section class="home6_about pt35 bgc-f9">
    <div class="container">
       
        <div class="row mt60">
            <div class="col-lg-6">
                <div class="about_box_home6">
                    <div class="details">
                      
                        <p>{{ $setting->about_us ?? 'Demo Content' }}</p>
                        
                        {{-- <a class="btn dbxshad btn-lg btn-thm2 rounded" href="#">Read More</a>							 --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about_box_home6">
                    <div class="thumb">
                        @if ($setting && $setting->about_us_image)
                    <img class="logo1 img-fluid" src="{{ asset('images/setting/' . $setting->about_us_image) }}" alt="{{ $setting->about_us_image }}">
                    {{-- <span>{{ $setting->about_us ?? 'Patthokrom' }}</span> --}}
                @else
                <img class="img-fluid img-rounded" src="{{ asset('frontend/images/images/about/1.jpg') }}" alt="1.jpg">
                {{-- <span>Patthokrom</span> --}}
                @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>