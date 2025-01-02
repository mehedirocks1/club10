@extends('backend.admin.layout.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">Delete Member</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.destroyMember', $member->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="alert alert-warning">
                    <p>Are you sure you want to delete the member <strong>{{ $member->first_name }} {{ $member->last_name }}</strong>?</p>
                    <p>Email: <strong>{{ $member->email }}</strong></p>
                    <p>Mobile: <strong>{{ $member->mobile_number }}</strong></p>
                    <p>This action cannot be undone.</p>
                </div>

                <button type="submit" class="btn btn-danger">Delete</button>
                <a href="{{ route('admin.viewMembers') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
