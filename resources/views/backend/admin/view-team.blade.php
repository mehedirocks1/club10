@extends('backend.admin.layout.app')

@section('title', 'Team Management')

@section('content')
<div class="container">
    <h2 class="my-4">Team Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.createTeam') }}" class="btn btn-primary mb-4">Add New Team Member</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Role</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teamMembers as $member)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->role }}</td>
                    <td>
                        @if($member->image)
                        <img src="{{ asset('assets/images/team/' . $member->image) }}" alt="{{ $member->name }}" width="100">

                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.editTeam', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('admin.deleteTeam', $member->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this team member?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
