<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />

    @vite('resources/css/style.css')
    @yield('style')
</head>

<body class="layout-fixed {{ Route::currentRouteName() != 'home.index' ? 'sub_page' : '' }}">
    <div class="wrapper" style="min-height: 1223px;">
        <div class="hero_area">
            <div class="bg-box">
                <img src="images/hero-bg.jpg" alt="">
            </div>
            <!-- header section strats -->
            <header class="header_section">
                <div class="container">
                    <nav class="navbar navbar-expand-lg custom_nav-container ">
                        @if (setting('general.name'))
                        <a class="navbar-brand" href="{{ route('home.index') }}">
                            <span>
                                {{ setting('general.name') }}
                            </span>
                        </a>
                        @endif
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""> </span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto ">
                                <li class="nav-item {{ Route::currentRouteName() == 'home.index' ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('home.index') }}">Strona Główna <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item {{ Route::currentRouteName() == 'home.menu' ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('home.menu') }}">Menu</a>
                                </li>
                                <li class="nav-item {{ Route::currentRouteName() == 'home.about' ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('home.about') }}">O nas</a>
                                </li>
                                <li class="nav-item {{ Route::currentRouteName() == 'home.reservation' ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('home.reservation') }}">Zarezerwuj Stolik</a>
                                </li>
                            </ul>
                            <div class="user_option">
                                <a href="{{ route('login') }}" class="user_link">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </a>
                                <a class="cart_link" href="#">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </a>
                                <form class="form-inline">
                                    <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <!-- <a href="" class="order_online">
                            Order Online
                        </a> -->
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
            <!-- end header section -->
            <!-- slider section -->
            @yield('slider')
            <!-- end slider section -->
        </div>

        @yield('content')

        <!-- footer section -->
        <footer class="footer_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footer-col">
                        <div class="footer_contact">
                            <h4>
                                Kontakt
                            </h4>
                            <div class="contact_link_box">
                                <a href="">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>
                                        {{ setting('contact.address') }}
                                    </span>
                                </a>
                                <a href="">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>
                                        Zadzwoń {{ setting('contact.telephone') }}
                                    </span>
                                </a>
                                <a href="">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>
                                        {{ setting('contact.email') }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 footer-col">
                        <div class="footer_detail">
                            @if (setting('general.name'))
                            <a href="{{ route('home.index') }}" class="footer-logo">
                                {{ setting('general.name') }}
                            </a>
                            @endif
                            @if (setting('general.description'))
                            <p>
                                {{ setting('general.description') }}
                            </p>
                            @endif
                            <div class="footer_social">
                                @if (setting('general.socialmedia_facebook'))
                                <a href="{{ setting('general.socialmedia_facebook') }}">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                                @endif
                                @if (setting('general.socialmedia_twitter'))
                                <a href="{{ setting('general.socialmedia_twitter') }}">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                                @endif
                                @if (setting('general.socialmedia_linkedin'))
                                <a href="{{ setting('general.socialmedia_linkedin') }}">
                                    <i class="fa-brands fa-linkedin"></i>
                                </a>
                                @endif
                                @if (setting('general.socialmedia_instagram'))
                                <a href="{{ setting('general.socialmedia_instagram') }}">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                @endif
                                @if (setting('general.socialmedia_pinterest'))
                                <a href="{{ setting('general.socialmedia_pinterest') }}">
                                    <i class="fa-brands fa-pinterest"></i>
                                </a>
                                @endif
                                @if (setting('general.socialmedia_youtube'))
                                <a href="{{ setting('general.socialmedia_youtube') }}">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 footer-col">
                        <h4>
                            Godziny otwarcia
                        </h4>
                        @foreach ($settings['opening_hours'] as $key => $setting)
                        <p>
                            {{ setting('opening_hours.' . $key . '_day') }}
                        </p>
                        <p>
                            {{ setting('opening_hours.' . $key . '_open') }} - {{ setting('opening_hours.' . $key . '_close') }}
                        </p>
                        @endforeach
                    </div>
                </div>
                <div class="footer-info">
                    <p>
                        &copy; <span id="displayYear"></span> All Rights Reserved By
                        <a href="https://html.design/">Free Html Templates</a><br><br>
                        &copy; <span id="displayYear"></span> Distributed By
                        <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
                    </p>
                </div>
            </div>
        </footer>
        <!-- footer section -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js" integrity="sha512-KBeR1NhClUySj9xBB0+KRqYLPkM6VvXiiWaSz/8LCQNdRpUm38SWUrj0ccNDNSkwCD9qPA4KobLliG26yPppJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>

    @include('layouts.alert')

    @yield('script')
    @vite('resources/js/custom.js')
</body>

</html>