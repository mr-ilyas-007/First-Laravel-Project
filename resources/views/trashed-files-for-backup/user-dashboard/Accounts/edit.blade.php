@extends('user-dashboard.app')

@section('title')
    Edit Account
@endsection

@section('content')
    <div class="container">
        <h1 class="mt-4">Edit Account</h1>
        <form class="mt-4" method="POST" action="{{route("accounts.update", $account->id)}}">
            {{-- {{ route('profile.update') }} --}}
            @csrf
            @method('put')
            <div class="form-group">
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
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Account</button>
        </form>
    </div>
@endsection
