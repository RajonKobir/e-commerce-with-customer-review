@extends('backend.layouts.app')

@section('content')
    <div class="container-xl">

        <h1 class="app-page-title">Reset Password</h1>
        <div class="card">
            <div class="card-body">
                <h2>Hello, {{ $admin->name }}</h2>
                <p>Are You Sure You want to reset your password?</p>
                <p>If YES, please click the button below.</p>
                <p>Your new password will be sent to </p>
                <form action="{{ route('admin.updatePassword') }}" method="POST" id="passwordResetForm">
                    @csrf
                    <a href="javascript:{}" class="btn btn-danger" onclick="document.getElementById('passwordResetForm').submit(); return false;">
                        Reset Password
                    </a>
                </form>
                
            </div>
        </div>

    </div><!--//container-fluid-->
@endsection
