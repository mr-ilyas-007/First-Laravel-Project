@extends('dashboard.app')

@section('title')
    User Profile
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 92vh;">
    <div class="card shadow-lg p-4 rounded" style="width: 100%; max-width: 500px;">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <h2 class="text-center mb-4">User Profile</h2>
        <p class="text-center">Manage User profile information here.</p>

        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-4">Update User</button>
            <a href="/admin/dashboard" class="btn btn-secondary btn-block mt-2">Back</a>
        </form>
    </div>
</div>
@endsection
