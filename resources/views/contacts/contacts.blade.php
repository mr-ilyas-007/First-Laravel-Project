@extends('dashboard.app')
@section('title')
    All Contacts
@endsection

@section('content')
    <div class="container">
        <h3 class="mt-2">Your Contacts</h3>
        <a href="/contacts/add" class="btn btn-dark btn-sm  mb-2">Create New Contact</a>
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table id="dataTable" class="table table-striped table-bordered table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Account</th>
                    <th>Actions</th>
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
                                class="text-decoration-underline text-danger">{{ $con->name }}</a>
                        </td>
                        <td>{{ $con->phone }}</td>
                        <td>
                            @if ($con->account)
                                <a href="{{ route('accounts.show', $con->account->id) }}"
                                    class="text-decoration-underline text-danger">
                                    {{ $con->account->company_name }}
                                </a>
                            @else
                                <span>No Account Assigned</span>
                            @endif
                        </td>
                        <td>
                            <a href="/contact/delete/{{ $con->id }}" class="btn btn-danger btn-sm">Trash</a>
                            <a href="/contact/edit/{{ $con->id }}" class="btn btn-info btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/contacts/trashed" class="btn btn-dark btn-sm">See Trashed Contacts</a>
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

    {{-- DataTable({
    paging: true, // Enable pagination
    searching: true, // Enable search box
    ordering: true, // Enable column sorting
    lengthChange: true, // Allow changing the number of rows shown
    pageLength: 10, // Set default number of rows per page
    info: true, // Show table information (e.g., "Showing 1 to 10 of 50 entries")
    autoWidth: false, // Disable automatic column width calculation
    responsive: true, // Make the table responsive
    dom: 'Bfrtip', // Add buttons (e.g., export, print)
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print' // Export and print options
    ]
}); --}}
@endsection
