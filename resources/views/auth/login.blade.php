@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Judul Halaman -->
    <h2 class="text-center mb-4"><i class="fas fa-sign-in-alt"></i> Login</h2>
    
    <!-- Form Login -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 p-4">
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control" required placeholder="Enter your password">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
                    <p class="text-center mt-3">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    /* Card Styling */
    .card {
        border-radius: 10px;
    }

    /* Button Styling */
    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Input Group Styling */
    .input-group-text {
        background-color: #f1f1f1;
        border-right: 0;
    }

    .form-control {
        border-left: 0;
    }

    /* Styling untuk Placeholder */
    .form-control::placeholder {
        font-style: italic;
        color: #888;
    }
</style>
