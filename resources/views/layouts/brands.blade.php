<!-- owl carousel css  -->
<link rel="stylesheet" href="/css/owl.carousel.min.css">

<!-- jquery js  -->
<script type="text/javascript" src="/js/jquery-3.7.1.min.js"></script>

<!-- owl carousel js  -->
<script type="text/javascript" src="/js/owl.carousel.min.js"></script>



<div class="col-12 rounded">
    <h2 class="text-center">OUR BRANDS:</h2>
    <div class="slider">
        <!-- <div class="logos">
            @php
                $brands = App\Models\Brand::all();
            @endphp
            @foreach ($brands as $brand)
                <img src="/img/{{ $brand->image }}" alt="{{ $brand->title }}" class="img img-fluid" >
            @endforeach
        </div>
        <div class="logos d-none">
            @foreach ($brands as $brand)
                <img src="/img/{{ $brand->image }}" alt="{{ $brand->title }}" class="img img-fluid" style="width:calc(100%/{{$brands->count()}})" >
            @endforeach
        </div> -->

    
    @php
        $brands = App\Models\Brand::all();
    @endphp

    <div class="owl-carousel owl-theme">
        @foreach ($brands as $brand)
            <div class="item">
                <img src="/img/{{ $brand->image }}" alt="{{ $brand->title }}" class="img img-fluid" >
            </div>
        @endforeach
    </div>



    </div>
</div>



<script>
    // brands homepage carousel
    $('.owl-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        slideTransition: 'linear',
        autoplayTimeout: 3000,
        autoplaySpeed: 3000,
        dots: false,
        margin: 10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });
</script>