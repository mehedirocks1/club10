@extends('backend.admin.layout.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Change Password</h3>
                    </div>
                    <div class="card-body">
                        <!-- Change Password Form -->
                        <form action="{{ route('admin.changePassword') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Current Password -->
                            <div class="form-group mb-4">
                                <label for="current_password" class="font-weight-bold">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Enter Current Password" required>
                                @error('current_password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="form-group mb-4">
                                <label for="password" class="font-weight-bold">New Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter New Password" required>
                                @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mb-4">
                                <label for="password_confirmation" class="font-weight-bold">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm New Password" required>
                                @error('password_confirmation')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-block">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
