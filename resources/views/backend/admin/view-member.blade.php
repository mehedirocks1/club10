@extends('backend.admin.layout.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white">
            <h4>View Member Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Profile Picture Section -->
                <div class="col-md-3 text-center mb-4">
                    <div class="profile-img-wrapper">
                        @if($member->photo)
                            <img src="{{ asset('storage/' . $member->photo) }}" alt="Profile Picture" class="img-fluid rounded-circle border border-4 border-primary" style="width: 180px; height: 180px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/180" alt="Profile Picture" class="img-fluid rounded-circle border border-4 border-primary">
                        @endif
                    </div>
                </div>

                <!-- Member Details Section -->
                <div class="col-md-9">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Full Name:</strong> {{ $member->first_name }} {{ $member->last_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Bangla Name:</strong> {{ $member->bangla_name }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $member->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Mobile:</strong> {{ $member->mobile_number }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($member->dob)->format('d-m-Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>NID:</strong> {{ $member->nid }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Gender:</strong> {{ $member->gender }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Blood Group:</strong> {{ $member->blood_group }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Education:</strong> {{ $member->education }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Profession:</strong> {{ $member->profession }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Skills:</strong> {{ $member->skills ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Country:</strong> {{ $member->country }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Division:</strong> {{ $member->division ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>District:</strong> {{ $member->district }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Thana:</strong> {{ $member->thana ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Address:</strong> {{ $member->address }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Membership Type:</strong> {{ ucfirst($member->membership_type) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong> {{ $member->status == 1 ? 'Active' : 'Inactive' }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Terms Accepted:</strong> {{ $member->terms_accepted == 1 ? 'Yes' : 'No' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email Verified:</strong> {{ $member->email_verified_at ? \Carbon\Carbon::parse($member->email_verified_at)->format('d-m-Y H:i:s') : 'No' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.viewMembers') }}" class="btn btn-primary btn-lg mt-4">Back to List</a>
        </div>
    </div>
</div>
@endsection
