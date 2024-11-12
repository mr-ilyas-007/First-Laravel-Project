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
        <h1 class="mt-4">List of Accounts</h1>
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Sr. No.</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Pincode</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=1;
                @endphp
                @foreach ($accounts as $acc)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$acc->company_name}}</td>
                        <td>{{$acc->address}}</td>
                        <td>{{$acc->pin_code}}</td>
                        <td>
                            <a href="{{route('accounts.edit', $acc->id)}}" class="btn btn-primary btn-sm">Edit</a> &nbsp;
                            <form action="{{ route('accounts.destroy', $acc->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{route('accounts.create')}}" class="btn btn-dark">Create New Account</a>
    </div>
@endsection
