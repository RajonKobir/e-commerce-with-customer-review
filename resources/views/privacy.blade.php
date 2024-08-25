@extends('layouts.app')

@section('title', 'Privacy | ' . get_settings('app_name'))
@section('meta_title', get_settings('app_name'))
@section('meta_description', get_settings('meta_description'))
@section('meta_tags', get_settings('meta_tags'))


@section('section')
    <div class="col-md-9 pe-4">
        <h1>Privacy Policy</h1>

        <p>This Privacy Policy describes how Unlock PLC Expert collects, uses, and discloses information when you visit or
            use our website <a href="{{ env('APP_URL') }}">the Unlock PLC</a>.</p>

        <h2>GDPR Compliance</h2>

        <p>We are committed to complying with the General Data Protection Regulation (GDPR). If you are a resident of the
            European Economic Area (EEA), you have the following rights:</p>

        <ul>
            <li>Access your personal data</li>
            <li>Rectify inaccuracies in your personal data</li>
            <li>Erase your personal data</li>
            <li>Restrict or object to the processing of your personal data</li>
            <li>Data portability</li>
        </ul>

        <h2>Information Collection and Use</h2>

        <p>We may collect personal information that you provide directly to us when you use our Service. This information
            may include:</p>

        <ul>
            <li>Contact information (such as name, email address, phone number)</li>
            <li>User profile information</li>
            <li>Communications and correspondence exchanged with us</li>
        </ul>

        <h2>Use of Information</h2>

        <p>We use the collected information for various purposes, including:</p>

        <ul>
            <li>Providing, maintaining, and improving our Service</li>
            <li>Responding to inquiries and customer support</li>
            <li>Sending newsletters, updates, and promotional content</li>
            <li>Analyzing usage trends and preferences</li>
        </ul>

        <h2>CCPA Compliance</h2>

        <p>We are committed to complying with the California Consumer Privacy Act (CCPA). If you are a California resident,
            you have the following rights:</p>

        <ul>
            <li>The right to know about personal information we collect and disclose</li>
            <li>The right to request the deletion of your personal information</li>
            <li>The right to opt-out of the sale of your personal information</li>
            <li>The right to non-discrimination</li>
        </ul>

        <h2>Data Security</h2>

        <p>We prioritize the security of your information and employ industry-standard measures to protect against
            unauthorized access, alteration, disclosure, or destruction of data.</p>

        <h2>Third-Party Services</h2>

        <p>We may use third-party services that have their own privacy policies governing the use of your information. We
            encourage you to review the privacy policies of these third-party services.</p>

        <h2>Cookies</h2>

        <p>We use cookies and similar tracking technologies to enhance your browsing experience on our website. You can
            choose to disable cookies through your browser settings, although this may affect some functionalities of the
            Service.</p>

        <h2>Children's Privacy</h2>

        <p>Our Service is not intended for individuals under the age of 18. We do not knowingly collect personal information
            from children. If you are a parent or guardian and believe that your child has provided us with personal
            information, please contact us to have it removed.</p>

        <h2>Changes to This Privacy Policy</h2>

        <p>We reserve the right to update our Privacy Policy periodically. Any changes will be posted on this page with a
            revised effective date. We encourage you to review this Privacy Policy regularly for any updates.</p>

        <h3>Contact Us</h3>

        <p>If you have any questions or concerns about our Privacy Policy or the handling of your personal information,
            please contact us at <a href="mailto:plcjournalweb@gmail.com">plcjournalweb@gmail.com</a>.</p>


    </div>

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