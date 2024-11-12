@extends('dashboard.app')

@section('title')
    Edit Account
@endsection

@section('content')
    <div class="container">
        <h1 class="mt-4">Edit Account</h1>
        <form class="mt-4" method="POST" action="{{ route('accounts.update', $account->id) }}">
            @csrf
            @method('put')

            @foreach ($fields as $field)
                @if ($field['type'] === 'text' || $field['type'] === 'number')
                    <div class="form-group mb-3">
                        <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                        <input type="{{ $field['type'] }}" class="form-control" id="{{ $field['name'] }}"
                            name="{{ $field['name'] }}" placeholder="{{ $field['label'] }}"
                            value="{{ old($field['name'], $account->{$field['name']}) }}"
                            {{ $field['required'] ? 'required' : '' }}>
                    </div>
                @elseif ($field['type'] === 'textarea')
                    <div class="form-group mb-3">
                        <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                        <textarea class="form-control" id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                            placeholder="{{ $field['label'] }}" rows="3" {{ $field['required'] ? 'required' : '' }}>{{ $account->address }}</textarea>
                    </div>
                @endif
            @endforeach
            {{-- <div class="form-group">
                <label for="name">Company Name</label>
                <input type="text" class="form-control" id="name" name="company_name" placeholder="Enter Name" value="{{$account->company_name}}" required>
            </div>
            <div class="form-group">
                <label for="phone">Address</label>
                <textarea class="form-control" id="address" name="address" placeholder="Enter Address" cols="30" rows="10">{{$account->address}}</textarea>
            </div>

            <div class="form-group">
                <label for="pin_code">Pin Code</label>
                <input type="number" class="form-control" name="pin_code" id="pin_code" placeholder="Enter Pincode" value="{{$account->pin_code}}" required>
            </div> --}}
            <button type="submit" class="btn btn-primary mt-3">Update Account</button>
        </form>
    </div>
@endsection
