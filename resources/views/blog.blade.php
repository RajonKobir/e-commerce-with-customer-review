@extends('layouts.app')

@section('title', $blog->title . ' | ' . get_settings('app_name'))
@section('meta_title', $blog->meta_title)
@section('meta_description', $blog->meta_description)
@section('meta_tags', get_settings('meta_tags'))



@section('section')


    <style>
        #app .progress{
            height: 30px;
            font-size: 16px;
            font-weight: bold;
        }
        .review_top h1{
            font-family: Rubik, sans-serif;
            font-size: 30px;
            color: #000;
            font-weight: 600;
            text-align: center;
            margin-bottom: 18px !important;
        }
        .vue-star-rating-rating-text{
            font-size: calc(1.275rem + .3vw);
            font-weight: bolder;
        }
        .review-btn button {
            background-color: #70c332;
            font-weight: 400;
            font-size: 17px;
            font-style: normal;
            border: 1px solid transparent;
            outline: none;
            padding: 10px 15px;
            width: 15%;
            text-align: center;
            color: #fff;
            border-radius: 5px;
        }
        .user-review {
            display: block;
            margin-bottom: 30px;
            padding: 45px;
            border-radius: 8px;
            background: #f5f5f5;
            border: 1px solid #e8e8e8;
            box-sizing: border-box;
        }
        .main-review {
            display: block;
            width: 100%;
        }
        .user-data {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 15px;
            margin-bottom: 15px;
        }
        .user-img {
            display: block;
        }
        .user-img.user-img-rev img {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            border: 2px solid #70c332;
            object-fit: cover;
            padding: 0;
        }
        .user-name {
            display: block;
            width: 100%;
        }
        .user-review-data p {
            color: #555;
            font-family: Rubik,sans-serif;
            font-weight: 400;
            font-size: 17px;
            line-height: 25px;
            display: block;
            margin-bottom: 28px !important;
            margin-top: 18px !important;
        }
    </style>

    <!-- bootstrap css  -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <!--Card Sections-->
    <div class="col-md-9 pe-4">
        <div class="row mb-5">
            <img src="/img/{{ $blog->image }}" alt="{{ $blog->title }}" class="img-fluid">
        </div>
        <div class="row mb-5">
            <div class="col-12 mb-5">
                <div class="row">
                    <h1 class="mb-4">{{ $blog->title }}</h1>
                </div>
                <div class="row">
                    <div class="col-8">
                        <a href="{{ route('blog.subs', ['subcategory' =>  $blog->sub_category->slug]) }}" class="text-info d-block mb-3">
                            <i class="fas fa-list"></i>
                            {{ $blog->sub_category->name }}
                        </a>
                        @foreach ($blog->tags as $tag)
                            <span class="badge btn bg-primary me-2 mb-2">#{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <div class="col-4 text-end">
                        <u> {{ date('d.m.y', strtotime($blog->updated_at)) }}</u>
                    </div>
                </div>
            </div>
            <div class="col-12">
                {!! $blog->body !!}
            </div>

        </div>

        @if ( $blog->download_link != '') 
        <div class="row">
            <div class="col text-center">
                <button type="button" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#downloadModal">
                    Download Now
                </button>
            </div>
        </div>
        @endif

         <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="downloadModal">Download link</h1>
                  <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-field  mb-4">
                            <div class="notched-outline">
                                <div class="leading"></div>
                                <div class="notch">
                                    <div class="label">Name</div>
                                </div>
                                <div class="trailing"></div>
                            </div>
                            <div class="form-field-infix">
                                <input type="text" id="name" name="name" class="w-full"/>
                            </div>
                        </div>

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <!-- Email input -->
                        <div class="form-field  mb-4">
                            <div class="notched-outline">
                                <div class="leading"></div>
                                <div class="notch">
                                    <div class="label">Email</div>
                                </div>
                                <div class="trailing"></div>
                            </div>
                            <div class="form-field-infix">
                                <input type="email" id="email" name="email" class="w-full"/>
                            </div>
                        </div>

                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <!-- mobile input -->
                        <div class="form-field  mb-4">
                            <div class="notched-outline">
                                <div class="leading"></div>
                                <div class="notch">
                                    <div class="label">Mobile number</div>
                                </div>
                                <div class="trailing"></div>
                            </div>
                            <div class="form-field-infix">
                                <input type="text" id="registerMobile" name="mobile" class="w-full" maxlength="11" />
                                <input type="hidden" id="dialcode" value="" name="dial_code" />
                                <input type="hidden" id="country_short_name" value="" name="country_short_name"/>
                                <input type="hidden" id="country_name" value=""  name="country_name"/>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-primary" onclick=submitForm()>Get Download link</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>



        <!-- vue app starts here  -->
        <div id="app">

            <div class="review_box mt-5 mb-5">
                <div class="review_top mb-5">
                    <h1 class="text-center">Customer Reviews ({{ $total_reviews }})</h1>
                    <div class="d-flex justify-content-center">
                        <star-rating :rating="{{ $average_rating }}" :increment="0.01" :max-rating="5" :fixed-points="2" :star-size="40" :read-only="true" text-class="justify-content-center"></star-rating>
                    </div>
                </div>

                <div class="review_body">

                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <h5 class="font-weight-bold">Excellent</h5>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9">
                            <div class="progress mb-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $all_percentages['excellent_percentage'] }}%" aria-valuenow="{{ $all_percentages['excellent_percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $all_percentages['excellent_percentage'] }}%</div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <h5 class="font-weight-bold">Good</h5>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9">
                            <div class="progress mb-1">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $all_percentages['good_percentage'] }}%" aria-valuenow="{{ $all_percentages['good_percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $all_percentages['good_percentage'] }}%</div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <h5 class="font-weight-bold">Average</h5>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9">
                            <div class="progress mb-1">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $all_percentages['average_percentage'] }}%" aria-valuenow="{{ $all_percentages['average_percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $all_percentages['average_percentage'] }}%</div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <h5 class="font-weight-bold">Below Average</h5>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9">
                            <div class="progress mb-1">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $all_percentages['below_average_percentage'] }}%" aria-valuenow="{{ $all_percentages['below_average_percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $all_percentages['below_average_percentage'] }}%</div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <h5 class="font-weight-bold">Poor</h5>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9">
                            <div class="progress mb-1">
                                <div class="progress-bar bg-dark" role="progressbar" style="width: {{ $all_percentages['poor_percentage'] }}%" aria-valuenow="{{ $all_percentages['poor_percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $all_percentages['poor_percentage'] }}%</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- review_box ends here  -->


            @if(auth()->check())
                <div class="write_review_section mt-5 mb-5 text-center">
                    <button id="writeReviewButton" type="button" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#writeReviewModal">Write a Review</button>
                    @include('layouts.review_form')
                </div>
                </div>
                </div>
            @else
                <div class="write_review_section mt-5 mb-5 text-center">
                    <a id="writeReviewButton" href="/login" ><button type="button" class="btn btn-success">Write a Review</button></a>
                </div>
            @endif


            <div id="notification_area">
                
            </div>


            @foreach ($reviews as $review_key => $review)
                <div class="user-review">
                    <div class="main-review">
                        <div class="user-data">
                            <div class="user-img user-img-rev">
                                <img  alt="User Profile" src="{{ asset('img/user_low.png'); }}">
                            </div>
                            <div class="user-name">
                                <a>{{ $review->user_name }}</a>
                                <div class="user-review-rating">
                                    <star-rating :rating="{{ $review->rating }}" :increment="0.01" :max-rating="5" :fixed-points="2" :star-size="30" :read-only="true" text-class="justify-content-center"></star-rating>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="user-review-data">
                        <h5 class="font-weight-bold">{{ $review->title }}</h5>
                        <p>{{ $review->description }}</p>
                    </div>
                </div>
            @endforeach


            <div class="mt-4 d-flex justify-content-center">
                {{ $reviews->links() }}
            </div>


        </div>
        <!-- id="app" vue app ends here  -->


    </div>
    <!--Card Sections-->
@endsection


@section('custom_script')

    <!-- vue js codes -->
    @vite([ 'resources/js/app.js' ])

    <!-- jquery js  -->
    <script type="text/javascript" src="/js/jquery-3.7.1.min.js"></script>
    <!-- intlTelInput js  -->
    <script type="text/javascript" src="/js/intlTelInput.min.js"></script>

    
<script type="text/javascript">

    function sanitizeMobileNumber(mobileNumber) {
        return mobileNumber.replace(/[^\d]/g, '');
    }
    const input = document.querySelector("#registerMobile");

    const iti = window.intlTelInput(input, {
        utilsScript: "/js/utils.js",
        initialCountry: "auto",
        separateDialCode: true,
        geoIpLookup: callback => {
            fetch("https://ipapi.co/json")
            .then(res => res.json())
            .then(data => callback(data.country_code))
            .catch(() => callback("us"));
        },
    });

    input.addEventListener('countrychange', () => {
        const countryInfo = iti.getSelectedCountryData();
        document.getElementById('dialcode').value = countryInfo.dialCode;
        document.getElementById('country_short_name').value = countryInfo.iso2;
        document.getElementById('country_name').value = countryInfo.name;
    });
    input.addEventListener('change', () => {
        const mobileNumber = sanitizeMobileNumber(document.getElementById('registerMobile').value);
        document.getElementById('registerMobile').value = mobileNumber;
    })

    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    function hideModal() {
        var modalElement = document.getElementById('downloadModal');
        var modalInstance = mdb.Modal.getInstance(modalElement);
        modalInstance.hide();
    }

    
    function submitForm(){
            var name = $("#name").val();
            var email = $("#email").val();
            var mobile = $("#registerMobile").val();
            var dial_code = $("#dialcode").val();
            var country_short_name = $("#country_short_name").val();
            var country_name = $("#country_name").val();
            var token = $('input[name="_token"]').val(); 

            var isValid = true;
            if (name.trim() === '' || email.trim() === '' || mobile.trim() === '' || dial_code.trim() === '' || country_short_name.trim() === '' || country_name.trim() === '') {
                isValid = false;
                alert('Please fill in all fields.'); 
            } else if (!validateEmail(email)) {  // Function to validate email format (see below)
                isValid = false;
                alert('Please enter a valid email address.'); 
            }

            // If validation fails, stop the submission
            if (!isValid) {
                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // For CSRF protection
                    'Authorization': 'Bearer ' + token // Include the token in the Authorization header
                }
            });

            $.ajax({
                url: "/api/get_download_link", // Replace with your API endpoint
                method: "POST", // Use "POST", "PUT", "DELETE" etc., as needed
                contentType: "application/json",
                data: JSON.stringify({             // Stringify the data object into JSON format
                    name: name,
                    email: email,
                    mobile: mobile,
                    dial_code: dial_code,
                    country_short_name: country_short_name,
                    country_name: country_name
                }),
                success: function(response) {
                    // Handle the successful response from the API here
                    console.log(response); 
                    if(response.success === true){
                        hideModal()
                        window.open("https://api.whatsapp.com/send?phone=8801758432841", "_blank");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error); 
                }
            });
        }
</script>



@endsection





@section('schema')
    <script type="application/ld+json">
        {
            "@context":"https://schema.org/",
            "@type":"Article",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "{{ route('blog.show', ['blog' => $blog->slug]) }}"
            },
            "title":"{{ $blog->title }}",
            "image":"{{ env( 'APP_URL' ) . '/img/' .  $blog->image }}",
            "datePublished":"{{ $blog->created_at }}"
        }
    </script>
@endsection