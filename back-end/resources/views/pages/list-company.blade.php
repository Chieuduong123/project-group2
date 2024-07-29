@include('layouts/header')

<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1" style="margin: -25px">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Company</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

<!-- featured_candidates_area_start  -->
<div class="featured_candidates_area candidate_page_padding">
    <div class="container">
        <div class="row">
            @foreach ($businesses as $business)
                <div class="col-md-6 col-lg-3">
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img src="{{ $business->avatar }}" alt="">
                        </div>
                        <a href="#">
                            <h4>{{ $business->name }}</h4>
                        </a>
                        <p>{{ $business->location }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="pagination_wrap">
                    <ul>
                        <li>
                            @if ($businesses->onFirstPage())
                                <span><img src="images/left-arrow.png" alt=""></span>
                            @else
                                <a href="{{ $businesses->previousPageUrl() }}"><img src="images/left-arrow.png"
                                        alt=""></a>
                            @endif
                        </li>
                        @php
                            $current = $businesses->currentPage();
                            $last = $businesses->lastPage();
                            $start = max(1, $current - 1);
                            $end = min($last, $current + 1);
                        @endphp
                        @for ($i = $start; $i <= $end; $i++)
                            <li>
                                <a href="{{ $businesses->url($i) }}"
                                    class="{{ $businesses->currentPage() == $i ? 'active' : '' }}">
                                    <span>{{ $i < 10 ? '0' . $i : $i }}</span>
                                </a>
                            </li>
                        @endfor
                        <li>
                            @if ($businesses->hasMorePages())
                                <a href="{{ $businesses->nextPageUrl() }}"><img src="images/right-arrow.png"
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
<!-- featured_candidates_area_end  -->
@include('layouts/footer')
