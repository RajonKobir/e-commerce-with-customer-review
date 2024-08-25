@extends('layouts.app')

@section('title', 'Term and condictions | ' . get_settings('app_name'))
@section('meta_title', get_settings('app_name'))
@section('meta_description', get_settings('meta_description'))
@section('meta_tags', get_settings('meta_tags'))


@section('section')
    <div class="col-md-9 pe-4">
        <h1>Terms and Conditions</h1>

        <p>Welcome to Unlock PLC Expert! These terms and conditions outline the rules and regulations for the use of our
            website located at <a href="{{ env('APP_URL') }}">the Unlock PLC</a>.</p>

        <p>By accessing this website, we assume you accept these terms and conditions in full. Do not continue to use Unlock
            PLC Expert's website if you do not accept all of the terms and conditions stated on this page.</p>

        <h2>Intellectual Property</h2>

        <p>Unless otherwise stated, Unlock PLC Expert and/or its licensors own the intellectual property rights for all
            material on this website. All intellectual property rights are reserved.</p>

        <h2>Content</h2>

        <p>Users may contribute content to our website, such as comments or forum posts. By contributing content, you grant
            Unlock PLC Expert a non-exclusive, worldwide, royalty-free, perpetual, and transferable license to use,
            reproduce, modify, adapt, publish, translate, distribute, and display such content.</p>

        <h2>User Conduct</h2>

        <p>When using our Service, you agree to abide by all applicable laws and regulations. You must not:</p>

        <ul>
            <li>Violate any laws, including but not limited to copyright laws</li>
            <li>Transmit any harmful or malicious content</li>
            <li>Attempt to gain unauthorized access to our systems or networks</li>
        </ul>

        <h2>Limitation of Liability</h2>

        <p>Unlock PLC Expert, its directors, employees, partners, agents, suppliers, or affiliates shall not be liable for
            any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of
            profits, data, use, goodwill, or other intangible losses resulting from:</p>

        <ul>
            <li>Your access to or use of or inability to access or use the Service</li>
            <li>Any conduct or content of any third party on the Service</li>
            <li>Any content obtained from the Service</li>
        </ul>

        <h2>Changes</h2>

        <p>We reserve the right to modify or replace these terms and conditions at any time. Your continued use of the
            Service after any such changes constitutes your acceptance of the new terms and conditions.</p>

        <h2>Termination</h2>

        <p>We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason
            whatsoever, including without limitation if you breach these terms and conditions.</p>

        <h2>Governing Law</h2>

        <p>These terms and conditions are governed by and construed in accordance with the laws of United States, and you
            irrevocably submit to the exclusive jurisdiction of the courts in that location.</p>

        <h3>Contact Us</h3>

        <p>If you have any questions about these terms and conditions, please contact us at <a
                href="mailto:plcjournalweb@gmail.com">plcjournalweb@gmail.com</a>.</p>


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