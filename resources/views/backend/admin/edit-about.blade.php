@extends('backend.admin.layout.app')

@section('title', 'Edit About Us')

@section('content')

<div class="container">
    <h2 class="my-4">Edit About Us</h2>

    <form action="{{ route('admin.updateAbout', $aboutUs->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="heading">Heading</label>
            <input type="text" class="form-control" id="heading" name="heading" value="{{ old('heading', $aboutUs->heading) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $aboutUs->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($aboutUs->image)
            <p>Current Image: <img src="{{ asset($aboutUs->image) }}" width="100"></p>            @else
                <p>No image uploaded</p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

@endsection
