@extends('backend.admin.layout.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Your Profile</h3>
            </div>
            <div class="card-body">
                <!-- Profile Details -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>First Name:</strong>
                        <p class="mb-0">{{ $admin->first_name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Last Name:</strong>
                        <p class="mb-0">{{ $admin->last_name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Bangla Name:</strong>
                        <p class="mb-0">{{ $admin->bangla_name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Email:</strong>
                        <p class="mb-0">{{ $admin->email }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Mobile Number:</strong>
                        <p class="mb-0">{{ $admin->mobile_number }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Date of Birth:</strong>
                        <p class="mb-0">{{ $admin->dob }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>NID:</strong>
                        <p class="mb-0">{{ $admin->nid }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Gender:</strong>
                        <p class="mb-0">{{ $admin->gender }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Blood Group:</strong>
                        <p class="mb-0">{{ $admin->blood_group }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Education:</strong>
                        <p class="mb-0">{{ $admin->education }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Profession:</strong>
                        <p class="mb-0">{{ $admin->profession }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Skills:</strong>
                        <p class="mb-0">{{ $admin->skills }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Country:</strong>
                        <p class="mb-0">{{ $admin->country }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Division:</strong>
                        <p class="mb-0">{{ $admin->division }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>District:</strong>
                        <p class="mb-0">{{ $admin->district }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Thana:</strong>
                        <p class="mb-0">{{ $admin->thana }}</p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <strong>Address:</strong>
                        <p class="mb-0">{{ $admin->address }}</p>
                    </div>
                </div>

                <!-- Profile Picture -->
                <div class="text-center mb-3">
                    @if($admin->photo)
                    <img src="{{ asset($admin->photo) }}" alt="Profile Picture" class="img-fluid rounded-circle" width="150">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Profile Picture" class="img-fluid rounded-circle" width="150">
                    @endif
                </div>

                <!-- Edit Profile and Change Password Buttons -->
                <div class="text-center">
                    <a href="{{ route('admin.editProfile') }}" class="btn btn-warning btn-lg">Edit Profile</a>
                    <a href="{{ route('admin.changePasswordForm') }}" class="btn btn-info btn-lg">Change Password</a>
                </div>
            </div>
        </div>
    </div>

@endsection
