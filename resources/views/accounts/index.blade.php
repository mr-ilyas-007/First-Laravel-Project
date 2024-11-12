@extends('dashboard.app')
@section('title')
    Accounts
@endsection
@section('content')
    <div class="container">
        <h3 class="mt-2">List of Accounts</h3>
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a href="{{ route('accounts.create') }}" class="btn btn-dark mb-2">Create New Account</a>

        <!-- DataTable -->
        <table id="dataTable" class="table table-striped table-bordered table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>Sr. No.</th>
                    <th>Company Name</th>
                    <th>Address</th>
                    <th>Pincode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($accounts as $acc)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $acc->company_name }}</td>
                        <td>{{ $acc->address }}</td>
                        <td>{{ $acc->pin_code }}</td>
                        <td>
                            <a href="{{ route('accounts.edit', $acc->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('accounts.destroy', $acc->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Trash</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('accounts.trashed') }}" class="btn btn-dark">Trashed Accounts</a>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
