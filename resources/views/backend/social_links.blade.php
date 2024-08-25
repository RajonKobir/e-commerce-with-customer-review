@extends('backend.layouts.app')

@section('content')
    <div class="container-xl">

        <h1 class="app-page-title">Social Links</h1>

        @if (Session::has('success'))
            <div class="row">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="row">
            <!-- Facebook Link -->
            <div class="col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Facebook</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('admin.social.update', ['social_link' => $social_links['facebook']->slug]) }}"
                            method="POST">
                            @csrf
                            @method('put')
                            <!-- Text input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="url" value="{{ $social_links['facebook']->url }}"
                                    id="facebook" class="form-control" />
                                <label class="form-label" for="facebook_url">Facebook URL</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="isActive" value="1"
                                    id="settings-switch-1" {{ $social_links['facebook']->isActive == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="settings-switch-1">Show On Webpage</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Facebook Link -->

            <!-- Twitter Link -->
            <div class="col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Twitter</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.social.update', ['social_link' => $social_links['twitter']->slug]) }}"
                            method="POST">
                            @csrf
                            @method('put')
                            <!-- Text input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="url" value="{{ $social_links['twitter']->url }}"
                                    id="twitter" class="form-control" />
                                <label class="form-label" for="twitter_url">Twitter URL</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="isActive" value="1"
                                    id="settings-switch-1" {{ $social_links['twitter']->isActive == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="settings-switch-1">Show On Webpage</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Twitter Link -->

            <!-- Instagram Link -->
            <div class="col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Instagram</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('admin.social.update', ['social_link' => $social_links['instagram']->slug]) }}"
                            method="POST">
                            @csrf
                            @method('put')
                            <!-- Text input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="url" value="{{ $social_links['instagram']->url }}"
                                    id="instagram" class="form-control" />
                                <label class="form-label" for="instagram_url">Instagram URL</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="isActive" value="1"
                                    id="settings-switch-1" {{ $social_links['instagram']->isActive == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="settings-switch-1">Show On Webpage</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Instagram Link -->

            <!-- Linkedin Link -->
            <div class="col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Linkedin</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('admin.social.update', ['social_link' => $social_links['linkedin']->slug]) }}"
                            method="POST">
                            @csrf
                            @method('put')
                            <!-- Text input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="url" value="{{ $social_links['linkedin']->url }}"
                                    id="linkedin" class="form-control" />
                                <label class="form-label" for="linkedin_url">Linkedin URL</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="isActive" value="1"
                                    id="settings-switch-1"
                                    {{ $social_links['linkedin']->isActive == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="settings-switch-1">Show On Webpage</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Linkedin Link -->

            <!-- Youtube Link -->
            <div class="col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Youtube</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('admin.social.update', ['social_link' => $social_links['youtube']->slug]) }}"
                            method="POST">
                            @csrf
                            @method('put')
                            <!-- Text input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="url" value="{{ $social_links['youtube']->url }}"
                                    id="youtube" class="form-control" />
                                <label class="form-label" for="youtube_url">Youtube URL</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="isActive" value="1"
                                    id="settings-switch-1" {{ $social_links['youtube']->isActive == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="settings-switch-1">Show On Webpage</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Youtube Link -->

            <!-- Discord Link -->
            <div class="col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Discord</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('admin.social.update', ['social_link' => $social_links['discord']->slug]) }}"
                            method="POST">
                            @csrf
                            @method('put')
                            <!-- Text input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="url" value="{{ $social_links['discord']->url }}"
                                    id="discord" class="form-control" />
                                <label class="form-label" for="discord_url">Discord URL</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="isActive" value="1"
                                    id="settings-switch-1" {{ $social_links['discord']->isActive == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="settings-switch-1">Show On Webpage</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Discord Link -->

            <!-- Github Link -->
            <div class="col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Github</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('admin.social.update', ['social_link' => $social_links['github']->slug]) }}"
                            method="POST">
                            @csrf
                            @method('put')
                            <!-- Text input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="url" value="{{ $social_links['github']->url }}"
                                    id="github" class="form-control" />
                                <label class="form-label" for="github_url">Github URL</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="isActive" value="1"
                                    id="settings-switch-1" {{ $social_links['github']->isActive == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="settings-switch-1">Show On Webpage</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Github Link -->

            <!-- Google Link -->
            <div class="col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Google</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('admin.social.update', ['social_link' => $social_links['google']->slug]) }}"
                            method="POST">
                            @csrf
                            @method('put')
                            <!-- Text input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="url" value="{{ $social_links['google']->url }}"
                                    id="google" class="form-control" />
                                <label class="form-label" for="google_url">Google URL</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="isActive" value="1"
                                    id="settings-switch-1" {{ $social_links['google']->isActive == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="settings-switch-1">Show On Webpage</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Google Link -->



        </div>

    </div><!--//container-fluid-->
@endsection
