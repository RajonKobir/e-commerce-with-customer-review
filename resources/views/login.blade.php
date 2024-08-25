<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ get_settings('app_name') ." - Login" }}</title>
    <!-- MDB icon -->
    <link rel="icon" href="/img/{{ get_settings('app_icon') }}" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/css/intlTelInput.css">
    <!-- MDB -->
    <link rel="stylesheet" href="/css/mdb.min.css" />
    <!-- Custom Styels -->
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>

    @include('layouts.header')

    <div class="mt-5">&nbsp;</div>
    <div class="mt-5">&nbsp;</div>
    <!--Main layout-->
    <main class="mt-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <!-- Pills navs -->
                    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login"
                                role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register"
                                role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                        </li>
                    </ul>
                    <!-- Pills navs -->

                    <!-- Pills content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active pb-5 mb-5" id="pills-login" role="tabpanel"
                            aria-labelledby="tab-login">
                            <form action="{{ route('user.login.post') }}" method="POST">
                                @csrf
                                <!--
                                <div class="text-center mb-3">
                                    <p>Sign in with:</p>
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-google"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </button>

                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-github"></i>
                                    </button>
                                </div>

                                <p class="text-center">or:</p>
                                -->
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" id="loginName" name="email"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="loginName">Email</label>
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="loginPassword" name="password"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="loginPassword">Password</label>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                @if (Session::has('error'))
                                    <span class="text-danger">{{ Session::get('error') }}</span>
                                @endif
                                <!--
                                <div class="row mb-4">
                                    <div class="col-md-6 d-flex justify-content-center">
                                        <div class="form-check mb-3 mb-md-0">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="loginCheck" checked />
                                            <label class="form-check-label" for="loginCheck"> Remember me </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex justify-content-center">
                                        <a href="#!">Forgot password?</a>
                                    </div>
                                </div>
                                -->

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

                                <!-- Register buttons -->
                                {{-- <div class="text-center">
                                    <p>Not a member? <a href="#!">Register</a></p>
                                </div> --}}
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                            <form action="{{ route('user.register.post') }}" method="POST">
                                @csrf
                                <!-- Name input -->
                                <div class="form-field  mb-4">
                                    <div class="notched-outline">
                                        <div class="leading"></div>
                                        <div class="notch">
                                            <div class="label">Name</div>
                                        </div>
                                        <div class="trailing"></div>
                                    </div>
                                    <div class="form-field-infix">
                                        <input type="text" id="registerName" name="name" class="w-full"/>
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
                                        <input type="email" id="registerEmail" name="email" class="w-full"/>
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

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <!-- Password input -->
                                <div class="form-field  mb-4">
                                    <div class="notched-outline">
                                        <div class="leading"></div>
                                        <div class="notch">
                                            <div class="label">Password</div>
                                        </div>
                                        <div class="trailing"></div>
                                    </div>
                                    <div class="form-field-infix">
                                        <input type="password" id="registerPassword"  name="password" class="w-full"/>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <!-- Repeat Password input -->
                                {{-- <div class="form-outline mb-4">
                                    <input type="password" id="registerRepeatPassword" name="password_confirmation"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                                </div> --}}

                                <div class="form-field  mb-4">
                                    <div class="notched-outline">
                                        <div class="leading"></div>
                                        <div class="notch">
                                            <div class="label">Repeat password</div>
                                        </div>
                                        <div class="trailing"></div>
                                    </div>
                                    <div class="form-field-infix">
                                        <input type="password" id="registerRepeatPassword"  name="password_confirmation" class="w-full"/>
                                    </div>
                                </div>

                                <!-- Checkbox -->
                                {{-- <div class="form-check d-flex justify-content-center mb-4">
                                    <input class="form-check-input me-2" type="checkbox" value=""
                                        id="registerCheck" checked aria-describedby="registerCheckHelpText" />
                                    <label class="form-check-label" for="registerCheck">
                                        I have read and agree to the terms
                                    </label>
                                </div> --}}

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-lg btn-block mb-3">Signup</button>
                            </form>
                        </div>
                    </div>
                    <!-- Pills content -->
                </div>
            </div>
        </div>
    </main>

    @include('layouts.footer')


    <!-- MDB -->
    <script type="text/javascript" src="/js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>

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

    </script>

<script type="text/javascript" src="/js/scripts.js"></script>

</body>

</html>
