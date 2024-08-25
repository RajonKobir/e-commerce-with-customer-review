@extends('backend.layouts.app')

@section('content')
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-12 mb-4">
                <h1 class="app-page-title mb-0">Blog</h1>
            </div>
            <div class="col-md-10 col-lg-8 mx-auto">
                <div class="app-auth-body ">
                    <h2 class="auth-heading text-center mb-5">Create Blog</h2>
                    <div class="auth-form-container text-start">
                        <form class="auth-form login-form" action="{{ route('admin.blog.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2" for="title">Title</label>
                                <input id="title" name="title" type="text" class="form-control"
                                    placeholder="Blog Title" required="required">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->
                            <div class="mb-3">
                                <label class="mb-2" for="meta_title">Meta Title</label>
                                <input id="meta_title" name="meta_title" type="text" class="form-control"
                                    placeholder="Blog Meta Title" required="required">
                                @error('meta_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->
                            <div class="mb-3">
                                <label class="mb-2" for="meta_description">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" class="form-control" placeholder="Blog Meta Description" style="min-height: 150px" required="required"></textarea>
                                @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="mb-3">
                                <label class="mb-2" for="sub_category">Sub Category</label>
                                <select class="form-select" name="sub_category_id">
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('sub_category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="mb-3">
                                <label class="mb-2" for="tags">Tags</label>
                                <select class="form-select form-select2" name="tags[]" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                @error('tags')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="mb-3">
                                <label class="mb-2" for="image">Image <span class="text-danger text-sm">(images size should be 640x360 px)</span></label>
                                <input type="file" name="image" class="form-control img-select" id="image">
                                <img src="" alt="" class="img-thumbnail w-25 mt-3 img-preview">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="mb-3">
                                <label class="mb-2" for="body">Body</label>
                                <textarea name="body" id="body" class="ckeditor form-control" style="min-height: 150px"></textarea>
                                @error('body')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="mb-3">
                                <label class="mb-2" for="download_link">Download Link</label>
                                <input id="download_link" name="download_link" type="text" class="form-control"
                                    placeholder="Download Link" >
                                <!-- <input id="download_link" name="download_link" type="text" class="form-control"
                                    placeholder="Download Link" required="required"> -->
                                @error('download_link')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="direct_download" value="1"
                                    id="settings-switch-1" checked>
                                <label class="form-check-label" for="settings-switch-1">Acitvate Direct Download</label>
                                @error('direct_download')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

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
