@extends('backend.admin.layout.app')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Send SMS to {{ $member->first_name }} {{ $member->last_name }}</h4>
    </div>
    <div class="card-body">
    <form action="{{ route('admin.submitMessage', $member->id) }}" method="POST">
    @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" value="{{ $member->first_name }} {{ $member->last_name }}" disabled>
        </div>
        <div class="mb-3">
          <label for="mobile" class="form-label">Mobile Number</label>
          <input type="text" class="form-control" id="mobile" value="{{ $member->mobile_number }}" disabled>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send SMS</button>
      </form>
    </div>
  </div>
</div>
@endsection
