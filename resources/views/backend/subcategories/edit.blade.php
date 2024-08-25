@extends('backend.layouts.app')

@section('content')
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-12 mb-4">
                <h1 class="app-page-title mb-0">Sub Categories</h1>
            </div>
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="app-auth-body ">
                    <h2 class="auth-heading text-center mb-5">Edit Sub Category</h2>
                    <div class="auth-form-container text-start">
                        <form class="auth-form login-form"
                            action="{{ route('admin.subcat.update', ['subcategory' => $subcategory->slug]) }}"
                            method="POST">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2" for="category">Category</label>
                                <select class="form-select" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $subcategory->category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-2" for="name">Name</label>
                                <input id="name" name="name" type="text"
                                    value="{{ old('name') ? old('name') : $subcategory->name }}" class="form-control"
                                    placeholder="Category Name" required="required">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
