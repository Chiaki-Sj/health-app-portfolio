@extends('layouts.app')

@section('content')
<div class="container py-5" style="background: linear-gradient(135deg, #f9fbfc, #eaf3f8); min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header text-center text-white"
                    style="background: linear-gradient(90deg, #667eea, #764ba2); border-bottom: none;">
                    <h4><i class="fas fa-user-plus text-white me-2"></i> Create Your Account</h4>
                    <p class="text-white-50">Join us on your wellness journey</p>
                </div>


                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" class="form-control" name="name" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn text-white w-100"
                            style="background: linear-gradient(90deg, #667eea, #764ba2); border: none;">
                            <i class="fas fa-sign-in-alt" style="color: #764ba2;"></i> Register

                        </button>

                        </div>

                        <div class="mt-3 text-center">
                            <a href="{{ route('login') }}">Already have an account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
