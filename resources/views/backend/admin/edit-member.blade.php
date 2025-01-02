@extends('backend.admin.layout.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Edit Member Details</h4>
        </div>
        <div class="card-body">
            <!-- Display validation errors if any -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Member Form -->
            <form action="{{ route('admin.updateMember', $member->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- This allows you to use PUT method for updating -->
                
                <!-- Full Name -->
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $member->first_name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $member->last_name) }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $member->email) }}" required>
                </div>

                <!-- Mobile Number -->
                <div class="mb-3">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $member->mobile_number) }}" required>
                </div>

                <!-- Country -->
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $member->country) }}" required>
                </div>

                <!-- District -->
                <div class="mb-3">
                    <label for="district" class="form-label">District</label>
                    <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $member->district) }}" required>
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $member->address) }}</textarea>
                </div>

                <!-- Status Selection (Active or Inactive) -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="1" {{ old('status', $member->status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $member->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-success">Update Member</button>
            </form>
        </div>
    </div>
</div>
@endsection
