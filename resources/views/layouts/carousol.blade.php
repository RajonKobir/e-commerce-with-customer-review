<div class="col-12">
    <!-- Carousol Section -->
    <section>
        <!-- Carousel wrapper -->
        <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
            {{-- <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="2"
                    aria-label="Slide 3"></button>
            </div> --}}

            <!-- Inner -->
            <div class="carousel-inner">
                @php
                    $sliders=App\Models\Slider::all();
                @endphp
                @foreach ($sliders as $key=>$slider)
                    <!-- Single item -->
                    <div class="carousel-item {{ $key==0 ?  'active' : '' }} ">
                        <img src="/img/{{ $slider->image }}" class="d-block w-100"
                            alt="{{ $slider->title }}" />
                        <div class="carousel-caption d-none d-md-block">
                            {{-- <h5>First slide label</h5>
                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> --}}
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Inner -->

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample"
                data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample"
                data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Carousel wrapper -->
    </section>
    <!-- Carousol Section -->

    <section id="clients" class="clients section-bg">
        <div class="container d-md-block">
            <div class="row">
            <div class="col-lg-4 col-md-4 col-4 align-items-center justify-content-center">
            <div><img src="{{ asset('img/icon-professional2.png'); }}" class="img-fluid" alt><h5>PROFESSIONAL</h5>
            <h6>Engineer Consultation Team<h6></div>
            </div>
            <div class="col-lg-4 col-md-4 col-4 d-flex align-items-center justify-content-center">
            <div><img src="{{ asset('img/icon-skillfull2.png'); }}" class="img-fluid" alt><h5>SKILLFULL</h5>
            <h6>Installation Team<h6></div>
            </div>
            <div class="col-lg-4 col-md-4 col-4 d-flex align-items-center justify-content-center">
            <div><img src="{{asset('img/icon-high-experence4.png');}}" class="img-fluid" alt><h5>HIGH EXPERIENCE</h5>
            <h6>After-Sale Service and Maintenance Team<h6></div>
            </div>
            </div>
        </div>
    </section>
</div>
