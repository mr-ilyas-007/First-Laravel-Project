@extends('dashboard.app')

@section('title')
    @if (Auth::user()->is_admin == 1)
        Admin Dashboard
    @elseif (Auth::user()->is_admin == 0)
        User Dashboard
    @endif
@endsection

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            @if (Auth::user()->is_admin == 1)
                <h1 class="h2">Admin Dashboard</h1>
            @else
                <h1 class="h2">User Dashboard</h1>
            @endif
            <p class="lead">Welcome, {{ Auth::user()->name }}!</p>
        </div>

        <!-- Dashboard Widgets -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Accounts</h5>
                        <p class="card-text">The Total Number of Accounts are: {{$accountsCount}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Contacts</h5>
                        <p class="card-text">The Total Number of Contacts are: {{$contactsCount}}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add more widgets as needed -->
    </main>
@endsection
