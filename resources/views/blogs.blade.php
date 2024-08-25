@extends('layouts.app')

@section('title', get_settings('app_name'))
@section('meta_title', get_settings('app_name'))
@section('meta_description', get_settings('meta_description'))
@section('meta_tags', get_settings('meta_tags'))


@section('section')
    <!--Card Sections-->
    <div class="col-md-9 pe-4">

        <!-- Post Section -->
        <section>
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
                                            class="post-tag bg-success px-2 rounded-pill hover-shadow d-inline-block mb-2 me-1">
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
                {{ $blogs->links() }}

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
    </div>
    <!--Card Sections-->
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