@extends('backend.admin.layout.app')

@section('content')
    <h1>Edit Branch</h1>

    <!-- Show error or success message -->
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Edit Branch Form -->
    <form action="{{ route('admin.updateBranch', $branch->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- This is important for PUT request -->

        <div class="form-group">
            <label for="name">Branch Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $branch->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $branch->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $branch->address) }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $branch->phone) }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $branch->email) }}">
        </div>

        <div class="form-group">
            <label for="working_hours">Working Hours</label>
            <input type="text" name="working_hours" id="working_hours" class="form-control" value="{{ old('working_hours', $branch->working_hours) }}">
        </div>

        <!-- Display current image if available -->
        @if ($branch->image)
            <div class="form-group">
                <label for="image">Current Image</label>
                <img src="{{ asset('assets/images/branches/' . $branch->image) }}" alt="Branch Image" width="100">
            </div>
        @endif

        <div class="form-group">
            <label for="image">Change Image (Optional)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Branch</button>
    </form>
@endsection

@section('styles')
    <style>
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
@endsection
