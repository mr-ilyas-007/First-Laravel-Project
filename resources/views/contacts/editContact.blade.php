{{-- @extends('dashboard.app')
@section('title')
Edit Contact
@endsection

@section('content')
    <div class="container">
        <h1 class="mt-4">Edit Contacts</h1>
        <form class="mt-4" method="POST" action="/contact/edit/{{$contact->id}}">
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
@endsection --}}


@extends('dashboard.app')
@section('title')
    Edit Contact
@endsection

@section('content')
    <div class="container">
        <h1 class="mt-4">Edit Contacts</h1>
        <form class="mt-4" method="POST" action="/contact/edit/{{ $contact->id }}">
            @csrf
            @method('put')
            @foreach ($fields as $field)
                <div class="form-group mb-3">
                    <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>

                    @if ($field['type'] === 'text' || $field['type'] === 'number' || $field['type'] === 'file')
                        <input type="{{ $field['type'] }}" class="form-control" id="{{ $field['name'] }}"
                            name="{{ $field['name'] }}" placeholder="Enter {{ $field['label'] }}"
                            value="{{ old($field['name'], $contact->{$field['name']}) }}"
                            {{ $field['required'] ? 'required' : '' }}>
                    @elseif ($field['type'] === 'select')
                        <select name="{{ $field['name'] }}" id="{{ $field['name'] }}" class="form-control"
                            {{ $field['required'] ? 'required' : '' }}>
                            <option value="">--Select {{ $field['label'] }}--</option>
                            @if ($field['options'] === 'accounts')
                                @foreach ($accounts as $acc)
                                    <option value="{{ $acc->id }}">{{ $acc->company_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    @endif
                </div>
            @endforeach
            @error('image')
                {{$message}}
            @enderror
            <button type="submit" class="btn btn-primary mt-3">Update Contact</button>
        </form>
    </div>
@endsection
