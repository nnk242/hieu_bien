<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="BKmG-taf0SeoRRGYa8T-fvHjZIyheJslPVvV81JEf5c"/>

    <title>Hieu Bien</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!--my style-->
    <link href="/frontend/css/styles.css" rel="stylesheet"/>

    <!-- selectize -->
    <link href="/frontend/libs/selectize/css/bootstrap2.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/bootstrap3.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/selectize.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/default.css" rel="stylesheet"/>
    <link href="/frontend/libs/selectize/css/legacy.css" rel="stylesheet"/>

    @yield('css')

</head>
<body>
<div id="app">
    @include('layouts.frontend.components.header')
    <section class="slide">
        <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="custom-carousel"
                         style="background-image: url('https://66.media.tumblr.com/948e0c698f664e6df4856a23e25d039d/tumblr_pkdnm1hOgl1rogvb0o1_1280.jpg');"></div>
                    <div class="carousel-caption">
                        <h3>Halo</h3>
                        <p>We had such a great time in LA!</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="custom-carousel"
                         style="background-image: url('https://66.media.tumblr.com/199539802afecc30b15b3121c7c0f7dc/tumblr_pjh7l05o221rogvb0o1_1280.jpg')"></div>
                    <div class="carousel-caption">
                        <h3>HHHHH</h3>
                        <p>Thank you, Chicago!</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="custom-carousel"
                         style="background-image: url('https://66.media.tumblr.com/9a6917793aea942bebfe2e5cdbc97dca/tumblr_pj39bt1WJH1rogvb0o1_1280.jpg')">
                    <div class="carousel-caption">
                        <h3>Hieu</h3>
                        <p>We love the Big Apple!</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </section>
    <div class="wrap">
        {{--@include('layouts.frontend.components.shareMXH')--}}
        @yield('content')
    </div>
    @include('layouts.frontend.components.footer')
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>

<script src="/frontend/libs/selectize/js/standalone/selectize.js"></script>

<script src="/frontend/libs/selectize/js/selectize.js"></script>

<script src="/frontend/js/search.js"></script>

@yield('js')

</body>
</html>
