<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job Board</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">F
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1" style="margin: -25px">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>Register</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

<!-- Start Align Area -->
<div class="whole-wrap">
    <div class="container box_1170">
        <div class="section-top-border">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mt-10">
                            <input type="text" name="name" placeholder="Name" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Name'" required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="email" placeholder="Email" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Email'" required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="phone" placeholder="Phone number"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone number'" required
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="password" name="password" placeholder="Password"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required
                                class="single-input">
                        </div>

                        <div class="mt-10">
                            <button class="boxed-btn3 w-20" type="submit">Register</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Align Area -->

@include('layouts/footer')
