@include('layouts/header')
<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider  d-flex align-items-center slider_bg_1" style="margin: -25px">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="slider_text">
                        <h5 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">4536+ Jobs listed
                        </h5>
                        <h3 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">Find your Dream Job
                        </h3>
                        <p class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".4s">We provide online
                            instant cash loans with quick approval that suit your term length</p>
                        <div class="sldier_btn wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s">
                            <a href="#" class="boxed-btn3">Upload your Resume</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ilstration_img wow fadeInRight d-none d-lg-block text-right" data-wow-duration="1s"
        data-wow-delay=".2s">
        <img src="{{ asset('images/illustration.png') }}" alt="">
    </div>
</div>
<!-- slider_area_end -->
<!-- catagory_area -->
<div class="catagory_area">
    <div class="container">
        <div class="row cat_search">
            <div class="col-lg-3 col-md-4">
                <div class="single_input">
                    <input type="text" placeholder="Search keyword">
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="single_input">
                    <select class="wide">
                        <option data-display="Location">Location</option>
                        <option value="1">Dhaka</option>
                        <option value="2">Rangpur</option>
                        <option value="4">Sylet</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="single_input">
                    <select class="">
                        <option data-display="Category">Category</option>
                        <option value="1">Category 1</option>
                        <option value="2">Category 2</option>
                        <option value="4">Category 3</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="job_btn">
                    <a href="#" class="boxed-btn3">Find Job</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="popular_search d-flex align-items-center">
                    <span>Popular Search:</span>
                    <ul>
                        <li><a href="#">Design & Creative</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Administration</a></li>
                        <li><a href="#">Teaching & Education</a></li>
                        <li><a href="#">Engineering</a></li>
                        <li><a href="#">Software & Web</a></li>
                        <li><a href="#">Telemarketing</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ catagory_area -->

<!-- popular_catagory_area_start  -->
<div class="popular_catagory_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_title mb-40">
                    <h3>Popolar Categories</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_catagory">
                    <a href="jobs.html">
                        <h4>Design & Creative</h4>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_catagory">
                    <a href="jobs.html">
                        <h4>Marketing</h4>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_catagory">
                    <a href="jobs.html">
                        <h4>Telemarketing</h4>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_catagory">
                    <a href="jobs.html">
                        <h4>Software & Web</h4>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_catagory">
                    <a href="jobs.html">
                        <h4>Administration</h4>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_catagory">
                    <a href="jobs.html">
                        <h4>Teaching & Education</h4>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_catagory">
                    <a href="jobs.html">
                        <h4>Engineering</h4>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_catagory">
                    <a href="jobs.html">
                        <h4>Garments / Textile</h4>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- popular_catagory_area_end  -->

<!-- job_listing_area_start  -->
<div class="job_listing_area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section_title">
                    <h3>Job Listing</h3>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="brouse_job text-right">
                    <a href="{{ route('jobs') }}" class="boxed-btn4">Browse More Job</a>
                </div>
            </div>
        </div>
        <div class="job_lists">
            <div class="row">
                @foreach ($jobs as $job)
                    <div class="col-lg-12 col-md-12">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="{{ $job->business->avatar }}" style="width: 100%; height: 100%;"
                                        alt="">
                                </div>
                                <div class="jobs_conetent">
                                    <a href="{{ route('job.detail', $job->id) }}">
                                        <h4>{{ $job->position }}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <img src="{{ asset('images/maps-and-flags.png') }}" alt="">
                                                {{ $job->business->location }}
                                            </p>
                                        </div>
                                        <div class="type">
                                            <p style="margin-bottom: 0px"><img src="{{ asset('images/time.png') }}"
                                                    alt="">
                                                {{ is_array($job->type) ? implode(', ', $job->type) : $job->type }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a class="heart_mark" href="#"> <img src="images/love.png" alt="">
                                    </a>
                                    <a href="{{ route('job.detail', $job->id) }}" class="boxed-btn3">Apply Now</a>
                                </div>
                                <div class="date">
                                    <p>Date line: 31 Jan 2020</p>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- job_listing_area_end  -->

<!-- featured_candidates_area_start  -->
<div class="featured_candidates_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_title text-center mb-40">
                    <h3>Featured Candidates</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="candidate_active owl-carousel">
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/1.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/2.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/3.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/4.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/5.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/6.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/7.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/8.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/9.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/9.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/10.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/3.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="img/candiateds/4.png" alt="">
                        </div>
                        <a href="#">
                            <h4>Markary Jondon</h4>
                        </a>
                        <p>Software Engineer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- featured_candidates_area_end  -->

<div class="top_companies_area">
    <div class="container">
        <div class="row align-items-center mb-40">
            <div class="col-lg-6 col-md-6">
                <div class="section_title">
                    <h3>Top Companies</h3>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="brouse_job text-right">
                    <a href="jobs.html" class="boxed-btn4">Browse More Job</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_company">
                    <div class="thumb">
                        <img src="img/svg_icon/5.svg" alt="">
                    </div>
                    <a href="jobs.html">
                        <h3>Snack Studio</h3>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_company">
                    <div class="thumb">
                        <img src="img/svg_icon/4.svg" alt="">
                    </div>
                    <a href="jobs.html">
                        <h3>Snack Studio</h3>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_company">
                    <div class="thumb">
                        <img src="img/svg_icon/3.svg" alt="">
                    </div>
                    <a href="jobs.html">
                        <h3>Snack Studio</h3>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_company">
                    <div class="thumb">
                        <img src="img/svg_icon/1.svg" alt="">
                    </div>
                    <a href="jobs.html">
                        <h3>Snack Studio</h3>
                    </a>
                    <p> <span>50</span> Available position</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- job_searcing_wrap  -->
<div class="job_searcing_wrap overlay">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1 col-md-6">
                <div class="searching_text">
                    <h3>Looking for a Job?</h3>
                    <p>We provide online instant cash loans with quick approval </p>
                    <a href="#" class="boxed-btn3">Browse Job</a>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 col-md-6">
                <div class="searching_text">
                    <h3>Looking for a Expert?</h3>
                    <p>We provide online instant cash loans with quick approval </p>
                    <a href="#" class="boxed-btn3">Post a Job</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- job_searcing_wrap end  -->
@include('layouts/footer')
