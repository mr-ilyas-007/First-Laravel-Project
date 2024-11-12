@extends('dashboard.app')

@section('title')
    @if (Auth::user()->is_admin == 1)
        Admin Dashboard Home
    @endif
    User Dashboard home
@endsection

@section('content')
    <div class="container">
        <h1 class="mt-4">Home</h1>
        <p>Welcome to dashboard home page!</p>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Recent Activities</h5>
                <p class="card-text">Here you will see the Latest Activities</p>
            </div>
        </div>
        @if (Auth::user()->is_admin == 1)
            <a href="/admin/dashboard" class="mt-3">Back to Dashboard</a>
        @else
            <a href="/dashboard" class="mt-3">Back to Dashboard</a>
        @endif


    </div>
@endsection
