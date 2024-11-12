@extends('dashboard.app')
@section('title')
    Trashed Contacts
@endsection

@section('content')
    <div class="container">
        <h1 class="mt-4">List of Trashed Contacts</h1>
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Sr. No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Account</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($contacts as $con)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                            <a href="/contact/details/{{ $con->id }}"
                                class="text-decoration-none text-dark">{{ $con->name }}</a>
                        </td>
                        <td>{{ $con->phone }}</td>
                        <td>
                            <a href="{{ route('accounts.show', $con->account->id) }}"
                                class="text-decoration-none text-dark">
                                {{ $con->account ? $con->account->company_name : 'No Account Assigned' }}
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('contact.forceDelete', $con->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                            <form action="{{ route('contact.restore', $con->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/contacts" class="btn btn-dark btn-sm">Back to Contacts List</a>
    </div>
@endsection
