@extends('backend.layouts.app')

@section('content')
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-12 mb-4">
                <h1 class="app-page-title mb-0">Review</h1>
            </div>
            <div class="col-md-10 col-lg-8 mx-auto">
                <div class="app-auth-body ">
                    <h2 class="auth-heading text-center mb-5">Update Review</h2>
                    <div class="auth-form-container text-start">
                        <form class="auth-form login-form" action="{{ route('admin.reviews.update', ['review' => $review->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                            <label class="mb-2" for="blog_id">Select Blog</label>
                            <select id="blog_id" name="blog_id" class="form-select" required>
                                @php
                                foreach ($blogs as $blog_key=>$blog){
                                    $selected = '';
                                    if( $review->blog_id == $blog->id ){
                                        $selected = 'selected';
                                    }
                                @endphp
                                    <option value="{{ $blog->id }}" {{ $selected }}>{{ $blog->title }}</option>
                                @php
                                }
                                @endphp
                            </select>
                            </div><!--//form-group-->
                            <div class="mb-3">
                            <label class="mb-2" for="user_id">Select User</label>
                            <select id="user_id" name="user_id" class="form-select" required>
                                @php
                                foreach ($users as $user_key=>$user){
                                    $selected = '';
                                    if( $review->user_id == $user->id ){
                                        $selected = 'selected';
                                    }
                                @endphp
                                    <option value="{{ $user->id }}" {{ $selected }}>{{ $user->name }}</option>
                                @php
                                }
                                @endphp
                            </select>
                            </div><!--//form-group-->
                            <div class="mb-3">
                                <label class="mb-2" for="title">Title</label>
                                <input id="title" name="title" type="text" class="form-control"
                                    placeholder="Review Title" value="{{ $review->title }}" minlength="10" maxlength="250" required="required">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->
                            <div class="mb-3">
                                <label class="mb-2" for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" minlength="10" maxlength="500" style="min-height: 150px" required>{{ $review->description }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->
                            <div class="mb-3">
                                <label class="mb-2" for="rating">Rating</label>
                                <input id="rating" name="rating" type="number" class="form-control" placeholder="Review Rating" step="0.01" max="5" value="{{ $review->rating }}" required="required">
                                @error('rating')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->
                            <div class="mb-3">
                                <label class="mb-2" for="approved">Approved:</label>
                                <select id="approved" name="approved" class="form-select" required>
                                    <option value="1" {{ $review->approved == 1 ? 'selected' : '' }}>yes</option>
                                    <option value="0" {{ $review->approved == 0 ? 'selected' : '' }}>no</option>
                                </select>
                            </div><!--//form-group-->

                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Update</button>
                            </div>
                            @if (Session::has('error'))
                                <div class="text-center mt-2">
                                    <span class="text-danger">{{ Session::get('error') }}</span>
                                </div>
                            @endif

                        </form>

                        {{-- <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link"
                                href="signup.html">here</a>.</div> --}}
                    </div><!--//auth-form-container-->

                </div><!--//auth-body-->
            </div>


        </div><!--//row-->


    </div><!--//container-fluid-->
@endsection
