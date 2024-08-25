@extends('backend.layouts.app')

@section('content')
    <div class="container-xl">

        <div class="card px-3 pt-3">
            <!-- News block -->
            <div>
                <!-- Featured image -->
                <div class="bg-image hover-overlay shadow-1-strong ripple rounded-5 mb-4" data-mdb-ripple-color="light">
                    <img src="/img/{{ $blog->image }}" class="img-fluid w-100" />
                    <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                </div>

                <!-- Article data -->
                <div class="row mb-3">
                    <div class="col-6">
                        <a href="" class="text-info d-block mb-3">
                            <i class="fas fa-list"></i>
                            {{ $blog->sub_category->name }}
                        </a>
                        @foreach ($blog->tags as $tag)
                            <span class="badge btn bg-primary me-2">#{{ $tag->name }}</span>
                        @endforeach
                    </div>

                    <div class="col-6 text-end">
                        <u> {{ date('d.m.y', strtotime($blog->updated_at)) }}</u>
                    </div>
                </div>

                <!-- Article title and description -->
                <h5 class="mb-3">{{ $blog->title }}</h5>
                {!! $blog->body !!}

                <hr />
                <div class="row mb-3">
                    <div class="col-6">
                        <p><span class="badge bg-primary btn"><i class="far fa-eye me-1"></i> Views:
                                {{ $blog->views }}</span>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn app-btn-info" href="{{ route('admin.blog.edit', ['blog' => $blog->slug]) }}">Edit</a>
                        <form action="{{ route('admin.blog.destroy', ['blog' => $blog->slug]) }}" class="d-inline-block"
                            method="post">
                            @method('delete')
                            @csrf
                            <button class="btn app-btn-danger">Delete</button>
                        </form>
                    </div>
                </div>

            </div>
            <!-- Blog block -->
        </div>


    </div><!--//container-fluid-->
@endsection
