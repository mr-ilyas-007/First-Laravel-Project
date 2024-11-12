{{-- @extends('dashboard.app')

@section('title')
    Create New Account
@endsection

@section('content')
    <div class="container">
        <h1 class="mt-4">Add New Account</h1>

        <form class="mt-4" method="POST" action="{{route('accounts.store')}}">
            @csrf
            <div class="form-group">
                <label for="name">Company Name</label>
                <input type="text" class="form-control" id="name" name="company_name" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="phone">Address</label>
                <textarea class="form-control" id="address" name="address" placeholder="Enter Address" cols="30" rows="10"></textarea>
            </div>

            <div class="form-group">
                <label for="pin_code">Pin Code</label>
                <input type="number" class="form-control" name="pin_code" id="pin_code" placeholder="Enter Pincode" required>
            </div>

            <button type="submit" class="btn btn-dark mt-3">Add Account</button>
        </form>
    </div>
@endsection --}}


@extends('dashboard.app')

@section('title')
    Add New Account
@endsection

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mt-5" style="max-width: 550px; margin: 0 auto; padding: 20px;">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Add New Account</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('accounts.store') }}">
                    @csrf
                    @foreach ($fields as $field)
                        @if ($field['type'] === 'text' || $field['type'] === 'number')
                            <div class="form-group mb-3">
                                <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                                <input type="{{ $field['type'] }}" class="form-control" id="{{ $field['name'] }}"
                                    name="{{ $field['name'] }}" placeholder="{{ $field['label'] }}" {{ $field['required'] ? 'required' : '' }}>
                            </div>
                        @elseif ($field['type'] === 'textarea')
                            <div class="form-group mb-3">
                                <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                                <textarea class="form-control" id="{{ $field['name'] }}" name="{{ $field['name'] }}" placeholder="{{ $field['label'] }}" rows="3" {{ $field['required'] ? 'required' : '' }}></textarea>
                            </div>
                        @endif
                    @endforeach
                    {{-- <div class="form-group mb-3">
                        <label for="company_name">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name"
                            placeholder="Enter Company Name" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Enter Address" rows="3" required></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="pin_code">Pin Code</label>
                        <input type="number" class="form-control" name="pin_code" id="pin_code"
                            placeholder="Enter Pin Code" required>
                    </div> --}}

                    <button type="submit" class="btn btn-dark mt-3">Add Account</button>
                </form>
            </div>
        </div>
    </div>
@endsection
