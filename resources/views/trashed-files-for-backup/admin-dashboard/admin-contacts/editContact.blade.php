@extends('admin-dashboard.app')

@section('title')
    Edit Contact
@endsection

@section('content')
    <div class="container">
        <h1 class="mt-4">Edit Contacts</h1>
        <form class="mt-4" method="POST" action="/contact/edit/{{$contact->id}}">
            {{-- {{ route('profile.update') }} --}}
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ $contact->name }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="phone" class="form-control" id="phone" name="phone"
                    value="{{ $contact->phone }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Contact</button>
        </form>
    </div>
@endsection
