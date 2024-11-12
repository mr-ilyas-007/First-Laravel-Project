@extends('user-dashboard.app')
@section('title')
User Dashboard
@endsection

@section('content')


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">User Dashboard</h1>
        <p class="lead">Welcome, {{ Auth::user()->name }}!</p>
    </div>

    <!-- Dashboard Widgets -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Widget 1</h5>
                    <p class="card-text">Description or data for widget 1.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Widget 2</h5>
                    <p class="card-text">Description or data for widget 2.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Add more widgets as needed -->
</main>
@endsection



