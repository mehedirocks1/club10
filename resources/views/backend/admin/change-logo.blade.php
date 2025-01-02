@extends('backend.admin.layout.app')

@section('content')
    <h1>Change Logo</h1>

    <!-- Display current logo -->
    <img src="{{ asset('assets/images/logo.jpg') }}" alt="Current Logo" width="150">

    <!-- Form for uploading the new logo -->
    <form action="{{ route('admin.changeLogo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="logo">Upload New Logo (JPG, Max 2MB)</label>
            <input type="file" name="logo" id="logo" class="form-control" accept=".jpg, .jpeg" required>
            @error('logo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Upload Logo</button>
    </form>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
@endsection
