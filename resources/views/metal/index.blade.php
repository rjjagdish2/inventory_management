@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Metals Management</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addmetalModal">
            + Add metal
        </button>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- metals Table --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Metal Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($metals as $metal)
                        <tr>
                            <td>{{ $metal->id }}</td>
                            <td>{{ $metal->name }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning editmetalBtn"
                                        data-id="{{ $metal->id }}"
                                        data-name="{{ $metal->name }}"
                                        data-toggle="modal"
                                        data-target="#editmetalModal">
                                    Edit
                                </button>
                                <form action="{{ route('metal.delete') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $metal->id }}">
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this metal?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No metals found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Add metal Modal --}}
<div class="modal fade" id="addmetalModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('metal.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Metal</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="metalName">Metal Name</label>
                        <input type="text" class="form-control" id="metalName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save metal</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit metal Modal --}}
<div class="modal fade" id="editmetalModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editmetalForm" method="POST" action="{{ route('metal.update') }}">
                @csrf
                <input type="hidden" id="editmetalId" name="id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit metal</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editmetalName">metal Name</label>
                        <input type="text" class="form-control" id="editmetalName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update metal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Prefill Edit Modal
    $('.editmetalBtn').on('click', function() {
        let metalId = $(this).data('id');
        let metalName = $(this).data('name');

        $('#editmetalId').val(metalId);
        $('#editmetalName').val(metalName);
    });
});
</script>
@endpush
@endsection
