@extends('dashboard.app')

@section('title')
    Editing Contact Name: {{ $contact->name }}
@endsection

@section('content')
    <style>
        .custom-input {
            padding: 0.25rem 0.5rem;
            height: 30px;
            font-size: 0.875rem;
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
                <h5 class="mb-0">Edit Contact: {{ $contact->name }}</h5>
            </div>
            <div class="card-body" style="padding: 20px;">
                <form method="POST" action="/contact/edit/{{ $contact->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @foreach ($fields as $field)
                        <div class="form-group mb-2">
                            <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>

                            @if ($field['type'] === 'text' || $field['type'] === 'number')
                                <input type="{{ $field['type'] }}"
                                    value="{{ old($field['name'], $contact->{$field['name']}) }}"
                                    class="form-control form-control-sm custom-input @error($field['name']) is-invalid @enderror"
                                    id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                                    placeholder="Enter {{ $field['label'] }}" {{ $field['required'] ? 'required' : '' }}>
                                @error($field['name'])
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            @elseif ($field['type'] === 'text' && $field['name'] === 'address')
                                <input type="{{ $field['type'] }}" class="form-control" id="{{ $field['name'] }}"
                                    name="{{ $field['name'] }}" placeholder="Enter {{ $field['label'] }}"
                                    value="{{ old($field['name'], $contact->profile->address) }}"
                                    {{ $field['required'] ? 'required' : '' }}>

                            @elseif ($field['type'] === 'date' && $field['name'] === 'date_of_birth')
                                <input type="{{ $field['type'] }}" class="form-control" id="{{ $field['name'] }}"
                                    name="{{ $field['name'] }}" placeholder="Enter {{ $field['label'] }}"
                                    value="{{ old($field['name'], $contact->profile->date_of_birth) }}"
                                    {{ $field['required'] ? 'required' : '' }}>
                            @elseif ($field['type'] === 'select')
                                <select name="{{ $field['name'] }}" id="{{ $field['name'] }}"
                                    class="form-control form-control-sm custom-input @error($field['name']) is-invalid @enderror"
                                    {{ $field['required'] ? 'required' : '' }}>
                                    <option value="">--Select {{ $field['label'] }}--</option>
                                    @if ($field['options'] === 'accounts')
                                        @foreach ($accounts as $acc)
                                            <option value="{{ $acc->id }}"
                                                {{ old($field['name'], $contact->{$field['name']}) == $acc->id ? 'selected' : '' }}>
                                                {{ $acc->company_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error($field['name'])
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @elseif ($field['type'] === 'file')
                                <input type="{{ $field['type'] }}"
                                    class="form-control form-control-sm custom-input @error($field['name']) is-invalid @enderror"
                                    id="{{ $field['name'] }}" name="{{ $field['name'] }}" accept="image/*"
                                    value="{{ old($field['name'], $contact->image) }}">
                                @error($field['name'])
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                {{-- @elseif ($field['type'] === 'textarea')
                                <textarea class="form-control form-control-sm custom-input @error($field['name']) is-invalid @enderror"
                                    name="{{ $field['name'] }}" id="{{ $field['name'] }}" placeholder="Enter {{ $field['label'] }}"
                                    {{ $field['required'] ? 'required' : '' }}>
                                    {{ old($field['name'], $contact->{$field['name']}) }}
                                </textarea>
                                @error($field['name'])
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror --}}
                            @endif

                            @if ($field['type'] == 'checkbox')
                                @foreach ($tags as $tag)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                            class="form-check-input" id="tag_{{ $tag->id }}"
                                            {{ $contact->tag->contains($tag->id) ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-dark mt-1" style="width: 100%;">Update Contact</button>
                </form>
            </div>
        </div>
    </div>
@endsection
