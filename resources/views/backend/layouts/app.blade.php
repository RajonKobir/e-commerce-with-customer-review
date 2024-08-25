<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ get_settings('app_name') }} - Admin</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="{{ get_settings('meta_description') }}">
    <meta name="author" content="{{ get_settings('app_name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/img/{{ get_settings('app_icon') }}">

    <!-- FontAwesome JS-->
    <script defer src="/backend/assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- Select 2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- material design css  -->
    <link rel="stylesheet" href="/css/mdb.min.css" />

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="/backend/assets/css/portal.css">
    <link rel="stylesheet" href="/css/dataTables.dataTables.css" />


    <script src="https://cdn.tiny.cloud/1/161yofclpzjw5q574on6vi13a5wawib4gyl3see1oqgveguy/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>


</head>

<body class="app">
    @include('backend.layouts.header')

    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            @yield('content')
        </div><!--//app-content-->

        <footer class="app-footer">
            {{-- <div class="container text-center py-3">
                <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
                <small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart"
                        style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com"
                        target="_blank">Xiaoying Riley</a> for developers</small>

            </div> --}}
        </footer><!--//app-footer-->

    </div><!--//app-wrapper-->

    <!-- JQuery -->
    <script src="/js/jquery-3.7.1.min.js"></script>

    {{-- <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script> --}}

    <!-- Bootstrap js -->
    <script src="/backend/assets/plugins/popper.min.js"></script>
    <script src="/backend/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Charts JS -->
    <script src="/backend/assets/plugins/chart.js/chart.min.js"></script>
    <script src="/backend/assets/js/index-charts.js"></script>

    <!-- Select 2-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- ckeditor-->
    {{-- <script src="/backend/assets/js/ckeditor.js"></script> --}}

    <!-- Page Specific JS -->
    <script src="/backend/assets/js/app.js"></script>

    <!-- Material Design JS -->
    <script type="text/javascript" src="/js/mdb.min.js"></script>

    <script>
       /* ClassicEditor
        .create(document.querySelector('.ckeditor'),
        {
            ckfinder:{
                uploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
            }
        })
        .catch(error => {
            console.error(error);
        }); */
    </script>
    @hasSection('custom_script')
        @yield('custom_script')
    @endif
</body>

</html>
