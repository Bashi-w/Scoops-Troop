<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>Scoops Troop</title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- Favicons -->
        <link href="assets/img/favicon-32x32.png" rel="icon" />
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

        <!-- Vendor CSS Files -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        rel="stylesheet"
        />

    </head>

    <body>
        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top">
            <div class="container d-flex align-items-center justify-content-between">
                <a href="/" class="logo"><img src="assets/img/i2.png" alt="" class="img-fluid" /></a>

                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link scrollto" href="/">Home</a></li>
                        <li><a class="nav-link scrollto" href="/#services">Services</a></li>
                        <li><a class="nav-link scrollto" href="/#portfolio">Flavours</a></li>
                        <li><a class="nav-link scrollto" href="/#team">Team</a></li>
                        <li><a class="nav-link scrollto" href="/#contact">Contact</a></li>
                        <li><a href="{{route('categories.index')}}">Make Order</a></li>
                        @if (Route::has('login')) @auth
                        <li class="dropdown">
                            <a href="#"><span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>                                
                                @if (Auth::user()->is_admin)
                                <li>
                                    <a class="dropdown-item" href="/admin">
                                        Admin Dashboard
                                    </a>
                                </li>

                                <!-- <li>
                                    <a class="dropdown-item" onclick="event.preventDefault(); openAdminDashboard()">
                                        Admin Dashboard
                                    </a>
                                </li> -->
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.profile', Auth::user()->id) }}">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                                <li>
                                    <form
                                        id="delete-account-form"
                                        action="{{ route('user.destroy', Auth::user()->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');"
                                    >
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete Account</button>
                                    </form>
                                </li>
                            </ul>

                            
                        </li>

                        @else
                        <li><a href="{{ route('login') }}">Log in</a></li>
                        <!-- @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @endif -->
                         @endauth
                          @endif
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
                <!-- .navbar -->
            </div>
        </header>
        <!-- End Header -->

        @yield('content')

        <!-- ======= Footer ======= -->
        <footer id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 footer-contact">
                            <h3>Scoops Troop</h3>
                            <p>
                                542 Peradeniya Rd, <br />
                                Kandy<br />
                                Sri Lanka <br />
                                <br />
                                <strong>Phone:</strong> +94 76 467 1129<br />
                                <strong>Email:</strong> scoopstroop@gmail.com<br />
                            </p>
                        </div>

                        <div class="col-lg-2 col-md-6 footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Products</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Contact</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Services</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Impressive Discounts</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Online ordering</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Flavour of the Month Club</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Birthday Scoop</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-4 col-md-6 footer-newsletter">
                            <h4>Join Our Newsletter</h4>
                            <p>Sign up now to receive the latest news, updates, and exclusive promotions straight to your inbox by joining our newsletter!</p>
                            <form action="" method="post"><input type="email" name="email" /><input type="submit" value="Subscribe" /></form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container d-md-flex py-4">
                <div class="me-md-auto text-center text-md-start">
                    <div class="copyright">
                        &copy; Copyright <strong><span>ScoopsTroop</span></strong>. All Rights Reserved
                    </div>
                </div>
                <div class="social-links text-center text-md-right pt-3 pt-md-0">
                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        
        <!-- Vendor JS Files -->
        <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/contact-form/validate.js"></script>

        <!-- Template Main JS File -->

        <script src="{{asset('assets/js/main.js')}}"></script>
        <!--Alpine js-->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

       
    </body>
</html>
