@extends('dashboard.app')

@section('title')
    Add New Contact
@endsection

@section('content')
    <style>
        .custom-input {
            padding: 0.25rem 0.5rem;
            /* Smaller padding */
            height: 30px;
            /* Adjust height as needed */
            font-size: 0.875rem;
            /* Smaller font size */
        }
    </style>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mt-4" style="max-width: 550px; margin: 0 auto; padding: 20px;">
            <div class="card-header bg-dark text-white" style="font-size: 1.25rem; padding: 10px;">
                <h5 class="mb-0">Add New Contact</h5>
            </div>
            <div class="card-body" style="padding: 20px;">
                <form method="POST" action="/contacts/saveContact" enctype="multipart/form-data">
                    @csrf
                    @foreach ($fields as $field)
                        <div class="form-group mb-2">
                            <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>

                            @if ($field['type'] === 'text' || $field['type'] === 'number' || $field['type'] === 'date')
                                <input type="{{ $field['type'] }}" value="{{ old($field['name']) }}"
                                    class="form-control form-control-sm custom-input @error($field['name']) is-invalid @enderror"
                                    id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                                    placeholder="Enter {{ $field['label'] }}" {{ $field['required'] ? 'required' : '' }}>
                                @error($field['name'])
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @elseif ($field['type'] === 'select')
                                <select name="{{ $field['name'] }}" id="{{ $field['name'] }}"
                                    class="form-control form-control-sm custom-input @error($field['name']) is-invalid @enderror"
                                    {{ $field['required'] ? 'required' : '' }}>
                                    @if ($field['options'] === 'accounts')
                                        <option value="">--Select {{ $field['label'] }}--</option>
                                        @foreach ($accounts as $acc)
                                            <option value="{{ $acc->id }}">{{ $acc->company_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error($field['name'])
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @elseif ($field['type'] === 'file')
                                <input type="{{ $field['type'] }}"
                                    class="form-control form-control-sm custom-input @error($field['name']) is-invalid @enderror"
                                    id="{{ $field['name'] }}" name="{{ $field['name'] }}" accept="image/*">
                                @error($field['name'])
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif

                            @if ($field['type'] == 'checkbox')
                                @foreach ($tags as $tag)
                                    <div class="form-check form-check-inline">
                                        <input type="{{ $field['type'] }}" name="{{ $field['name'] }}"
                                            value="{{ $tag->id }}" class="form-check-input"
                                            id="tag_{{ $tag->id }}"
                                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-dark mt-1" style="width: 100%;">Add Contact</button>
                </form>
            </div>
        </div>
    </div>


@endsection
