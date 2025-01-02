@extends('backend.admin.layout.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>View Member Details</h4>
        </div>
        <div class="card-body">
            <p><strong>Full Name:</strong> {{ $member->first_name }} {{ $member->last_name }}</p>
            <p><strong>Email:</strong> {{ $member->email }}</p>
            <p><strong>Mobile:</strong> {{ $member->mobile_number }}</p>
            <p><strong>Country:</strong> {{ $member->country }}</p>
            <p><strong>District:</strong> {{ $member->district }}</p>
            <p><strong>Address:</strong> {{ $member->address }}</p>
            <p><strong>Status:</strong> {{ $member->status == 1 ? 'Active' : 'Inactive' }}</p>
            <a href="{{ route('admin.viewMembers') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
