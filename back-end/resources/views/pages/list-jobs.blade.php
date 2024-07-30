@include('layouts/header')
<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1" style="margin: -25px">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>{{ $totalJobs }}+ Jobs Available</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

<!-- job_listing_area_start  -->
<div class="job_listing_area plus_padding">
    <div class="container">
        <div class="row">
            <div class="job_lists m-0">
                <div class="row">
                    @foreach ($jobs as $job)
                        <div class="col-lg-12 col-md-12">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="thumb">
                                        <img src="{{ $job->business->avatar }}" style="width: 100%" alt="">
                                    </div>
                                    <div class="jobs_conetent">
                                        <a href="{{ route('job.detail', $job->id) }}">
                                            <h4>{{ $job->position }}</h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p> <img src="images/maps-and-flags.png" alt="">
                                                    {{ $job->business->location }}
                                                </p>
                                            </div>
                                            <div class="type">
                                                <p style="margin-bottom: 0px"><img src="{{ asset('images/time.png') }}"
                                                        alt="">
                                                    {{ is_array($job->type) ? implode(', ', $job->type) : $job->type }}
                                                </p>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pagination_wrap">
                            <ul>
                                <li>
                                    @if ($jobs->onFirstPage())
                                        <span><img src="images/left-arrow.png" alt=""></span>
                                    @else
                                        <a href="{{ $jobs->previousPageUrl() }}"><img src="images/left-arrow.png"
                                                alt=""></a>
                                    @endif
                                </li>
                                @php
                                    $current = $jobs->currentPage();
                                    $last = $jobs->lastPage();
                                    $start = max(1, $current - 1);
                                    $end = min($last, $current + 1);
                                @endphp
                                @for ($i = $start; $i <= $end; $i++)
                                    <li>
                                        <a href="{{ $jobs->url($i) }}"
                                            class="{{ $jobs->currentPage() == $i ? 'active' : '' }}">
                                            <span>{{ $i < 10 ? '0' . $i : $i }}</span>
                                        </a>
                                    </li>
                                @endfor
                                <li>
                                    @if ($jobs->hasMorePages())
                                        <a href="{{ $jobs->nextPageUrl() }}"><img src="images/right-arrow.png"
                                                alt=""></a>
                                    @else
                                        <span><img src="images/right-arrow.png" alt=""></span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- job_listing_area_end  -->
@include('layouts/footer')
