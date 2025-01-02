@extends('backend.admin.layout.app')

@section('title', 'Add New Team Member')

@section('content')
<div class="container">
    <h2 class="my-4">Add New Team Member</h2>

    <form action="{{ route('admin.storeTeam') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" id="role" name="role" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Team Member</button>
    </form>
</div>
@endsection
