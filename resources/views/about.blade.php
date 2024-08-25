@extends('layouts.app')

@section('title', 'About Us | ' . get_settings('app_name'))
@section('meta_title', get_settings('app_name'))
@section('meta_description', get_settings('meta_description'))
@section('meta_tags', get_settings('meta_tags'))


@section('section')
    <div class="col-md-9 pe-4">
        <h1>About Us</h1>
        <p>At Unlock PLC Expert, we're driven by a passion for unlocking the potential of Programmable Logic
            Controllers (PLCs) and empowering industries through innovative solutions.</p>
        <h2>Our Story</h2>
        <p>Founded by a team of industry experts with over two decades of combined experience, Unlock PLC
            Expert emerged from a shared vision: to revolutionize how businesses harness the power of PLC
            technology. Our journey began with a mission to simplify complex automation processes, making them
            accessible and efficient for enterprises of all sizes.</p>
        <h2>What We Do</h2>
        <p>At Unlock PLC Expert, we specialize in providing cutting-edge solutions and expert guidance in PLC
            programming, troubleshooting, and optimization. Our team comprises skilled engineers, dedicated to
            delivering tailored strategies and hands-on support to elevate your automation projects.</p>
        <h2>Our Mission</h2>
        <p>We are committed to being the catalyst for transformative change in the automation industry. Through
            our expertise, innovative approaches, and unwavering dedication, we aim to empower businesses to
            achieve operational excellence, efficiency, and unparalleled success in their automation endeavors.</p>
        <h2>Why Choose Us? </h2>
        <p>
            Expertise: Our team consists of seasoned professionals with a proven track record in PLC technologies.
            Tailored Solutions: We understand that every business is unique. That's why we offer customized
            strategies to meet your specific automation needs.
            Customer-Centric Approach: Your success is our priority. We strive to build lasting partnerships by
            providing exceptional service and support.
        </p>
        <h2>Join Us in the Automation Revolution</h2>
        <p>
            Whether you're venturing into automation for the first time or seeking to optimize existing systems,
            Unlock PLC Expert is your trusted partner. We're committed to guiding you towards achieving
            operational excellence and unlocking the full potential of your automation projects.
        </p>
        <h2>Connect with Us</h2>
        <p><a href="/contact-us">Contact us</a></p>
        <p>Let's embark on this journey together and redefine the future of automation.</p>
    </div>

@endsection
@section('schema')
    <script type="application/ld+json">
       {
        "@context":"https://schema.org/",
        "@type":"Article",
        "name":"{{ env( 'APP_NAME' ) }}",
        "url":"{{ env('APP_URL') }}",
        "logo":"{{ env('APP_URL') . '/img/LOGO.png' }}"
       }
    </script>
@endsection