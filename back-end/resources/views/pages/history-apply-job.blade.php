@include('layouts/header')
<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1" style="margin: -25px">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Apply History</h3>
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
                    @foreach ($applications as $application)
                        <div class="col-lg-12 col-md-12">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="thumb">
                                        <img src="{{ $application->job->business->avatar }}" style="width: 100%"
                                            alt="">
                                    </div>
                                    <div class="jobs_conetent">
                                        <a href="{{ route('job.detail', $application->job->id) }}">
                                            <h4>{{ $application->job->position }}</h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p> <img src="{{ asset('images/maps-and-flags.png') }}" alt="">
                                                    {{ $application->job->business->location }}
                                                </p>
                                            </div>
                                            <div class="location">
                                                <p> <img src="{{ asset('images/time.png') }}" alt="">
                                                    {{ is_array($application->job->type) ? implode(', ', $application->job->type) : $applocation->type }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        <a class="heart_mark" href="#"> <img src="{{ asset('images/love.png') }}"
                                                alt="">
                                        </a>
                                        <a href="{{ route('job.detail', $application->job->id) }}" class="boxed-btn3">Apply Now</a>
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
                                    @if ($applications->onFirstPage())
                                        <span><img src="images/left-arrow.png" alt=""></span>
                                    @else
                                        <a href="{{ $applications->previousPageUrl() }}"><img
                                                src="{{ asset('images/left-arrow.png') }}" alt=""></a>
                                    @endif
                                </li>
                                @php
                                    $current = $applications->currentPage();
                                    $last = $applications->lastPage();
                                    $start = max(1, $current - 1);
                                    $end = min($last, $current + 1);
                                @endphp
                                @for ($i = $start; $i <= $end; $i++)
                                    <li>
                                        <a href="{{ $applications->url($i) }}"
                                            class="{{ $applications->currentPage() == $i ? 'active' : '' }}">
                                            <span>{{ $i < 10 ? '0' . $i : $i }}</span>
                                        </a>
                                    </li>
                                @endfor
                                <li>
                                    @if ($applications->hasMorePages())
                                        <a href="{{ $applications->nextPageUrl() }}"><img
                                                src="{{ asset('images/right-arrow.png') }}" alt=""></a>
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
