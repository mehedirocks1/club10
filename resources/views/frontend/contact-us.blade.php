@extends('frontend.layout.app')

@section('title', 'Contact Us')

@section('content')
<div class="container my-5">
  <h2 class="text-center mb-4">Contact Us</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="row">
    <div class="col-md-8">
      <h4>Send us a Message</h4>
      <form method="POST" action="{{ route('frontend.contact') }}">
        @csrf
        <div class="mb-3">
          <label for="full_name" class="form-label">Full Name</label>
          <input type="text" name="full_name" class="form-control" id="full_name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
          <label for="subject" class="form-label">Subject</label>
          <input type="text" name="subject" class="form-control" id="subject" required>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea name="message" class="form-control" id="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
      </form>
    </div>

    <div class="col-md-4">
      <h4>Our Contact Information</h4>
      <ul class="list-unstyled">
        <li><strong>Address:</strong> 123 Main Street, New York, NY 10001</li>
        <li><strong>Phone:</strong> +1 234 567 890</li>
        <li><strong>Working Hours:</strong> Mon-Fri, 9 AM - 6 PM</li>
      </ul>
    </div>
  </div>
</div>
@endsection
