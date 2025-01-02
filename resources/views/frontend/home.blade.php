@extends('frontend.layout.app')

@section('content')
    <!-- Slider Start -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/images/slider/1.jpg') }}" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/slider/2.jpg') }}" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/slider/3.jpg') }}" class="d-block w-100" alt="Slide 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Slider End -->

    <!-- Login Form Start -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <!-- Image Column -->
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/login.jpg') }}" alt="Background Image" class="img-fluid rounded">
                    </div>

                    <!-- Form Column -->
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <div class="login-box shadow-lg p-4 bg-white rounded">
                            <h3 class="text-center mb-4">Login</h3>
                            <form>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Enter username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter password">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                    <a href="#" class="text-decoration-none">Forgot password?</a>
                                </div>
                                <button type="submit" class="btn btn-dark w-100 mt-3">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Form End -->

    <!-- FAQ Start -->
    <div class="container py-5">
        <h2>Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion">
            <!-- FAQ 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                        What is the purpose of this website?
                    </button>
                </h2>
                <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        This website provides information about our club, its branches, registration process, and gallery.
                    </div>
                </div>
            </div>
            <!-- FAQ 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                        How can I register for the club?
                    </button>
                </h2>
                <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        To register, please visit our registration page, fill out the necessary details, and submit the form.
                    </div>
                </div>
            </div>
            <!-- FAQ 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                        What are the working hours of the club?
                    </button>
                </h2>
                <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Our club is open from 10 AM to 10 PM every day.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ End -->

@endsection