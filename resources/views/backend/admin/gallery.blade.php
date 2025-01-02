@extends('backend.admin.layout.app')
@section('content')
<div class="container mt-5">
    <h2>Gallery Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Image -->
    <form action="{{ route('admin.storeGallery') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Add Image</button>
    </form>

    <!-- Gallery Images -->
    <div class="row">
        @foreach($galleryImages as $image)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('assets/images/gallery/' . $image->image) }}" class="card-img-top" alt="Gallery Image">
                    <div class="card-body">
                        <p>{{ $image->description }}</p>
                        <form action="{{ route('admin.updateGallery', $image->id) }}" method="POST" enctype="multipart/form-data" class="mb-2">
                            @csrf
                            @method('PUT')
                            <input type="file" name="image" class="form-control mb-2">
                            <textarea name="description" class="form-control mb-2" rows="2">{{ $image->description }}</textarea>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                        <form action="{{ route('admin.deleteGallery', $image->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $galleryImages->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
