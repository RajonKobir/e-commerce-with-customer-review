    <!-- Footer -->
    <footer class="bg-dark text-center text-white mt-5">
        <!-- Grid container -->
        <div class="container p-4">
            
            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fas fa-gem me-3 text-secondary"></i>{{ get_settings('app_name') }}
                            </h6>
                            <p>
                                {{ get_settings('meta_description') }}
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-5 col-lg-5 col-xl-6 mx-auto mb-4">
                           
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                            <p><i class="fas fa-home me-3 text-secondary"></i> 440 North Wolfe Road, Sunnyvale, California, 94085, USA</p>
                            <div class="row">
                                @foreach (App\Models\SocialLinks::all() as $link)
                                    {{-- @if ($link->isActive)
                                        <p class="text-capitalize"><a href="{{ $link->url }}">{{ $link->slug }}</a></p>
                                    @endif --}}
                                    @if ($link->slug == 'facebook' && $link->isActive)
                                        <div class="col-3 mb-3">
                                            <a href="{{ $link->url }}" class="text-white" target="_blank">
                                                <i class="fab fa-facebook fa-2x"></i>
                                            </a>
                                        </div>
                                    @endif
    
                                    @if ($link->slug == 'twitter' && $link->isActive)
                                        <div class="col-3 mb-3">
                                            <a href="{{ $link->url }}" class="text-white" target="_blank">
                                                <i class="fab fa-twitter fa-2x"></i>
                                            </a>
                                        </div>
                                    @endif
    
                                    @if ($link->slug == 'instagram' && $link->isActive)
                                        <div class="col-3 mb-3">
                                            <a href="{{ $link->url }}" class="text-white" target="_blank">
                                                <i class="fab fa-instagram fa-2x"></i>
                                            </a>
                                        </div>
                                    @endif
    
                                    @if ($link->slug == 'linkedin' && $link->isActive)
                                        <div class="col-3 mb-3">
                                            <a href="{{ $link->url }}" class="text-white" target="_blank">
                                                <i class="fab fa-linkedin fa-2x"></i>
                                            </a>
                                        </div>
                                    @endif
    
                                    @if ($link->slug == 'youtube' && $link->isActive)
                                        <div class="col-3 mb-3">
                                            <a href="{{ $link->url }}" class="text-white" target="_blank">
                                                <i class="fab fa-youtube fa-2x"></i>
                                            </a>
                                        </div>
                                    @endif
    
                                    @if ($link->slug == 'discord' && $link->isActive)
                                        <div class="col-3 mb-3">
                                            <a href="{{ $link->url }}" class="text-white" target="_blank">
                                                <i class="fab fa-discord fa-2x"></i>
                                            </a>
                                        </div>
                                    @endif
    
                                    @if ($link->slug == 'github' && $link->isActive)
                                        <div class="col-3 mb-3">
                                            <a href="{{ $link->url }}" class="text-white" target="_blank">
                                                <i class="fab fa-github fa-2x"></i>
                                            </a>
                                        </div>
                                    @endif
    
                                    @if ($link->slug == 'google' && $link->isActive)
                                        <div class="col-3 mb-3">
                                            <a href="{{ $link->url }}" class="text-white" target="_blank">
                                                <i class="fab fa-google fa-2x"></i>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->


        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            <div class="row d-flex  justify-content-around">
                <div class="col-md-6 text-center">
                    <a href="{{ route('aboutPage') }}" class="text-reset text-decoration-underline">About Us</a> |
                    <a href="{{ route('contactPage') }}" class="text-reset text-decoration-underline">Contact Us</a> |
                    <a href="{{ route('privacyPage') }}" class="text-reset text-decoration-underline">Privacy Policy</a> |
                    <a href="{{ route('termsPage') }}" class="text-reset text-decoration-underline">Terms & Conditions</a>
                </div>
            </div>
            © {{ date("Y"); }} Copyright:
            <a class="text-white" href="{{ $_SERVER['HTTP_HOST']; }}">Unlockplcexpert.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
