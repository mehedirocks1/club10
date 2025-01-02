@extends('frontend.layout.app') <!-- Extend the main layout -->

@section('title', 'Gallery Page') <!-- Set the title for the page -->

@section('content') <!-- Section for the page content -->

<div class="container my-5">
  <h2 class="text-center">Image Gallery</h2>
  <div class="row g-4">
    @forelse($galleryImages as $image)
      <div class="col-md-4 col-sm-6">
        <div class="card">
          <img src="{{ asset('assets/images/gallery/' . $image->image) }}" class="card-img-top" alt="{{ $image->description }}">
          <div class="card-body">
            <p class="card-text">{{ $image->description }}</p>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <p class="text-center">No images found in the gallery.</p>
      </div>
    @endforelse
  </div>

  <!-- Pagination -->
  <div class="d-flex justify-content-center mt-4">
    {{ $galleryImages->links('pagination::bootstrap-4') }}
  </div>
</div>

@endsection <!-- End the content section -->
