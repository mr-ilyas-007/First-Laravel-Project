@extends('frontend.layout.app')

@section('title')
    Register Page
@endsection

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow-lg" style="width: 350px;"> <!-- Adjusted width for consistency -->
            <div class="card-body">
                <h2 class="card-title text-center">Register</h2>

                <!-- Form Starts Here -->
                <form method="POST" action="/registerSave">
                    @csrf

                    <div class="form-group mt-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Enter your Name" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="confirm-password"
                            placeholder="Re-enter your Password" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <a href="/login" class="text-decoration-none">Already Have An Account</a>
                    </div>
                </form>

                <!-- Error Message Display -->
                @error('email')
                    <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </div>
        </div>
    </div>
@endsection
