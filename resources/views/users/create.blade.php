@extends('dashboard.app')

@section('title')
    Add New User
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 92vh;">
    <div class="card shadow-lg p-4 rounded" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">Add New User</h2>
        {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert-danger">{{$error}}</div>
            @endforeach
        @endif --}}
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your Name">
                @error('name')
                <span style="color: red">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="email">Email Address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" >
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small><br>
                @error('email')
                <span style="color: red">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" >
                @error('password')
                <span style="color: red">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="confirm-password" placeholder="Re-enter your Password" >
                @error('password_confirmation')
                <span style="color: red">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-4">Create Account</button>
        </form>
    </div>
</div>
@endsection
