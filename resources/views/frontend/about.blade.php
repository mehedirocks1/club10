@extends('frontend.layout.app')

@section('title', 'About Us')

@section('content')

<!-- About Section -->
<section class="about-us py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <!-- Display Heading and Description -->
                <h2 class="display-4">{{ $aboutUs->heading ?? 'About Us' }}</h2>
                <p class="lead">{{ $aboutUs->description ?? 'We are a team of professionals dedicated to providing the best solutions for your business. Our mission is to innovate, create, and deliver exceptional results.' }}</p>
            </div>
            <div class="col-lg-6">
                <!-- Display Image -->
                <img src="{{ asset('' . $aboutUs->image) ?? 'https://via.placeholder.com/500x300' }}" class="img-fluid rounded" alt="About Us">

            </div>
        </div>
    </div>
</section>

<!-- Our Team Section -->
<section class="our-team py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Meet Our Team</h2>
        <div class="row">
            @foreach($teamMembers as $member)
                <div class="col-md-4">
                    <div class="card">
                    <img src="{{ asset('assets/images/team/' . $member->image) }}" class="card-img-top" alt="{{ $member->name }}">
                    <div class="card-body text-center">
                            <h5 class="card-title">{{ $member->name }}</h5>
                            <p class="card-text">{{ $member->role }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
