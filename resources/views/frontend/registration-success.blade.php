@extends('frontend.layout.app') <!-- Extend the app layout -->

@section('title', 'Registration Success') <!-- Set the title for the page -->

@section('content') <!-- Section for the page content -->

<!-- Registration Success Message -->
<div class="container my-5">
  <h2 class="text-center text-success">Registration Successful!</h2>
  <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Congratulations!</h4>
    <p>Your registration has been successfully completed.</p>
    <hr>
    <p class="mb-0">You can now log in and start using our services. Please check your email for further instructions.</p>
  </div>
  
  <!-- Back to Login Button -->
  <div class="text-center">
    <a href="{{ route('login.form') }}" class="btn btn-primary">Go to Login</a>
  </div>
</div>

@endsection <!-- End content section -->
