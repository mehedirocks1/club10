@extends('backend.admin.layout.app')

@section('title', 'About Us Management')

@section('content')

<div class="container">
    <h2 class="my-4">About Us Management</h2>

    <!-- Display success message if any -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add About Us button -->
    <!-- <a href="{{ route('admin.storeAbout') }}" class="btn btn-primary mb-4">Add New About Us Entry</a> -->

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Heading</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aboutUs as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->heading }}</td>
                    <td>{{ Str::limit($item->description, 50) }}</td>
                    <td>
                        @if($item->image)
                            <img src="{{ asset($item->image) }}" alt="About Us Image" width="100">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.editAbout', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
