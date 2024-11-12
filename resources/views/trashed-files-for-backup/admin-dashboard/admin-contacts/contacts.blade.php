@extends('admin-dashboard.app')

@section('title')
    Contacts of all Users
@endsection

@section('content')
    <div class="container">
        <h1 class="mt-4">Your Contacts</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Sr. No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=1;
                @endphp
                @foreach ($contacts as $con)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$con->name}}</td>
                        <td>{{$con->phone}}</td>
                        <td>
                            <a href="/contact/edit/{{$con->id}}" class="btn btn-primary btn-sm">Edit</a> &nbsp;
                            <a href="/contact/delete/{{$con->id}}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/contacts/add" class="btn btn-dark">Create New Contact</a>
    </div>
@endsection
