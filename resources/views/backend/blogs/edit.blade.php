@extends('backend.layouts.app')

@section('content')
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-12 mb-4">
                <h1 class="app-page-title mb-0">Blog</h1>
            </div>
            <div class="col-md-10 col-lg-8 mx-auto">
                <div class="app-auth-body ">
                    <h2 class="auth-heading text-center mb-5">Update Blog</h2>
                    <div class="auth-form-container text-start">
                        <form class="auth-form login-form" action="{{ route('admin.blog.update', ['blog' => $blog->slug]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label class="mb-2" for="title">Title</label>
                                <input id="title" name="title" type="text" class="form-control"
                                    value="{{ old('title') ? old('title') : $blog->title }}" placeholder="Blog Title"
                                    required="required">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->
                            <div class="mb-3">
                                <label class="mb-2" for="meta_title">Meta Title</label>
                                <input id="meta_title" name="meta_title" type="text" class="form-control" placeholder="Blog Meta Title"  value="{{ old('meta_title') ? old('meta_title') : $blog->meta_title }}" required="required">
                                @error('meta_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->
                            <div class="mb-3">
                                <label class="mb-2" for="meta_description">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" class="form-control" placeholder="Blog Meta Description" style="min-height: 150px" required="required">{{ old('meta_description') ? old('meta_description') : $blog->meta_description }}</textarea>
                                @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="mb-3">
                                <label class="mb-2" for="sub_category">Sub Category</label>
                                <select class="form-select" name="sub_category_id">
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}"
                                            {{ $blog->sub_category_id == $subCategory->id ? 'selected' : '' }}>
                                            {{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('sub_category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="mb-3">
                                @php
                                    $selected_tags = [];
                                    foreach ($blog->tags as $tag) {
                                        array_push($selected_tags, $tag->id);
                                    }
                                @endphp
                                <label class="mb-2" for="tags">Tags</label>
                                <select class="form-select form-select2" name="tags[]" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ in_array($tag->id, $selected_tags) ? 'selected' : '' }}>
                                            {{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                @error('tags')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="mb-3">
                                <label class="mb-2" for="image">Image <span class="text-danger text-sm">(images size should be 640x360 px)</span></label>
                                <input type="file" name="image"
                                    value="{{ old('image') ? old('image') : $blog->image }}"
                                    class="form-control img-select" id="image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <img src="/img/{{ $blog->image }}" alt="{{ $blog->title }}"
                                    class="img-thumbnail w-25 mt-3 img-preview">
                            </div><!--//form-group-->

                            <div class="mb-3">
                                <label class="mb-2" for="body">Body</label>
                                <textarea name="body" id="body" class="ckeditor form-control"
                                    value="{{ old('body') ? old('body') : $blog->body }}" style="min-height: 150px">
                                    {{ $blog->body }}
                                </textarea>
                                @error('body')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="mb-3">
                                <label class="mb-2" for="download_link">Download Link</label>
                                <input id="download_link" name="download_link"
                                    value="{{ old('download_link') ? old('download_link') : $blog->download_link }}"
                                    type="text" class="form-control" placeholder="Download Link" >
                                <!-- <input id="download_link" name="download_link"
                                    value="{{ old('download_link') ? old('download_link') : $blog->download_link }}"
                                    type="text" class="form-control" placeholder="Download Link" required="required"> -->
                                @error('download_link')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><!--//form-group-->

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="direct_download" value="1"
                                    id="settings-switch-1" {{ $blog->direct_download == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="settings-switch-1">Acitvate Direct Download</label>
                                @error('direct_download')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

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
