@extends('frontend.layout.app') <!-- Extend the app layout -->

@section('title', 'Registration Form') <!-- Set the title for the page -->

@section('content') <!-- Section for the page content -->

<!-- Registration Form -->
<div class="container my-5">
  <h2>Registration Form</h2>
  <!-- Form with CSRF protection -->
  <form class="row g-3 needs-validation" method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data" novalidate>
    @csrf

    <!-- First Name -->
    <div class="col-md-4">
      <label for="first_name" class="form-label">First Name</label>
      <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" required>
      @error('first_name') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Last Name -->
    <div class="col-md-4">
      <label for="last_name" class="form-label">Last Name</label>
      <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" value="{{ old('last_name') }}" required>
      @error('last_name') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Bangla Name -->
    <div class="col-md-4">
      <label for="bangla_name" class="form-label">Bangla Name</label>
      <input type="text" name="bangla_name" class="form-control @error('bangla_name') is-invalid @enderror" id="bangla_name" value="{{ old('bangla_name') }}" required>
      @error('bangla_name') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Photo Upload -->
    <div class="col-md-4">
      <label for="photo" class="form-label">Upload Photo</label>
      <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" id="photo" required>
      @error('photo') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Email Address -->
    <div class="col-md-4">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
      @error('email') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Mobile Number -->
    <div class="col-md-4">
      <label for="mobile" class="form-label">Mobile Number</label>
      <input type="tel" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile" value="{{ old('mobile_number') }}" required>
      @error('mobile_number') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Date of Birth -->
    <div class="col-md-4">
      <label for="dob" class="form-label">Date of Birth</label>
      <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" id="dob" value="{{ old('dob') }}" required>
      @error('dob') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- NID/Birth Cert/Passport -->
    <div class="col-md-4">
      <label for="nid" class="form-label">NID/Birth Cert/Passport</label>
      <input type="text" name="nid" class="form-control @error('nid') is-invalid @enderror" id="nid" value="{{ old('nid') }}" required>
      @error('nid') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Gender Selection -->
    <div class="col-md-4">
      <label for="gender" class="form-label">Gender</label>
      <select name="gender" class="form-select @error('gender') is-invalid @enderror" id="gender" required>
        <option selected disabled value="">Choose...</option>
        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
      </select>
      @error('gender') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Blood Group Selection -->
    <div class="col-md-4">
      <label for="blood_group" class="form-label">Blood Group</label>
      <select name="blood_group" class="form-select @error('blood_group') is-invalid @enderror" id="blood_group" required>
        <option selected disabled value="">Choose...</option>
        <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
        <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
        <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
        <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
        <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
        <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
        <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
        <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
      </select>
      @error('blood_group') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Educational Qualification -->
    <div class="col-md-4">
      <label for="education" class="form-label">Educational Qualification</label>
      <select name="education" class="form-select @error('education') is-invalid @enderror" id="education" required>
        <option selected disabled value="">Choose...</option>
        <option value="high_school" {{ old('education') == 'high_school' ? 'selected' : '' }}>High School</option>
        <option value="bachelor" {{ old('education') == 'bachelor' ? 'selected' : '' }}>Bachelor's</option>
        <option value="master" {{ old('education') == 'master' ? 'selected' : '' }}>Master's</option>
        <option value="phd" {{ old('education') == 'phd' ? 'selected' : '' }}>PhD</option>
      </select>
      @error('education') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Profession -->
    <div class="col-md-4">
      <label for="profession" class="form-label">Profession</label>
      <input type="text" name="profession" class="form-control @error('profession') is-invalid @enderror" id="profession" value="{{ old('profession') }}" required>
      @error('profession') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Skills -->
    <div class="col-md-4">
      <label for="skills" class="form-label">Skills</label>
      <input type="text" name="skills" class="form-control @error('skills') is-invalid @enderror" id="skills" value="{{ old('skills') }}" required>
      @error('skills') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Country -->
    <div class="col-md-4">
      <label for="country" class="form-label">Country</label>
      <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" id="country" value="{{ old('country') }}" required>
      @error('country') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Division -->
    <div class="col-md-4">
      <label for="division" class="form-label">Division</label>
      <input type="text" name="division" class="form-control @error('division') is-invalid @enderror" id="division" value="{{ old('division') }}" required>
      @error('division') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- District -->
    <div class="col-md-4">
      <label for="district" class="form-label">District</label>
      <input type="text" name="district" class="form-control @error('district') is-invalid @enderror" id="district" value="{{ old('district') }}" required>
      @error('district') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Thana -->
    <div class="col-md-4">
      <label for="thana" class="form-label">Thana</label>
      <input type="text" name="thana" class="form-control @error('thana') is-invalid @enderror" id="thana" value="{{ old('thana') }}" required>
      @error('thana') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

    <!-- Address -->
    <div class="col-md-4">
      <label for="address" class="form-label">Address</label>
      <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" required>{{ old('address') }}</textarea>
      @error('address') 
        <div class="invalid-feedback">{{ $message }}</div> 
      @enderror
    </div>

   <!-- Membership Type -->
<div class="col-md-4">
  <label for="membership_type" class="form-label">Membership Type</label>
  <select name="membership_type" class="form-select @error('membership_type') is-invalid @enderror" id="membership_type" required>
    <option selected disabled value="">Choose...</option>
    <option value="basic" {{ old('membership_type') == 'basic' ? 'selected' : '' }}>Basic</option>
    <option value="premium" {{ old('membership_type') == 'premium' ? 'selected' : '' }}>Premium</option>
    <option value="VIP" {{ old('membership_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
  </select>
  @error('membership_type') 
    <div class="invalid-feedback">{{ $message }}</div> 
  @enderror
</div>

<!-- Registration Fee -->
<div class="col-md-4">
  <label for="registration_fee" class="form-label">Registration Fee</label>
  <input type="text" name="registration_fee" id="registration_fee" class="form-control @error('registration_fee') is-invalid @enderror" readonly value="{{ old('registration_fee') }}">
  @error('registration_fee')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>


<!-- Terms and Conditions -->
<div class="col-md-12">
    <div class="form-check">
        <!-- Ensure the checkbox is checked if the user has already accepted the terms -->
        <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" name="terms" id="terms" {{ old('terms') ? 'checked' : '' }} value="1" required>
        <label class="form-check-label" for="terms">I accept the terms and conditions</label>
        @error('terms') 
            <div class="invalid-feedback">{{ $message }}</div> 
        @enderror
    </div>
</div>



    <!-- Submit Button -->
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>

  </form>
</div>

@endsection


<!-- JavaScript to update the registration fee based on membership type -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const membershipTypeSelect = document.getElementById('membership_type');
    const registrationFeeInput = document.getElementById('registration_fee');

    // Set initial registration fee value based on the selected membership type (if any)
    function updateRegistrationFee() {
      const selectedType = membershipTypeSelect.value;

      switch (selectedType) {
        case 'basic':
          registrationFeeInput.value = '100';
          break;
        case 'premium':
          registrationFeeInput.value = '200';
          break;
        case 'VIP':
          registrationFeeInput.value = '400';
          break;
        default:
          registrationFeeInput.value = '';
      }
    }

    // Event listener for membership type change
    membershipTypeSelect.addEventListener('change', updateRegistrationFee);

    // Initial update on page load (in case a membership type is already selected)
    updateRegistrationFee();
  });
</script>