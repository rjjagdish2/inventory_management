@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Grade Management</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addGradeModal">
            + Add Grade
        </button>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Whoops!</strong> Please fix the following errors:
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    {{-- Grades Table --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Metal Name</th>
                            <th>Grade Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grades as $index->$grade)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $grade->metal->name }}</td>
                            <td>{{ $grade->name }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning editGradeBtn"
                                        data-id="{{ $grade->id }}"
                                        data-name="{{ $grade->name }}"
                                        data-metal="{{ $grade->metal_id }}"
                                        data-toggle="modal"
                                        data-target="#editGradeModal">
                                    Edit
                                </button>
                                <form action="{{ route('grade.delete') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $grade->id }}">
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this grade?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No grades found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Add Grade Modal --}}
<div class="modal fade" id="addGradeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('grade.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Grade</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="gradeName">Select Metal <span class="text-danger">*</span></label>
                        <select name="metal_id" class="form-control" required>
                            <option class="form-control" value="">-- Select Metal --</option>
                            @foreach ($metals as $metal)
                                <option class="form-control" value="{{ $metal->id }}">{{ $metal->name }}</option>
                            @endforeach
                        </select>
                        @error('metal_id')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gradeName">Grade Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="gradeName" name="name" required>
                        @error('gradeName')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Grade</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Grade Modal --}}
<div class="modal fade" id="editGradeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editGradeForm" method="POST" action="{{ route('grade.update') }}">
                @csrf
                <input type="hidden" id="editGradeId" name="id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Grade</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="gradeName">Select Metal <span class="text-danger">*</span></label>
                        <select name="metal_id" id="editMetalId" class="form-control" >
                            <option class="form-control" value="">-- Select Metal --</option>
                            @foreach ($metals as $metal)
                                <option class="form-control" value="{{ $metal->id }}">{{ $metal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editGradeName">Grade Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editGradeName" name="name" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update Grade</button>
                </div>
            </form>
        </div>
    </div>
</div>



@push('scripts')
<script>
$(document).ready(function() {
    // Prefill Edit Modal
    $('.editGradeBtn').on('click', function() {
        let gradeId = $(this).data('id');
        let metalId = $(this).data('metal');
        let gradeName = $(this).data('name');

        $('#editGradeId').val(gradeId);
        $('#editMetalId').val(metalId).trigger('change');
        $('#editGradeName').val(gradeName);
    });

});
</script>
@endpush
@endsection
