<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/ddsmoothmenu.css'])

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>


    <!-- Additional Head Content -->
    @yield('head')
</head>
<body>
<span class="smalllines">&nbsp;</span>
<!-- Wrapper -->
<div id="wrapper_sec">
    <!-- Top Section -->
    <div class="top_sec">
        <!-- Top Section Left Links -->
        <div class="toplinks">
            <ul>
                <li class="first"><a href="{{ route('home.index') }}">Home</a></li>
            </ul>
        </div>
        <!-- Top Section right Links -->
    </div>
    <div class="clear"></div>
    <!-- Header -->
    <div id="masthead">
        <!-- Logo -->
        <div class="logo">
            <a href="index.html"><img src="images/logo.png" alt="" /></a>
        </div>
        <!-- Navigation -->
        <div class="navigation">
            <div id="smoothmenu1" class="ddsmoothmenu">
                <ul>
                    <li><a href="{{ route('home.index') }}" class="btn btn-primary">Home</a></li>
                    <li><a href="{{ route('movies.index') }}" class="btn btn-primary">Movies</a></li>
                    <li><a href="{{ route('serials.index') }}" class="btn btn-primary">Serials</a></li>
                    <li><a href="{{ route('news.index') }}" class="btn btn-primary">News</a></li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div id="content_sec">
        @yield('content')
    </div>
  </div>
</div>
<div class="clear"></div>
<!-- Footer -->
<div id="footer">
    <div class="inner">
        <!-- Top button Section -->
        <div class="clear"></div>
            <!-- Footer -share -->
            <div class="share">
                <a href="#"><img src="images/youtube.png" alt="" /></a>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <!-- Footer content -->
        <div class="footer_cont">
            <!-- Footer sec1 -->
            <div class="footer_sec1">
                <!-- Footer - our network -->
                <div class="ournetwork">
                    <ul>
                        <li><a href="#" class="youtube">www.YouTube.com</a></li>
                    </ul>
                </div>
            </div>
            <!-- Footer sec2 -->
            <div class="footer_sec2">
                <!-- Footer - about us -->
                <div class="aboutus">
                    <ul>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
                <!-- Footer - information -->
            <div class="footer_sec3">
                <div class="inforamtion">
                    <ul>
                        <li><a href="#">Help</a></li>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>
      <br>
      Copyright © 2023 Digiants. All rights reserved.
    </div>
<div class="clear"></div>
  </body>
</html>
