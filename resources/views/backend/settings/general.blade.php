@extends('backend.layouts.app')

@section('content')
    <div class="container-xl">
        <h1 class="app-page-title">Settings</h1>

        @if (Session::has('success'))
            <div class="row">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">App Name</h3>
                <div class="section-intro">Provide Your App Name</div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">
                        <form class="settings-form" method="POST" action="{{ route('admin.settings.app_name.set') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="appName" class="form-label">App Name</label>
                                <input type="text" class="form-control" id="appName" name="app_name"
                                    value="{{ get_settings('app_name') ?? '' }}" required>
                            </div>
                            <button type="submit" class="btn app-btn-primary">Save Changes</button>
                        </form>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->
        <hr class="my-4">

        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">App Logo</h3>
                <div class="section-intro">Provide Your App Logo</div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">
                        <form class="settings-form" method="POST" action="{{ route('admin.settings.app_logo.set') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="app_logo" class="form-label">App Logo</label>
                                <input type="file" class="form-control img-select" id="app_logo" name="app_logo">
                                <img src="/img/{{ get_settings('app_logo') ?? '' }}"
                                    alt="{{ get_settings('app_logo') ?? '' }}" class="img-thumbnail w-25 mt-3 img-preview">
                            </div>
                            <button type="submit" class="btn app-btn-primary">Save Changes</button>
                        </form>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->
        <hr class="my-4">

        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">App Icon</h3>
                <div class="section-intro">Provide Your App Icon</div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">
                        <form class="settings-form" method="POST" action="{{ route('admin.settings.app_icon.set') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="app_icon" class="form-label">App Icon</label>
                                <input type="file" class="form-control" id="app_icon" name="app_icon" required>
                                <img src="/img/{{ get_settings('app_icon') ?? '' }}"
                                    alt="{{ get_settings('app_icon') ?? '' }}" class="img-thumbnail w-25 mt-3 img-preview">
                            </div>
                            <button type="submit" class="btn app-btn-primary">Save Changes</button>
                        </form>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->
        <hr class="my-4">

        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">Meta Description</h3>
                <div class="section-intro">Provide Your Meta Descriptions.</div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">
                        <form class="settings-form" method="POST"
                            action="{{ route('admin.settings.meta_description.set') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description"
                                    value="{{ get_settings('meta_description') ?? '' }}" required>
                            </div>
                            <button type="submit" class="btn app-btn-primary">Save Changes</button>
                        </form>

                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->
        <hr class="my-4">

        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">Meta Tags</h3>
                <div class="section-intro">Provide Your Meta Tags</div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">
                        <form class="settings-form" method="POST" action="{{ route('admin.settings.meta_tags.set') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="meta_tags" class="form-label">Meta Tags <span class="text-warning">(Please
                                        write
                                        them as comma (,) separeted text)</span></label>
                                <input type="text" class="form-control" id="meta_tags" name="meta_tags"
                                    value="{{ get_settings('meta_tags') ?? '' }}" required>
                            </div>
                            <button type="submit" class="btn app-btn-primary">Save Changes</button>
                        </form>

                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->
        <hr class="my-4">

        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">WhatsApp Number</h3>
                <div class="section-intro">Provide Your Whats App Number</div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">
                        <form class="settings-form" method="POST" action="{{ route('admin.settings.whatsapp.set') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">Whats App Number</label>
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                    value="{{ get_settings('whatsapp_number') ?? '' }}" required>
                            </div>
                            <button type="submit" class="btn app-btn-primary">Save Changes</button>
                        </form>

                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->
        <hr class="my-4">
        <hr class="my-4">



        {{-- <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">Data &amp; Privacy</h3>
                <div class="section-intro">Settings section intro goes here. Morbi vehicula, est eget fermentum ornare.
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <form class="settings-form">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-1"
                                    checked>
                                <label class="form-check-label" for="settings-checkbox-1">
                                    Keep user app activity history
                                </label>
                            </div><!--//form-check-->
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-2"
                                    checked>
                                <label class="form-check-label" for="settings-checkbox-2">
                                    Keep user app preferences
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-3">
                                <label class="form-check-label" for="settings-checkbox-3">
                                    Keep user app search history
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-4">
                                <label class="form-check-label" for="settings-checkbox-4">
                                    Lorem ipsum dolor sit amet
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="settings-checkbox-5">
                                <label class="form-check-label" for="settings-checkbox-5">
                                    Aenean quis pharetra metus
                                </label>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn app-btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div><!--//row-->
        <hr class="my-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">Notifications</h3>
                <div class="section-intro">Settings section intro goes here. Duis velit massa, faucibus non hendrerit eget.
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <form class="settings-form">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="settings-switch-1" checked>
                                <label class="form-check-label" for="settings-switch-1">Project notifications</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="settings-switch-2">
                                <label class="form-check-label" for="settings-switch-2">Web browser push
                                    notifications</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="settings-switch-3" checked>
                                <label class="form-check-label" for="settings-switch-3">Mobile push notifications</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="settings-switch-4">
                                <label class="form-check-label" for="settings-switch-4">Lorem ipsum notifications</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="settings-switch-5">
                                <label class="form-check-label" for="settings-switch-5">Lorem ipsum notifications</label>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn app-btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div><!--//row-->
        <hr class="my-4"> --}}


    </div><!--//container-fluid-->
@endsection
