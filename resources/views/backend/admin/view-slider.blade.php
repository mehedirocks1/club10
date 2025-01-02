@extends('backend.admin.layout.app')

@section('content')
    <div class="container">
        <!-- Success message box -->
        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1>Slider Images</h1>

        <!-- Display current slider images in a boxed layout -->
        <div class="row mb-4">
            @foreach ($sliderImages as $image)
                <div class="col-md-4 mb-4">
                    <div class="slider-image-box p-3 border rounded shadow-sm text-center">
                        <h5>Current Slider</h5>
                        <img src="{{ asset("assets/images/slider/$image") }}" alt="Slider Image" 
                             class="img-fluid" 
                             style="max-width: 100%; height: 200px; object-fit: cover;">
                        <p class="mt-2">Image Size: 1920x1080</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Form for uploading new slider images -->
        <h2>Upload New Slider Images</h2>
        <form action="{{ route('admin.changeSlider') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="form-group">
                        <label for="slider1">Upload Slider 1 (JPG, Max 2MB, 1920x1080)</label>
                        <input type="file" name="slider1" id="slider1" class="form-control" accept=".jpg, .jpeg">
                        @error('slider1') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="form-group">
                        <label for="slider2">Upload Slider 2 (JPG, Max 2MB, 1920x1080)</label>
                        <input type="file" name="slider2" id="slider2" class="form-control" accept=".jpg, .jpeg">
                        @error('slider2') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="form-group">
                        <label for="slider3">Upload Slider 3 (JPG, Max 2MB, 1920x1080)</label>
                        <input type="file" name="slider3" id="slider3" class="form-control" accept=".jpg, .jpeg">
                        @error('slider3') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Upload Slider Images</button>
        </form>
    </div>
@endsection
