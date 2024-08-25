<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7W2X10DCP2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-7W2X10DCP2');
    </script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_tags')" />
    <title>@yield('title')</title>
    <!-- MDB icon -->
    <link rel="icon" href="/img/{{ get_settings('app_icon') }}" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- Google Fonts Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->

    <link rel="stylesheet" href="/css/mdb.min.css" />
    <!-- Custom Styels -->
    <link rel="stylesheet" href="/css/styles.css">


    <!-- App CSS -->
    <link rel="stylesheet" href="/css/dataTables.dataTables.css" />


</head>

<body class="app">
    <div class="fixed-bottom-right">
        <a href="https://api.whatsapp.com/send?phone=88{{ get_settings('whatsapp_number') }}" target="_blank" class="sticky-logo" >
            <span class="me-1 me-md-2 text-white rounded hidden-on-load">Whatsapp Now!</span>
            <img src="/img/whatsapp-logo.webp" id="sticky-logo" alt="Whatsapp image">
        </a>
    </div>
    @include('layouts.header')

    <!--Main layout-->
    <main class="mt-5">
        <div class="container">
            @if(Route::is( 'home' ))
                <div class="row">
                    @include('layouts.carousol')
                </div>
            @endif
            <div class="row">
                @yield('section')
            </div>
            @if (Route::is('home'))
                <div class="row mt-5">
                    @include('layouts.brands')
                </div>
                <div class="row mt-5 text-center">
                    @include('layouts.seo')
                </div>
            @endif

            
            
        </div>
    </main>

    @include('layouts.footer')
    <!-- MDB -->
    <script type="text/javascript" src="/js/mdb.min.js"></script>
    <script type="text/javascript" src="/js/scripts.js"></script>


    
    @hasSection('custom_script')
        @yield('custom_script')
    @endif

    <!-- Schema Markup -->
    @hasSection('schema')
        @yield('schema')
    @endif


</body>

</html>
