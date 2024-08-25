<!--Side Bar-->
@if(Route::is( 'home' ))
    <div class="col-md-3 ps-4 pe-4 mt-5">
@else
    <div class="col-md-3 ps-4 pe-4 mt-5 mt-md-0">
@endif
    <div class="row mb-5">
        <div class="card bg-primary text-bg-dark">
            <div class="card-body">
                <h5 class="card-title mb-4">Social Links</h5>
                <div class="row d-flex justify-content-between">
                    @foreach (App\Models\SocialLinks::all() as $link)
                        @if ($link->slug == 'facebook' && $link->isActive)
                            <div class="col-3 col-3 col-sm-3 col-md-4 col-lg-3 mb-3">
                                <a href="{{ $link->url }}" class="text-white" target="_blank">
                                    <i class="fab fa-facebook fa-2x"></i>
                                </a>
                            </div>
                        @endif

                        @if ($link->slug == 'twitter' && $link->isActive)
                            <div class="col-3 col-sm-3 col-md-4 col-lg-3 mb-3">
                                <a href="{{ $link->url }}" class="text-white" target="_blank">
                                    <i class="fab fa-twitter fa-2x"></i>
                                </a>
                            </div>
                        @endif

                        @if ($link->slug == 'instagram' && $link->isActive)
                            <div class="col-3 col-sm-3 col-md-4 col-lg-3 mb-3">
                                <a href="{{ $link->url }}" class="text-white" target="_blank">
                                    <i class="fab fa-instagram fa-2x"></i>
                                </a>
                            </div>
                        @endif

                        @if ($link->slug == 'linkedin' && $link->isActive)
                            <div class="col-3 col-sm-3 col-md-4 col-lg-3 mb-3">
                                <a href="{{ $link->url }}" class="text-white" target="_blank">
                                    <i class="fab fa-linkedin fa-2x"></i>
                                </a>
                            </div>
                        @endif

                        @if ($link->slug == 'youtube' && $link->isActive)
                            <div class="col-3 col-sm-3 col-md-4 col-lg-3 mb-3">
                                <a href="{{ $link->url }}" class="text-white" target="_blank">
                                    <i class="fab fa-youtube fa-2x"></i>
                                </a>
                            </div>
                        @endif

                        @if ($link->slug == 'discord' && $link->isActive)
                            <div class="col-3 col-sm-3 col-md-4 col-lg-3 mb-3">
                                <a href="{{ $link->url }}" class="text-white" target="_blank">
                                    <i class="fab fa-discord fa-2x"></i>
                                </a>
                            </div>
                        @endif

                        @if ($link->slug == 'github' && $link->isActive)
                            <div class="col-3 col-sm-3 col-md-4 col-lg-3 mb-3">
                                <a href="{{ $link->url }}" class="text-white" target="_blank">
                                    <i class="fab fa-github fa-2x"></i>
                                </a>
                            </div>
                        @endif

                        @if ($link->slug == 'google' && $link->isActive)
                            <div class="col-3 col-sm-3 col-md-4 col-lg-3 mb-3">
                                <a href="{{ $link->url }}" class="text-white" target="_blank">
                                    <i class="fab fa-google fa-2x"></i>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="card border border-primary border-2">
            <div class="card-body">
                <h5 class="card-title mb-4">Newsletter</h5>
                <form action="{{ route('subscriber.store') }}" method="POST">
                    @csrf
                    <div class="form-outline mb-3">
                        <i class="fas fa-envelope trailing"></i>
                        <input type="text" id="form1" name="email" class="form-control form-icon-trailing" />
                        <label class="form-label" for="form1">Email Address</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Subscribe Now</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="card border">
            <div class="card-body">
                <h5 class="card-title mb-4">Popular Posts</h5>
                {{-- <div class="d-flex flex-column">
                    @php
                        $popularPosts = App\Models\Blog::orderByDesc('views')
                        ->limit(5)
                        ->get();
                    @endphp
                    @foreach ($sidbarTags as $tag)
                        <a href="{{ route('blog.tag', ['tag' => $tag->slug]) }}" class="btn btn-rounded btn-success mb-2 me-2">#{{ $tag->name }}</a>
                    @endforeach

                </div> --}}
                @php
                    $popularPosts = App\Models\Blog::orderByDesc('views')
                    ->limit(5)
                    ->get();
                @endphp
                @foreach ($popularPosts as $post)
                <a href="{{ route('blog.show', ['blog' => $post->slug]) }}" class="text-decoration-none text-dark d-block mt-3">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="/img/{{ $post->image }}" class="img-fluid rounded-start" alt="{{ $post->title }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-0 ps-2">
                                    <p class="text-sm text-success">{{ $post->title }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                
                @endforeach
                
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="card border">
            <div class="card-body">
                <h5 class="card-title mb-4">Client list</h5>
                <div class="">
                    @php
                        $users = App\Models\User::select('country_name', DB::raw('COUNT(dial_code) as user_count'))
                            ->whereNotNull('dial_code')
                            ->groupBy('country_name')
                            ->orderByDesc('user_count')
                            ->take(10)
                            ->get();
                    @endphp

                    <table class="styled-table">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->country_name }}</td>
                            <td> {{ $user->user_count }}</td>
                        </tr>
                    @endforeach
                    </table>

                    <div class="text-center">
                        <a href="{{ route('user.allUsers') }}">
                            <button class="btn btn-lg btn-success">View All</button>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<!--Side Bar-->

 