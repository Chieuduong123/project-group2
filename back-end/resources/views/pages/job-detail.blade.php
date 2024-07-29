@include('layouts/header')
<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1" style="margin: -25px">
    <div class="container">
        <div class="row">
            @foreach ($jobs as $job)
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $job->position }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

<div class="job_details_area">
    <div class="container">
        <div class="row">
            @foreach ($jobs as $job)
                <div class="col-lg-8">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="{{ $job->business->avatar }}" style="width: 100%" alt="">
                                </div>
                                <div class="jobs_conetent">
                                    <a href="#">
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
                                                {{ is_array($job->type) ? implode(', ', $job->type) : $job->type }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a class="heart_mark" href="#"> <img src="images/love.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Job description</h4>
                            <p> {{ $job->content }} </p>

                        </div>
                        <div class="single_wrap">
                            <h4>Requirements</h4>
                            <p>{{ $job->requirement }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Quantity</h4>
                            <ul>
                                {{ $job->quantity }}
                            </ul>
                        </div>
                        <div class="single_wrap">
                            <h4>Benefits</h4>
                            <p> {{ $job->benefits }} </p>
                        </div>
                    </div>
                    <div class="apply_job_form white-bg">
                        <h4>Apply for the job</h4>
                        <form action="{{ route('job.apply', $job->id) }}" method="POST",
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input_field">
                                        <input type="text" name="name" placeholder="Your name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input_field">
                                        <input type="text" name="phone" placeholder="Phone number" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" id="inputGroupFileAddon03"><img
                                                    src="{{ asset('images/upload.png') }}" alt="">
                                            </button>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="resume_path"
                                                name="resume_path" aria-describedby="resume" required>
                                            <label class="custom-file-label" for="resume_path">Upload CV</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input_field">
                                        <textarea name="cover_letter" id="" cols="30" rows="10" placeholder="Coverletter"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit_btn">
                                        <button class="boxed-btn3 w-100" type="submit">Apply Now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="job_sumary">
                        <div class="summery_header">
                            <h3>Job Summary</h3>
                        </div>
                        <div class="job_content">
                            <ul>
                                <li>Published on: <span>{{ $job->created_at->format('d M, Y') }}</span></li>
                                <li>Salary: <span> {{ $job->salary }} </span></li>
                                <li>Location: <span> {{ $job->business->location }} </span></li>
                                <li>Job Nature: <span>
                                        {{ is_array($job->type) ? implode(', ', $job->type) : $job->type }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@include('layouts/footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById('resume_path');
        input.addEventListener('change', function() {
            var fileName = this.files[0].name;
            var label = this.nextElementSibling;
            label.innerHTML = fileName;
        });
    });
</script>
