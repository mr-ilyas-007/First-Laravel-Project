@extends('dashboard.app')

@section('title')
    Contact ID Card
@endsection

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 92.3vh;">
        <div class="card w-100" style="max-width: 400px;">
            <div class="card-header text-center">
                <h4>Contact Details</h4>
            </div>
            <div class="card-body shadow-lg text-center">
                <!-- User Image -->
                @if ($contact->image)
                    <img src="{{ asset('storage/images/' . $contact->image) }}" class="object-fit-cover rounded-circle mb-3" alt="Contact Image"
                        width="120" height="120">
                @else
                    <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="User Image" width="120"
                        height="120">
                @endif


                <!-- User Details -->
                <h5 class="card-title">Name: {{ $contact->name ?? 'Unable to fetch name' }}</h5>
                <p class="text-muted">Contact ID: {{ $contact->id ?? 'Unable to fetch ID' }}</p>

                <div class="mt-3">
                    <p><strong>Phone:</strong> {{ $contact->phone ?? 'Phone number not available' }}</p>
                    <p><strong>Company Name:</strong> {{ $contact->account->company_name ?? 'Company name not available' }}
                    </p>
                    <p><strong>Data Of Birth:</strong> {{ $contact->profile->date_of_birth ?? 'Data of Birth unavailable' }}</p>
                    <p><strong>Address:</strong> {{ $contact->profile->address ?? 'address is not available' }}</p>
                    <!-- Displaying all the  Contact Tags -->
                    <p><strong>Tags:</strong>
                        @if ($contact->tag->isNotEmpty())
                            @foreach ($contact->tag as $tag)
                                <span class="badge bg-success">{{ $tag->name }}</span>
                            @endforeach
                        @else
                            <span>No tags available</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="/contacts" class="btn btn-secondary">Back to Contacts</a>
            </div>
        </div>
    </div>
@endsection
