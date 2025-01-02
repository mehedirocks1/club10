@extends('backend.admin.layout.app')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Registered Users</h4>
    </div>
    <div class="card-body">
      <table class="table table-striped table-bordered text-center">
        <thead class="table-primary">
          <tr>
            <th>Full Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Country</th>
            <th>District</th>
            <th>Address</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($members as $member)
          <tr>
            <td>{{ $member->first_name }} {{ $member->last_name }}</td>
            <td>{{ $member->mobile_number }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->country }}</td>
            <td>{{ $member->district }}</td>
            <td>{{ $member->address }}</td>
            <td>
              <form action="{{ route('admin.updateStatus', $member->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-sm {{ $member->status == 1 ? 'btn-success' : 'btn-danger' }}">
                  <i class="bi {{ $member->status == 1 ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                </button>
              </form>
            </td>
            <td>
              <a href="{{ route('admin.editMember', $member->id) }}" class="btn btn-sm btn-primary">
                <i class="bi bi-pencil-square"></i>
              </a>
              <a href="{{ route('admin.viewMember', $member->id) }}" class="btn btn-sm btn-info">
                <i class="bi bi-eye"></i>
              </a>
              <a href="{{ route('admin.sendMessage', $member->id) }}" class="btn btn-sm btn-success">
                <i class="bi bi-chat-text"></i>
              </a>
              <a href="{{ route('admin.downloadMember', $member->id) }}" class="btn btn-sm btn-warning">
                <i class="bi bi-download"></i>
              </a>
              <!-- Trigger the delete modal -->
              <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                      onclick="setDeleteAction('{{ route('admin.destroyMember', $member->id) }}')">
                <i class="bi bi-trash"></i>
              </button>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8">No users found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this member?
      </div>
      <div class="modal-footer">
      <form id="delete-form" action="{{ route('admin.destroyMember', $member->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Yes, Delete</button>
</form>


        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  function setDeleteAction(actionUrl) {
    document.getElementById('delete-form').action = actionUrl;
  }
</script>


@endsection
