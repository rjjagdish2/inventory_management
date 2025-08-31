@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Order</h2>

    <hr />

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('order.store') }}" method="POST">
        @csrf

        <input type="hidden" name="items" id="itemsInput">

        <div class="form-group">
            <label>GRN No.</label>
            <input type="text" name="grn_no" class="form-control" id = "grn_no" >
        </div>
        
        <!-- Customer -->
        <div class="form-group ">
            <label>Customer</label>
            <select name="customer_id" id="customer" class="form-control" >
                <option value="">-- Select Customer --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-sm btn-primary mt-2" id="addCustomerBtn">+ Add Customer</button>
        </div>

        <div class="form-group">
            <label>Order Description</label>
            <textarea name="description" class="form-control" id="description">
            </textarea>
            
        </div>

        <hr />

        <!-- Supplier -->
        <div class="form-group">
            <label>Supplier</label>
            <select name="supplier_id" id="supplier_id" class="form-control" >
                <option value="">-- Select Supplier --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-sm btn-primary mt-2" id="addSupplierBtn">+ Add Supplier</button>
        </div>

        <!-- Product -->
        <div class="form-group">
            <label>Product</label>
            <select name="product_id" id="product" class="form-control" >
                {{-- <option value="">-- Select Product --</option> --}}
            </select>
            <button type="button" class="btn btn-sm btn-primary mt-2" id="addProductBtn">+ Add Product</button>
        </div>

        

        <!-- Quantity -->
        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="weight" class="form-control" id = "quantity" >
        </div>

        

        <!-- Add to Table -->
        <button type="button" id="addToOrder" class="btn btn-info mb-3">+ Add to Order</button>


        <table class="table table-bordered mb-3" id="orderItemsTable">
            <thead>
                <tr>
                    <th>Supplier</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        
        <hr />
        

        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>

{{-- ================= Supplier Modal ================= --}}
<div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="supplierModalLabel">Add New Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="supplierForm">
                    @csrf
                    <div class="form-group">
                        <label for="supplierName">Supplier Name</label>
                        <input type="text" class="form-control" id="supplierName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="supplierPhone">Supplier Phone no.</label>
                        <input type="text" class="form-control" id="supplierPhone" name="phone" required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save"></i> Save Supplier
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ================= Product Modal ================= --}}
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="productForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="productCode" class="form-label">Product Code</label>
                            <input type="text" class="form-control" id="productCode" name="code" placeholder="Enter product code" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="name" placeholder="Enter product name" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="productSize" class="form-label">Size</label>
                            <input type="text" class="form-control" id="productSize" name="size"  required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="productGrade" class="form-label">Grade</label>
                            <select name="grade_id" id="productGrade" class="form-control" required>
                                <option value="">-- Select Grade --</option>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="productCastingRatio" class="form-label">Casting Ratio</label>
                            <input type="text" class="form-control" id="productCastingRatio" name="castingRatio" placeholder="Enter ratio" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="productDesign" class="form-label">Design</label>
                            <input type="file" class="form-control" id="productDesign" name="design" accept="image/*,.pdf">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="productSupplier" class="form-label">Supplier</label>
                            <select class="form-control" id="productSupplier" name="supplier_id" required>
                                <option value="">-- Select Supplier --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save"></i> Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ================= Customer Modal ================= --}}
<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerModalLabel">Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="customerForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="customerName" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customerName" name="name" placeholder="Enter customer name" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="customerPhone" class="form-label">Customer Phone No.</label>
                            <input type="number" class="form-control" id="customerPhone" name="phone" placeholder="Enter customer phone no." required>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save"></i> Save Customer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ================= Scripts ================= --}}
