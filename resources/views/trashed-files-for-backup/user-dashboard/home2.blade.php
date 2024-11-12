@extends('user-dashboard.app')

@section('title')
Dashboard Home
@endsection

@section('content')
<div class="container">
    <h1 class="mt-4">Home</h1>
    <p>Welcome to the dashboard home page!</p>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Recent Activities</h5>
            <p class="card-text">This section can display recent user activities or updates.</p>
        </div>
    </div>
    <a href="/dashboard" class="mt-3">Back to Dashboard</a>

</div>
@endsection


