@extends('layouts.app')

@section('content')



<div class="container py-5" style="background: linear-gradient(135deg, #f0f4f7, #e8f0fe); min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 animate__animated animate__fadeInDown">

                <div class="card-header text-center bg-white">
                    <h4><i class="fas fa-sign-in-alt text-primary"></i> Welcome Back</h4>
                    <p class="text-muted">Login to continue your wellness journey</p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input id="email" type="email" class="form-control" name="email" required autofocus>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <p class="text-center text-muted mb-2" style="font-size: 0.9rem;">Let’s get you back on track!</p>

                            <button type="submit" class="btn text-white w-100"
                            style="background: linear-gradient(90deg, #667eea, #764ba2); border: none;">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                        
                        </div>

                        <div class="mt-3 text-center">
                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
