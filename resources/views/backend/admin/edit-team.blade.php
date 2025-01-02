@extends('backend.admin.layout.app')

@section('title', 'Edit Team Member')

@section('content')
<div class="container">
    <h2 class="my-4">Edit Team Member</h2>

    <form action="{{ route('admin.updateTeam', $team->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $team->name }}" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" id="role" name="role" class="form-control" value="{{ $team->role }}" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" class="form-control">
            @if($team->image)
            <img src="{{ asset('assets/images/team/' . $team->image) }}" alt="{{ $team->name }}" width="100" class="mt-3">


            @endif
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Team Member</button>
    </form>
</div>
@endsection
