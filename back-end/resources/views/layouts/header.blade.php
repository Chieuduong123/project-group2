<!doctype html>
<html class="no-js" lang="zxx">

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

<body>

    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('images/logo.png') }}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('home') }}">home</a></li>
                                            <li><a href="{{ route('jobs') }}">Browse Job</a></li>
                                            <li><a href="#">pages <img src="images/down-arrow.png"
                                                        alt=""></i></a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('job.history') }}">History Apply Job </a>
                                                    </li>
                                                    <li><a href="{{ route('business') }}">List Company</a></li>
                                                    <li><a href="job_details.html">job details </a></li>
                                                    <li><a href="elements.html">elements</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">blog <img src="images/down-arrow.png"
                                                        alt=""></i></a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">blog</a></li>
                                                    <li><a href="single-blog.html">single-blog</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    <div class="phone_num d-none d-xl-block">
                                        @if (auth()->guard('web-seeker')->check())
                                            <span style="color: white;">|&emsp;<a
                                                    href="">{{ auth()->guard('web-seeker')->user()->name }}</a>&emsp;|&emsp;</span>
                                            <a href="{{ route('logout') }}">Logout</a>
                                        @else
                                            <a href="{{ route('login') }}">Login</a>
                                        @endif
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <a class="boxed-btn3" href="#">Post a Job</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->




    <script src="{{ 'js/modernizr-3.5.0.min.js' }}"></script>
    <script src="{{ 'js/jquery-1.12.4.min.js' }}"></script>
    <script src="{{ 'js/popper.min.js' }}"></script>
    <script src="{{ 'js/bootstrap.min.js' }}"></script>
    <script src="{{ 'js/owl.carousel.min.js' }}"></script>
    <script src="{{ 'js/isotope.pkgd.min.js' }}"></script>
    <script src="{{ 'js/ajax-form.js' }}"></script>
    <script src="{{ 'js/waypoints.min.js' }}"></script>
    <script src="{{ 'js/jquery.counterup.min.js' }}"></script>
    <script src="{{ 'js/imagesloaded.pkgd.min.js' }}"></script>
    <script src="{{ 'js/scrollIt.js' }}"></script>
    <script src="{{ 'js/jquery.scrollUp.min.js' }}"></script>
    <script src="{{ 'js/wow.min.js' }}"></script>
    <script src="{{ 'js/nice-select.min.js' }}"></script>
    <script src="{{ 'js/jquery.slicknav.min.js' }}"></script>
    <script src="{{ 'js/jquery.magnific-popup.min.js' }}"></script>
    <script src="{{ 'js/plugins.js' }}"></script>
    <script src="{{ 'js/gijgo.min.js' }}"></script>

    <!--contact js-->
    <script src="{{ 'js/contact.js' }}"></script>
    <script src="{{ 'js/jquery.ajaxchimp.min.js' }}"></script>
    <script src="{{ 'js/jquery.form.js' }}"></script>
    <script src="{{ 'js/jquery.validate.min.js' }}"></script>
    <script src="{{ 'js/mail-script.js' }}"></script>
    <script src="{{ 'js/main.js' }}"></script>
</body>

</html>
