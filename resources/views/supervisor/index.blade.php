@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Supervisor Management</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addSupervisorModal">
            + Add Supervisor
        </button>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- Supervisors Table --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Supervisor Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supervisors as $supervisor)
                        <tr>
                            <td>{{ $supervisor->id }}</td>
                            <td>{{ $supervisor->name }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning editSupervisorBtn"
                                        data-id="{{ $supervisor->id }}"
                                        data-name="{{ $supervisor->name }}"
                                        data-toggle="modal"
                                        data-target="#editSupervisorModal">
                                    Edit
                                </button>
                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No supervisors found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Add Supervisor Modal --}}
<div class="modal fade" id="addSupervisorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('supervisor.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Supervisor</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="supervisorName">Supervisor Name</label>
                        <input type="text" class="form-control" id="supervisorName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Supervisor</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Supervisor Modal --}}
<div class="modal fade" id="editSupervisorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editSupervisorForm" method="POST" action="{{ route('supervisor.update') }}">
                @csrf
                <input type="hidden" id="editSupervisorId" name="id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Supervisor</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editSupervisorName">Supervisor Name</label>
                        <input type="text" class="form-control" id="editSupervisorName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update Supervisor</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('.editSupervisorBtn').on('click', function() {
        let supervisorId = $(this).data('id');
        let supervisorName = $(this).data('name');

        $('#editSupervisorId').val(supervisorId);
        $('#editSupervisorName').val(supervisorName);
    });
});
</script>
@endpush
@endsection
