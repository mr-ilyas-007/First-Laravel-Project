@if (Auth::user()->is_admin == 1)
    @extends('admin.app')
    @section('title')
        Admin Dashboard
    @endsection
@elseif (Auth::user()->is_admin == 0)
    @extends('user.app')
    @section('title')
        User Dashboard
    @endsection
@endif

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

            <button type="submit" class="btn btn-primary mt-3">Add Account</button>
        </form>
    </div>
@endsection
