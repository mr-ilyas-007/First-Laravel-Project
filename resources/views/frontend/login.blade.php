@extends('frontend.layout.app')

@section('title')
    Login Page
@endsection

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow-lg" style="width: 350px;"> <!-- Increased the width to 500px -->
            <div class="card-body">
                <h2 class="card-title text-center">Login</h2>

                <!-- Form Starts Here -->
                <form method="post" action="/loged-in">
                    @csrf
                    @foreach ($fields as $field)
                        <div class="form-group mt-3">
                            <label for='{{ $field['name'] }}'>{{ $field['label'] }}</label>
                            <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" class="form-control"
                                id="{{ $field['name'] }}" placeholder="{{ $field['label'] }}"
                                value="{{ old($field['name']) }}">
                            @if ($field['name'] === 'email')
                                <small id="emailHelp" class="form-text text-muted">
                                    We'll never share your {{ $field['name'] }} with anyone else.
                                </small>
                            @endif

                        </div>
                    @endforeach
                    {{-- <div class="form-group mt-3">
                        <label for='email'>Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email"
                            value="{{ old('email') }}">
                        <small id="emailHelp" class="form-text text-muted">
                            We'll never share your email with anyone else.
                        </small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password">
                    </div> --}}

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="/register" class="text-decoration-none">Create Account</a>
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
