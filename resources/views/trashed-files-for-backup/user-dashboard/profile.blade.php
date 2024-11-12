@extends('user-dashboard.app')

@section('title')
Profile Page
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card w-100 shadow-lg" style="max-width: 400px;">
        <div class="card-header text-center">
            <h4>Profile</h4>
        </div>
        <div class="card-body">
            <p class="text-center">Manage your profile information here.</p>

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form method="POST" action="profileUpdate/{{ Auth::id() }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ Auth::user()->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ Auth::user()->email }}" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Update Profile</button>
            </form>
        </div>
        <div class="card-footer text-center">
            <a href="/dashboard" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
</div>
@endsection
