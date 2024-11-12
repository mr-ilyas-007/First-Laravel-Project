@extends('user-dashboard.app')

@section('title')
    User Contacts
@endsection

@section('content')
    <div class="container">
        <h1 class="mt-4">Add New Contact</h1>

        <form class="mt-4" method="POST" action="/contacts/saveContact">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add contact</button>
        </form>
    </div>
@endsection
