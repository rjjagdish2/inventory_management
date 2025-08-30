@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Suppliers</h2>
        <button class="btn btn-primary" id="addSupplierBtn">+ Add Supplier</button>
    </div>

    {{-- Alert Message --}}
    <div id="alertMessage" class="alert alert-success alert-dismissible fade show d-none" role="alert">
        <span id="alertText"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    {{-- Suppliers Table --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->id }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->phone ?? '-' }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning editSupplierBtn"
                                        data-id="{{ $supplier->id }}"
                                        data-name="{{ $supplier->name }}"
                                        data-phone="{{ $supplier->phone }}">
                                    Edit
                                </button>
                                {{-- <button class="btn btn-sm btn-danger deleteSupplierBtn" data-id="{{ $supplier->id }}">Delete</button> --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No suppliers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Supplier Modal --}}
<div class="modal fade" id="supplierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="supplierForm">
                @csrf
                <input type="hidden" id="supplierId" name="supplier_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="supplierModalLabel">Add Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" id="supplierName" name="name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" id="supplierPhone" name="phone" class="form-control">
                    </div>                    
                </div>
                <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-primary" id="saveSupplierBtn">Save Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Open Add Supplier Modal
    $('#addSupplierBtn').click(function() {
        $('#supplierForm')[0].reset();
        $('#supplierId').val('');
        $('#supplierModalLabel').text('Add Supplier');
        $('#saveSupplierBtn').text('Add Supplier');
        $('#supplierModal').modal('show');
    });

    // Open Edit Supplier Modal
    $('.editSupplierBtn').click(function() {
        let supplier = $(this).data();
        $('#supplierId').val(supplier.id);
        $('#supplierName').val(supplier.name);
        $('#supplierPhone').val(supplier.phone);
        

        $('#supplierModalLabel').text('Edit Supplier');
        $('#saveSupplierBtn').text('Update Supplier');
        $('#supplierModal').modal('show');
    });

    // AJAX Add/Edit Supplier
    $('#supplierForm').submit(function(e) {
        e.preventDefault();
        let id = $('#supplierId').val();
        let url = id ? "{{ route('supplier.update', ':id') }}".replace(':id', id) : "{{ route('supplier.store') }}";

        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#supplierModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                alert('Error: Please check all fields.');
            }
        });
    });

    // AJAX Delete Supplier
    $('.deleteSupplierBtn').click(function() {
        if(!confirm('Are you sure?')) return;

        let id = $(this).data('id');
        let url = "{{ route('supplier.destroy', ':id') }}".replace(':id', id);

        $.ajax({
            url: url,
            type: 'POST',
            data: {_method:'DELETE', _token:'{{ csrf_token() }}'},
            success: function(response){
                location.reload();
            },
            error: function(){
                alert('Error deleting supplier!');
            }
        });
    });
});
</script>
@endpush
