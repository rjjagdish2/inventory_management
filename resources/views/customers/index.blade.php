@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Customers List</h2>
        <button class="btn btn-primary" id="addCustomerBtn">
            + Add Customer
        </button>
    </div>

    {{-- Success / Error Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- Customers Table --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td class="text-center">
                                <button 
                                    class="btn btn-sm btn-warning editCustomerBtn" 
                                    data-id="{{ $customer->id }}"
                                    data-name="{{ $customer->name }}"
                                    data-email="{{ $customer->email }}"
                                    data-phone="{{ $customer->phone }}">
                                    Edit
                                </button>

                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No customers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $customers->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<!-- Add Customer Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="customerForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="customerId" name="customer_id">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="customerName" name="name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" id="customerPhone" name="phone" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveCustomerBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Open Add Customer Modal
    $('#addCustomerBtn').click(function() {
        $('#customerForm')[0].reset();
        $('#customerId').val('');
        $('#customerModal .modal-title').text('Add Customer');
        $('#saveCustomerBtn').text('Add Customer');
        $('#customerModal').modal('show');
    });

    // Open Edit Customer Modal
    $('.editCustomerBtn').click(function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        
        let phone = $(this).data('phone');

        $('#customerId').val(id); 
        $('#customerName').val(name);
        
        $('#customerPhone').val(phone);

        $('#customerModal .modal-title').text('Edit Customer');
        $('#saveCustomerBtn').text('Update Customer');
        $('#customerModal').modal('show');
    });

    // AJAX Save Customer (Add or Edit)
    $('#customerForm').submit(function(e) {
        e.preventDefault();
        let id = $('#customerId').val();
        let url = id ? "{{ route('customer.update', ':id') }}".replace(':id', id) : "{{ route('customer.store') }}";

        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                // Close modal
                $('#customerModal').modal('hide');

                // Reset form
                $('#customerForm')[0].reset();
                $('#customerId').val('');

                // Show alert dynamically
                let alertHtml = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                $('.container').prepend(alertHtml);

                // Optionally reload table or update table row dynamically
                location.reload();
            },
            error: function(xhr) {
                let err = xhr.responseJSON?.errors;
                if (err) {
                    let messages = Object.values(err).flat().join("<br>");
                    let alertHtml = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${messages}
                        </div>
                    `;
                    $('.container').prepend(alertHtml);
                } else {
                    alert("Something went wrong!");
                }
            }
        });
    });

});
</script>
@endpush
