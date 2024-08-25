@extends('backend.layouts.app')

@section('content')
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-12 mb-4">
                <h1 class="app-page-title mb-0">Sliders</h1>
            </div>
            <div class="col-md-10 col-lg-8 mx-auto">
                <div class="app-auth-body ">
                    <h2 class="auth-heading text-center mb-5">Create a Slider</h2>
                    <div class="auth-form-container text-start">
                        <form class="auth-form login-form" action="{{ route('admin.slider.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2" for="title">Title</label>
                                <input id="title" name="title" type="text" class="form-control"
                                    placeholder="Slider Title" required="required">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="mb-3">
                                <label class="mb-2" for="description">Description</label>
                                <input id="description" name="description" type="text" class="form-control"
                                    placeholder="Slider Description" required="required">
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="mb-3">
                                <label class="mb-2" for="image">Image <span class="text-danger text-sm">(images size should be 1050x450 px)</span></label>
                                <input type="file" name="image" class="form-control img-select" id="image">
                                <img src="" alt="" class="img-thumbnail w-25 mt-3 img-preview">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Create</button>
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
