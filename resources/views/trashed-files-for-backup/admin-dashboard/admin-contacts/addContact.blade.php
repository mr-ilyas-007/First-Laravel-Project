@extends('admin-dashboard.app')

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
            <div class="form-group">
                <label for="account_id">Company Name</label>
                <select name="account_id" id="account_id" class="form-control" required>
                    <option value="">--Select the Company Name--</option>
                    <option value="1">Enjay I.T. Solutions</option>
                    <option value="2">Tata Consultancy Services</option>
                    <option value="3">Reliance I.T. Solutions</option>
                </select>
                <div class="invalid-feedback">
                    Please select a company name.
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add contact</button>
        </form>
    </div>
@endsection
