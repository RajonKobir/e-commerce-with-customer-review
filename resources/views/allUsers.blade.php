@extends('layouts.app2')

@section('title', get_settings('app_name'))
@section('meta_description', get_settings('meta_description'))
@section('meta_tags', get_settings('meta_tags'))


@section('section')
    <!--Card Sections-->
    <div class="col-md-12 pe-4">

    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">All Users</h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    </div><!--//row-->
                </div><!--//table-utilities-->
            </div><!--//col-auto-->
        </div><!--//row-->


        <!-- users boxes  -->
        <div class="user_box row mb-5">

            @php
                $users = App\Models\User::select('country_name', DB::raw('COUNT(dial_code) as user_count'))
                    ->whereNotNull('dial_code')
                    ->groupBy('country_name')
                    ->orderByDesc('user_count')
                    ->skip(0)
                    ->take(20)
                    ->get();
                if( count($users) > 0 ){
            @endphp

            <div class="col-lg-3 col-md-4">
                <div class="card border">
                    <div class="card-body">
                        <div class="">

                            <table class="table table-hover">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->country_name }}</td>
                                    <td> {{ $user->user_count }}</td>
                                </tr>
                            @endforeach
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            @php
                }else{

            @endphp

            <div class="col-md-12">
                <h1 class="col-md-12 text-bold text-center">Still No Clients.</h1>
            </div>

            @php
                }
            @endphp


            @php
            $users = App\Models\User::select('country_name', DB::raw('COUNT(dial_code) as user_count'))
                    ->whereNotNull('dial_code')
                    ->groupBy('country_name')
                    ->orderByDesc('user_count')
                    ->skip(20)
                    ->take(20)
                    ->get();
                if( count($users) > 0 ){
            @endphp

            <div class="col-lg-3 col-md-4">
                <div class="card border">
                    <div class="card-body">
                        <div class="">

                            <table class="table table-hover">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->country_name }}</td>
                                    <td> {{ $user->user_count }}</td>
                                </tr>
                            @endforeach
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            @php
                }
            @endphp

            @php
            $users = App\Models\User::select('country_name', DB::raw('COUNT(dial_code) as user_count'))
                    ->whereNotNull('dial_code')
                    ->groupBy('country_name')
                    ->orderByDesc('user_count')
                    ->skip(40)
                    ->take(20)
                    ->get();
                if( count($users) > 0 ){
            @endphp

            <div class="col-lg-3 col-md-4">
                <div class="card border">
                    <div class="card-body">
                        <div class="">

                            <table class="table table-hover">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->country_name }}</td>
                                    <td> {{ $user->user_count }}</td>
                                </tr>
                            @endforeach
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            @php
                }
            @endphp

            @php
            $users = App\Models\User::select('country_name', DB::raw('COUNT(dial_code) as user_count'))
                ->whereNotNull('dial_code')
                ->groupBy('country_name')
                ->orderByDesc('user_count')
                ->skip(60)
                ->take(20)
                ->get();
                if( count($users) > 0 ){
            @endphp

            <div class="col-lg-3 col-md-4">
                <div class="card border">
                    <div class="card-body">
                        <div class="">

                            <table class="table table-hover">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->country_name }}</td>
                                    <td> {{ $user->user_count }}</td>
                                </tr>
                            @endforeach
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            @php
                }
            @endphp



        </div>

        </div>
        <!-- container ends  -->
    </div>
    <!--Card Sections-->
@endsection

@section('custom_script')

    <!-- jquery js  -->
    <script type="text/javascript" src="/js/jquery-3.7.1.min.js"></script>

    <!-- datatable js  -->
    <script src="/js/dataTables.js"></script>
    
@endsection


@section('schema')
    <script type="application/ld+json">
        {
            "@context" : "https://schema.org/",
            "@type" : "Article",
            "name" : "{{ env( 'APP_NAME' ) }}",
            "url" : "{{ env('APP_URL') }}",
            "logo" : "{{ env('APP_URL') . '/img/LOGO.png' }}"
        }
    </script>
@endsection