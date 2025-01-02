<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'ClubSoft' }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/styles/styles.css') }}">
  </head>
  <body>
    <!-- Header Section -->
    <header>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <!-- Logo -->
          <a class="navbar-brand navbar-logo ps-3" href="{{ url('/') }}">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" class="img-fluid">
          </a>

          <!-- Navbar Toggler -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Navbar Content -->
          <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" href="{{ url('/') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/about') }}">About Club</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/branch') }}">Branch</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/gallery') }}">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/contact-us') }}">Contact Us</a>
              </li>
            </ul>
            <!-- Registration and Login Links -->
            <div class="d-flex align-items-center pe-3">
              @guest
                <!-- If not logged in, show Register and Login -->
                <a href="{{ url('/register') }}" class="btn btn-outline-primary me-2">Registration</a>
                <a href="{{ url('/login') }}" class="btn btn-outline-success">Login</a>
              @else
                <!-- If logged in, show Username and Logout -->
                <span class="me-4">{{ Auth::user()->first_name }}</span>
                <a href="{{ route('logout') }}" class="btn btn-outline-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              @endguest
              <!-- Social Media Icons -->
              <div class="me-4">
                <a href="https://facebook.com" target="_blank">
                  <img src="https://img.icons8.com/color/32/000000/facebook.png" alt="Facebook">
                </a>
              </div>
              <div class="text-end">
                <small class="text-success">HOTLINE 10AM - 10PM</small><br>
                <span class="fw-bold">+88 01409 964 999</span><br>
                <span class="fw-bold">+88 01409 964 888</span>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <!-- Main Content -->
    <main>
      @yield('content')
    </main>

    <!-- Footer Start -->
    <footer class="bg-dark text-white py-5">
      <div class="container">
        <div class="row">
          <!-- Contact Information -->
          <div class="col-md-4">
            <h5 class="text-uppercase">Contact</h5>
            <p>Evergreen Plaza (4th Floor), 260/B, Tejgaon I/A, Dhaka – 1208, Bangladesh.</p>
            <p>Email: <a href="mailto:club@pojf.org" class="text-white">club@pojf.org</a></p>
            <p>Phone: +88 01409 964 888</p>
          </div>
          <!-- Help & Info Links -->
          <div class="col-md-4">
            <h5 class="text-uppercase">Help & Info</h5>
            <ul class="list-unstyled">
              <li><a href="{{ url('/about') }}" class="text-white">About Us</a></li>
              <li><a href="{{ url('/contact-us') }}" class="text-white">Contact</a></li>
            </ul>
          </div>
          <!-- Social Media Links -->
          <div class="col-md-4">
            <h5 class="text-uppercase">Follow Us</h5>
            <ul class="list-unstyled d-flex">
              <li class="me-4">
                <a href="https://facebook.com" class="text-white" target="_blank">
                  <img src="https://img.icons8.com/color/32/000000/facebook.png" alt="Facebook">
                </a>
              </li>
              <li class="me-4">
                <a href="https://twitter.com" class="text-white" target="_blank">
                  <img src="https://img.icons8.com/color/32/000000/twitter.png" alt="Twitter">
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-X9g2e0vbfYpejcjYgfw7UgswhFZb7HqgyyKqKw5uY7mRzvA9WmmptDzZpH7Hz/Ux" crossorigin="anonymous"></script>
  </body>
</html>
