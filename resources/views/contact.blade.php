@extends('layouts.app')

@section('title', 'Contact Us | ' . get_settings('app_name'))
@section('meta_title', get_settings('app_name'))
@section('meta_description', get_settings('meta_description'))
@section('meta_tags', get_settings('meta_tags'))


@section('section')
    <div class="col-md-9 pe-4">
        <h1>Contact Us</h1>
        <p>Thank you for your interest in Unlock PLC Expert. We value your feedback, inquiries, and suggestions.
            Here's how you can get in touch with us:
        </p>

        <h2>General Inquiries</h2>
        <p>For general questions or inquiries about our services, please email us at plcjournalweb@gmail.com. We
            strive to respond promptly to all messages and aim to provide you with the assistance you need.</p>

        <h2>Technical Support</h2>
        <p>
            If you require technical support or assistance regarding our services, our technical team is ready to help.
            Reach out to us at plcjournalweb@gmail.com, and we'll work to resolve your technical queries
            efficiently.
        </p>
        <h2>Visit Us</h2>
        <p><strong>[Unlock PLC Expert Headquarters]</strong></p>
        <address>
            440 North Wolfe Road, Sunnyvale, California, 94085, USA
        </address>

        <h2>Social Media</h2>
        <P>
            Connect with us on social media for updates, industry insights, and more:
        </P>
        @foreach (App\Models\SocialLinks::all() as $link)
            @if ($link->isActive)
                <p class="text-capitalize">
                    <i class="fa-brands fa-{{ $link->slug }}"></i> <a href="{{ $link->url }}" target="_blank">{{ $link->slug }}</a>
                </p>
            @endif
        @endforeach

        <p>We are dedicated to providing you with exceptional service and support. Your queries and messages are
            important to us, and we look forward to assisting you promptly.</p>

            <div class="container mt-5">
                <div class="row justify-content-center">
                  <div class="col-md-6">
                    <h2 class="mb-4">Contact Us</h2>
                    <form id="contactForm">
                      <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                      </div>
                      <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com">
                      </div>

                      <label for="ContactMobile" class="form-label">Mobile number</label>
                      <div class="mb-3 contact-mobile">
                        <div class="form-field-infix">
                            <input type="text" id="ContactMobile" name="mobile" value="" class="w-full"/>
                            <input type="hidden" id="dialcode" value="" name="dial_code" />
                            <input type="hidden" id="country_short_name" value="" name="country_short_name"/>
                            <input type="hidden" id="country_name" value=""  name="country_name"/>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                      </div>
                      <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Your message"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
                      <i class="fa-solid fa-spinner spin" id="spin_icon"></i>
                    </form>
                  </div>

                  <div class="col-md-6"> 
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6340.48545263003!2d-122.01766640984492!3d37.38409166260603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb63f2ae624d3%3A0x7699502b36939f6b!2s440%20N%20Wolfe%20Rd%2C%20Sunnyvale%2C%20CA%2094085!5e0!3m2!1sen!2sus!4v1717607072350!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
                </div>
              </div>

    </div>

@endsection


@section('custom_script')

    <!-- jquery js  -->
    <script type="text/javascript" src="/js/jquery-3.7.1.min.js"></script>


    <script type="text/javascript" src="/js/intlTelInput.min.js"></script>
    
<script>
  $(document).ready(function() {

      $('#spin_icon').hide();

      $('#contactForm').on('submit', function(event) {
          event.preventDefault(); // Prevent the form from submitting

          //console.log("contactForm::init");
          $('#submit_btn').prop('disabled', true);
          $('#spin_icon').show();
          
          // Validate fields
          let isValid = true;
          let errorMsg = '';
  
          // Validate Name
          const name = $('#name').val().trim();
          if (name === '') {
              isValid = false;
              errorMsg += 'Name is required.\n';
          }
  
          // Validate Email
          const email = $('#email').val().trim();
          const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
          if (email === '') {
              isValid = false;
              errorMsg += 'Email is required.\n';
          } else if (!emailPattern.test(email)) {
              isValid = false;
              errorMsg += 'Enter a valid email address.\n';
          }
  
          // Validate Mobile Number
          const mobile = $('#ContactMobile').val().trim();
          const mobilePattern = /^[0-9]+$/;
          if (mobile === '') {
              isValid = false;
              errorMsg += 'Mobile number is required.\n';
          } else if (!mobilePattern.test(mobile)) {
              isValid = false;
              errorMsg += 'Enter a valid mobile number.\n';
          }
  
          // Validate Subject
          const subject = $('#subject').val().trim();
          if (subject === '') {
              isValid = false;
              errorMsg += 'Subject is required.\n';
          }
  
          // Validate Message
          const message = $('#message').val().trim();
          if (message === '') {
              isValid = false;
              errorMsg += 'Message is required.\n';
          }
  
          // If form is valid, submit it
          if (isValid) {

                var dial_code = $("#dialcode").val();
                var country_short_name = $("#country_short_name").val();
                var country_name = $("#country_name").val();
                var token = $('input[name="_token"]').val(); 

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // For CSRF protection
                        'Authorization': 'Bearer ' + token // Include the token in the Authorization header
                    }
                });

                $.ajax({
                    url: "/api/support_ticket", // Replace with your API endpoint
                    method: "POST", // Use "POST", "PUT", "DELETE" etc., as needed
                    contentType: "application/json",
                    data: JSON.stringify({             // Stringify the data object into JSON format
                        name: name,
                        email: email,
                        mobile: mobile,
                        dial_code: dial_code,
                        country_short_name: country_short_name,
                        country_name: country_name,
                        subject: subject,
                        message: message
                    }),
                    success: function(response) {
                        // Handle the successful response from the API here
                        if(response.success === true){
                          $('#spin_icon').hide();
                          $('#submit_btn').prop('disabled', false);
                          $('#contactForm')[0].reset();
                          //console.log(response); 
                          alert('Your message submitted successfully!');
                        }
                    },
                    error: function(xhr, status, error) {
                      console.error(error); 
                      $('#spin_icon').hide();
                      $('#submit_btn').prop('disabled', false);
                      alert('Something went wrong!');
                    }
                });
              
              // Perform form submission logic here (e.g., AJAX request)
          } else {
              alert(errorMsg);
          }
      });
  });
  </script>


<script type="text/javascript">
    function sanitizeMobileNumber(mobileNumber) {
        return mobileNumber.replace(/[^\d]/g, '');
    }
    const input = document.querySelector("#ContactMobile");

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
        const mobileNumber = sanitizeMobileNumber(document.getElementById('ContactMobile').value);
        document.getElementById('ContactMobile').value = mobileNumber;
    })

</script>

@endsection

@section('schema')
    <script type="application/ld+json">
        {
            "@context" : "https://schema.org/",
            "@type" : "Article",
            "name" : "{{ env( 'APP_NAME' ) }}",
            "url" : "{{ env('APP_URL') }}",
            "logo" : "{{ env('APP_URL') . '/img/LOGO.png' }}"
        }
    </script>
@endsection