@push('scripts')
<script>
$(document).ready(function() {
    // Show modals
    $('#addSupplierBtn').click(() => $('#supplierModal').modal('show'));
    $('#addProductBtn').click(() => $('#productModal').modal('show'));
    $('#addCustomerBtn').click(() => $('#customerModal').modal('show'));

    // Save Supplier
    $('#supplierForm').submit(function(e) {
        e.preventDefault();
        $.post("{{ route('supplier.store') }}", $(this).serialize(), function(data) {
            $('#productSupplier').append(`<option value="${data.id}" selected>${data.name}</option>`);
            $('#supplier_id').append(`<option value="${data.id}" selected>${data.name}</option>`);
            $('#supplierModal').modal('hide');
            $('#supplierForm')[0].reset();
            $.get("{{ route('products.bySupplier', ':id') }}".replace(':id', data.id), function(data) {
                $('#product').empty().append('<option value="">-- Select Product --</option>');
                $.each(data, function(i, product) {
                    $('#product').append(`<option value="${product.id}">${product.name}</option>`);
                });
            });
        });
    });

    // Save Product
    $('#productForm').submit(function(e) {
        e.preventDefault();
        // $.post("{{ route('products.store') }}", $(this).serialize(), function(data) {
        //     $('#product').append(`<option value="${data.id}" selected>${data.name}</option>`);
        //     $('#productModal').modal('hide');
        //     $('#productForm')[0].reset();
        // });
        let formData = new FormData(this);
        
        $.ajax({
            url: "{{ route('products.store') }}",
            type: "POST",
            data: formData,
            processData: false,  // Don't process data
            contentType: false,  // Don't set contentType
            success: function(data) {
                $('#product').append(`<option value="${data.id}" selected>${data.name}</option>`);
                $('#productModal').modal('hide');
                $('#productForm')[0].reset();
            },
            error: function(xhr) {
                alert("There is some issue while creating product!!" );
            }
        });
    });

    $('#customerForm').submit(function(e) {
        e.preventDefault();
        $.post("{{ route('customer.store') }}", $(this).serialize(), function(data) {
            $('#customer').append(`<option value="${data.customer.id}" selected>${data.customer.name}</option>`);
            $('#customerModal').modal('hide');
            $('#customerForm')[0].reset();
        });
    });

    // Load products when supplier changes
    $('#supplier_id').change(function() {
        let supplierId = $(this).val();
        if(supplierId) {
            $.get("{{ route('products.bySupplier', ':id') }}".replace(':id', supplierId), function(data) {
                $('#product').empty().append('<option value="">-- Select Product --</option>');
                $.each(data, function(i, product) {
                    $('#product').append(`<option value="${product.id}">${product.name}</option>`);
                });
            });
        }
    });


    
    let orderItems = [];

    // Add to Order button
    $('#addToOrder').click(function() {
        let supplierId = $('#supplier_id').val();
        let supplierText = $('#supplier_id option:selected').text();
        let productId = $('#product').val();
        let productText = $('#product option:selected').text();
        let quantity = $('#quantity').val();
        

        if(!supplierId || !productId || !quantity) {
            alert("Please select supplier, product and quantity");
            return;
        }
        if (!/^[1-9][0-9]*$/.test(quantity)) {
            alert("Enter a valid quantity.");
            return false;
        }

        // Add item to array
        let item = {
            supplier_id: supplierId,
            supplier_name: supplierText,
            product_id: productId,
            product_name: productText,
            quantity: quantity,
        };
        orderItems.push(item);

        // Update hidden input (send as JSON)
        $('#itemsInput').val(JSON.stringify(orderItems));

        // Append row to table
        $('#orderItemsTable tbody').append(`
            <tr>
                <td>${supplierText}</td>
                <td>${productText}</td>
                <td>${quantity}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm removeItem">X</button>
                </td>
            </tr>
        `);

        // Clear product + quantity
        $('#product').val('');
        $('#quantity').val('');
    });
    $(document).on('click', '.removeItem', function() {
        let rowIndex = $(this).closest('tr').index();
        orderItems.splice(rowIndex, 1); // remove from array
        $('#itemsInput').val(JSON.stringify(orderItems)); // update hidden field
        $(this).closest('tr').remove();
    });
});
</script>
@endpush
@endsection
