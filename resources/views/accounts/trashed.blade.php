@extends('dashboard.app')

@section('title')
    Trashed Accounts
@endsection

@section('content')
    <div class="container">
        <h1 class="mt-4">List of Trashed Accounts</h1>
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
                @foreach ($account as $acc)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$acc->company_name}}</td>
                        <td>{{$acc->address}}</td>
                        <td>{{$acc->pin_code}}</td>
                        <td>
                            <form action="{{ route('accounts.forceDelete', $acc->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <form action="{{ route('accounts.restore', $acc->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/accounts" class="btn btn-dark">Back To Accounts</a>
    </div>
@endsection
