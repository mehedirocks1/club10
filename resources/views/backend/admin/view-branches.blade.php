@extends('backend.admin.layout.app')

@section('content')
    <h1>Branches</h1>

    @if ($branches->isEmpty())
        <p>No branches found.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Working Hours</th>
                        <th>Image</th>
                        <th>Actions</th> <!-- Action column with icons -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branches as $branch)
                        <tr>
                            <td>{{ $branch->id }}</td>
                            <td>{{ $branch->name }}</td>
                            <td>{{ $branch->description }}</td>
                            <td>{{ $branch->address }}</td>
                            <td>{{ $branch->phone }}</td>
                            <td>{{ $branch->email }}</td>
                            <td>{{ $branch->working_hours }}</td>
                            <td>
                                @if ($branch->image)
                                    <img src="{{ asset('assets/images/branches/' . $branch->image) }}" alt="Branch Image" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.createBranch') }}" class="btn btn-warning" title="Add Branch">
                                    <i class="bi bi-plus-circle"></i>
                                </a>
                                <a href="{{ route('admin.editBranch', ['id' => $branch->id]) }}" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('admin.deleteBranch', ['id' => $branch->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this branch?')" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
@endsection
