@extends('backend.admin.layout.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-4">Edit Profile</h1>

        <form action="{{ route('admin.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $admin->first_name) }}" required>
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $admin->last_name) }}" required>
                    </div>

                    <!-- Bangla Name -->
                    <div class="mb-3">
                        <label for="bangla_name" class="form-label">Bangla Name</label>
                        <input type="text" class="form-control" name="bangla_name" value="{{ old('bangla_name', $admin->bangla_name) }}">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $admin->email) }}" required>
                    </div>

                    <!-- Mobile Number -->
                    <div class="mb-3">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number', $admin->mobile_number) }}" required>
                    </div>

                    <!-- National ID -->
                    <div class="mb-3">
                        <label for="nid" class="form-label">National ID</label>
                        <input type="text" class="form-control" name="nid" value="{{ old('nid', $admin->nid) }}" required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" value="{{ old('dob', $admin->dob) }}" required>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <!-- Profile Photo -->
                    <div class="mb-3">
                        <label for="photo" class="form-label">Profile Photo</label>
                        <input type="file" class="form-control" name="photo">
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" required>
                            <option value="Male" {{ old('gender', $admin->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $admin->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $admin->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Blood Group -->
                    <div class="mb-3">
                        <label for="blood_group" class="form-label">Blood Group</label>
                        <input type="text" class="form-control" name="blood_group" value="{{ old('blood_group', $admin->blood_group) }}">
                    </div>

                    <!-- Education -->
                    <div class="mb-3">
                        <label for="education" class="form-label">Education</label>
                        <input type="text" class="form-control" name="education" value="{{ old('education', $admin->education) }}">
                    </div>

                    <!-- Profession -->
                    <div class="mb-3">
                        <label for="profession" class="form-label">Profession</label>
                        <input type="text" class="form-control" name="profession" value="{{ old('profession', $admin->profession) }}">
                    </div>

                    <!-- Skills -->
                    <div class="mb-3">
                        <label for="skills" class="form-label">Skills</label>
                        <input type="text" class="form-control" name="skills" value="{{ old('skills', $admin->skills) }}">
                    </div>

                    <!-- Country -->
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" name="country" value="{{ old('country', $admin->country) }}">
                    </div>

                    <!-- Division -->
                    <div class="mb-3">
                        <label for="division" class="form-label">Division</label>
                        <input type="text" class="form-control" name="division" value="{{ old('division', $admin->division) }}">
                    </div>

                    <!-- District -->
                    <div class="mb-3">
                        <label for="district" class="form-label">District</label>
                        <input type="text" class="form-control" name="district" value="{{ old('district', $admin->district) }}">
                    </div>

                    <!-- Thana -->
                    <div class="mb-3">
                        <label for="thana" class="form-label">Thana</label>
                        <input type="text" class="form-control" name="thana" value="{{ old('thana', $admin->thana) }}">
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address">{{ old('address', $admin->address) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>
    </div>
@endsection
