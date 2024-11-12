@extends('dashboard.app')

@section('title')
    @if (Auth::user()->is_admin == 1)
        Admin profile Page
    @endif
    User Profile Page
@endsection

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 92.3vh;">
        <div class="card w-100" style="max-width: 400px;">
            <div class="card-header text-center">
                <h4>Profile</h4>
            </div>
            <div class="card-body shadow-lg">
                <p class="text-center">Manage your profile information here.</p>


                @if (Auth::user()->is_admin == 1)
                    <form method="POST" action="/admin/profileUpdate/{{ $user->id }}">
                @else
                    <form method="POST" action="/profileUpdate/{{ $user->id }}">
                @endif
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                        required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Update Profile</button>
                </form>
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

            </div>
            <div class="card-footer text-center">
                <a href="/admin/dashboard" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>
@endsection
