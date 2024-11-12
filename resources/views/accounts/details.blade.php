@extends('dashboard.app')

@section('title')
    Account Details
@endsection

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 92.3vh;">
        <div class="card w-100" style="max-width: 400px;">
            <div class="card-header text-center">
                <h4>Account Details</h4>
            </div>
            <div class="card-body shadow-lg">
                <!-- Account Details -->
                <h5 class="card-title">Name: {{ $account->company_name ?? 'Unable to fetch company name' }}</h5>
                <p class="text-muted">Account ID: {{ $account->id ?? 'Unable to fetch ID' }}</p>

                <div class="mt-3">
                    <p><strong>Address:</strong> {{ $account->address ?? 'Address not available' }}</p>
                    <p><strong>Pin Code:</strong> {{ $account->pin_code ?? 'Pin code not available' }}</p>

                    <!-- List of Contacts for this Account -->
                    <h5 class="mt-3">List of Contacts with {{ $account->company_name }}</h5>
                    @if ($account->contact->isEmpty())
                        <p>No contacts associated with this account.</p>
                    @else
                        <ul class="list-unstyled">
                            @foreach ($account->contact as $index => $contact)
                                <li><strong>{{ $index + 1 }}:</strong> {{ $contact->name ?? 'Name not available' }}</li>
                            @endforeach
                            {{-- @foreach ($account->contact->name as $name)
                            <ol>
                                <li> {{ $name ?? 'Name not available' }}</li>
                            </ol>
                            @endforeach --}}
                        </ul>
                    @endif
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="/contacts" class="btn btn-secondary">Back to Contacts</a>
            </div>
        </div>
    </div>
@endsection
