@extends('backend.admin.layout.app')

@section('content')
    <h1>Add New Branch</h1>
    
    <form action="{{ route('admin.storeBranch') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="name">Branch Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            @error('description') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
            @error('address') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            @error('phone') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="working_hours">Working Hours</label>
            <input type="text" name="working_hours" class="form-control" value="{{ old('working_hours') }}">
            @error('working_hours') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="image">Branch Image</label>
            <input type="file" name="image" class="form-control">
            @error('image') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Branch</button>
    </form>
@endsection
