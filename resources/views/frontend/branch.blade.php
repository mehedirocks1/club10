@extends('frontend.layout.app') <!-- Extend the app layout -->

@section('title', 'Our Branches') <!-- Set the title for the page -->

@section('content') <!-- Section for the page content -->

<div class="container my-5">
  <h2 class="text-center mb-4">Our Branch Offices</h2>

  @forelse ($branches as $branch)
    <div class="card mb-4">
      <div class="row g-0">
        <div class="col-md-4">
          <!-- Use branch image or placeholder -->
          <img src="{{ asset('images/branches/' . $branch->image) ?? 'https://via.placeholder.com/400x300' }}" class="img-fluid rounded-start" alt="{{ $branch->name }}">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">Branch: {{ $branch->name }}</h5>
            <p class="card-text">{{ $branch->description }}</p>
            <ul>
              <li><strong>Address:</strong> {{ $branch->address }}</li>
              <li><strong>Phone:</strong> {{ $branch->phone }}</li>
              <li><strong>Email:</strong> {{ $branch->email }}</li>
              <li><strong>Working Hours:</strong> {{ $branch->working_hours }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  @empty
    <p class="text-center">No branches available at the moment.</p>
  @endforelse
</div>

@endsection <!-- End the content section -->
