@extends('dashboard.app')

@section('title')
@if (Auth::user()->is_admin == 1)
Admin Settings
@endif
User Settings
@endsection

@section('content')
<div class="container">
    <h1 class="mt-4">Admin Settings</h1>
    <p>Manage your account settings.</p>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Account Preferences</h5>
            <form method="POST" action="">
                @csrf
                <div class="form-group">
                    <label for="notifications">Email Notifications</label>
                    <select class="form-control" id="notifications" name="notifications">
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Save Settings</button>
                <a href="/admin/dashboard" class="btn btn-primary mt-3">Back</a>
                <br><br>
                <a href="/admin/delete" class="btn btn-danger mt-3">Delete Account</a>
            </form>
        </div>
    </div>
</div>
@endsection



