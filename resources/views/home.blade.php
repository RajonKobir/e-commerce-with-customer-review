@extends('layouts.app')

@section('title', get_settings('app_name'))
@section('meta_title', get_settings('app_name'))
@section('meta_description', get_settings('meta_description'))
@section('meta_tags', get_settings('meta_tags'))

@section('section')
    <!--Card Sections-->
    <div class="col-md-9 pe-4 mt-5">
        <!-- Carousol Section -->
        {{-- <section>
            <!-- Carousel wrapper -->
            <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                <!-- Inner -->
                <div class="carousel-inner">
                    @foreach ($sliders as $key=>$slider)
                        <!-- Single item -->
                        <div class="carousel-item {{ $key==0 ?  'active' : '' }} ">
                            <img src="/img/{{ $slider->image }}" class="d-block w-100"
                                alt="{{ $slider->title }}" />
                            <div class="carousel-caption d-none d-md-block">
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Inner -->

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample"
                    data-mdb-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample"
                    data-mdb-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- Carousel wrapper -->
        </section> --}}
        <!-- Carousol Section -->

        {{-- <section id="clients" class="clients section-bg">
            <div class="container d-md-block">
                <div class="row">
                <div class="col-lg-4 col-md-4 col-4 align-items-center justify-content-center">
                <div><img src="{{ asset('img/icon-professional2.png'); }}" class="img-fluid" alt><h5>PROFESSIONAL</h5>
                <h6>Engineer Consultation Team<h6></div>
                </div>
                <div class="col-lg-4 col-md-4 col-4 d-flex align-items-center justify-content-center">
                <div><img src="{{ asset('img/icon-skillfull2.png'); }}" class="img-fluid" alt><h5>SKILLFULL</h5>
                <h6>Installation Team<h6></div>
                </div>
                <div class="col-lg-4 col-md-4 col-4 d-flex align-items-center justify-content-center">
                <div><img src="{{asset('img/icon-high-experence4.png');}}" class="img-fluid" alt><h5>HIGH EXPERIENCE</h5>
                <h6>After-Sale Service and Maintenance Team<h6></div>
                </div>
                </div>
            </div>
        </section> --}}

        <!-- Post Section -->
        <section>
            <h4 class="text-center mb-5">
                <strong>LATEST POST</strong>
            </h4>

            <!-- Post Group -->
            <div class="row">
                @foreach ($blogs as $blog)
                    <!-- Post -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="/img/{{ $blog->image }}" class="img-fluid" />
                                <a href="{{ route('blog.show', ['blog' => $blog->slug]) }}">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                    </div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{ route('blog.show', ['blog' => $blog->slug]) }}">{{ $blog->title }}</a>
                                </h4>
                                <!-- <a href="#!" class="btn btn-success">View</a> -->
                                <div class="flex flex-wrap">
                                    @foreach ($blog->tags as $tag)
                                        <span
                                            class="post-tag bg-success px-3 py-2 rounded-pill hover-shadow d-inline-block mb-2 me-1">
                                            <a href="{{ route('blog.tag', ['tag' => $tag->slug]) }}" class="link-light">#{{ $tag->name }}</a>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer text-muted d-flex justify-content-between">
                                <div>
                                    <i class="fas fa-eye"></i> {{ $blog->views }}
                                </div>
                                <div>
                                    <i class="fas fa-calender"></i> {{ date('d.m.y', strtotime($blog->created_at)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Post -->
                @endforeach
            </div>
            <!-- Post Group -->
            <div class="mt-4 d-flex justify-content-center">
                <a href="{{ route('blog.index') }}" class="btn btn-lg btn-success">View More</a>

                {{-- <nav aria-label="...">
                    <ul class="pagination pagination-circle">
                        <li class="page-item">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#">2 <span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav> --}}
            </div>
        </section>
        <!-- Post Section -->

        {{-- <section class="my-5 ">
            <div class="row align-items-center h-100">
                <div class="container rounded">
                    <h2 class="text-center">OUR BRANDS:</h2>
                    <div class="slider">
                        <div class="logos">
                            @foreach ($brands as $brand)
                                <img src="/img/{{ $brand->image }}" alt="{{ $brand->title }}" class="img img-fluid" >
                            @endforeach
                        </div>
                        <div class="logos d-none">
                            @foreach ($brands as $brand)
                                <img src="/img/{{ $brand->image }}" alt="{{ $brand->title }}" class="img img-fluid" style="width:calc(100%/{{$brands->count()}})" >
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    </div>
    <!--Card Sections-->
@endsection



@section('custom_script')

@endsection



@section('schema')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org/",
          "@type": "Article",
          "name": "{{ env( 'APP_NAME' ) }}",
          "url": "{{ env('APP_URL') }}",
          "logo": "{{ env('APP_URL') . '/img/LOGO.png' }}"
        }
        </script>
@endsection