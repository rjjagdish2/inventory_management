@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Product Profiles</h2>
        <button class="btn btn-primary" id="addProductBtn">
            + Add Product
        </button>
    </div>

    {{-- Alert Message --}}
    <div id="alertMessage" class="alert alert-success alert-dismissible fade show d-none" role="alert">
        <span id="alertText"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    {{-- Products Table --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Product Size</th>
                            <th>Metal</th>
                            <th>Grade</th>
                            <th>Casting Ratio</th>
                            <th>Category</th>
                            <th>Supplier</th>
                            <th>Design</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        {{-- @dd($product); --}}
                        {{-- @if (empty($product->supplierRelation->supplier_id))
                            @continue;
                        @endif --}}
                        <tr>

                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->item_code }}</td>
                            <td>{{ $product->size }}</td>
                            <td>{{ $product->metal->name ?? ''}}</td>
                            <td>{{ $product->gradeRelation->name ?? '-' }}</td>
                            <td>{{ $product->castig_ratio }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td>{{ $product->supplierRelation->supplier->name ?? '-' }}</td>

                            <td>
                                @if($product->design)
                                    <a href="{{ route('product.download', $product->id) }}" class="btn btn-sm btn-info">
                                         Download
                                    </a>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning editProductBtn"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-code="{{ $product->item_code }}"
                                        data-size="{{ $product->size }}"
                                        data-grade="{{ $product->grade }}"
                                        data-casting="{{ $product->castig_ratio }}"
                                        data-supplier="{{ $product->supplierRelation->supplier_id }}"
                                        data-category="{{ $product->category }}">
                                    Edit
                                </button>
                                {{-- <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form> --}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No products found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

{{-- ================= Product Modal ================= --}}
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 65%;">
        <div class="modal-content ">
            <form id="productForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="productId" name="product_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="row">
                        {{-- Product Code --}}
                        <div class="col-md-6 mb-3">
                            <label>Product Code</label>
                            <input type="text" id="productCode" name="code" class="form-control" placeholder="Enter product code" required>
                        </div>
                        {{-- Product Name --}}
                        <div class="col-md-6 mb-3">
                            <label>Product Name</label>
                            <input type="text" id="productName" name="name" class="form-control" placeholder="Enter product name" required>
                        </div>
                        {{-- Size --}}
                        <div class="col-md-6 mb-3">
                            <label>Product Size</label>
                            <input type="text" id="productSize" name="size" class="form-control">
                        </div>
                        {{-- Casting Ratio --}}
                        <div class="col-md-6 mb-3">
                            <label>Casting Ratio</label>
                            <input type="text" id="productCastingRatio" name="castingRatio" placeholder="Enter ratio" class="form-control">
                        </div>
                        {{-- Grade --}}
                        <div class="col-md-6 mb-3">
                            <label>Metal</label>
                            <select id="productMetal" name="metal_id" class="form-control">
                                <option value="">-- Select Metal --</option>
                                @foreach($metals as $metal)
                                    <option value="{{ $metal->id }}">{{ $metal->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Grade</label>
                            <select id="productGrade" name="grade_id" class="form-control">
                                <option value="">-- Select Grade --</option>

                            </select>
                        </div>

                        {{-- Design --}}
                        <div class="col-md-6 mb-3">
                            <label>Design</label>
                            <input type="file" id="productDesign" name="design" class="form-control" accept="image/*,.pdf">
                        </div>
                        {{-- Supplier --}}
                        <div class="col-md-6 mb-3">
                            <label>Supplier</label>
                            <select id="productSupplier" name="supplier_id" class="form-control" required>
                                <option value="">-- Select Supplier --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Supplier --}}
                        <div class="col-md-6 mb-3">
                            <label>Category</label>
                            <select id="productCategory" name="category_id" class="form-control" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="saveProductBtn">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Open Add Product Modal
    $('#addProductBtn').click(function() {
        $('#productForm')[0].reset();
        $('#productId').val('');
        $('#productModalLabel').text('Add Product');
        $('#saveProductBtn').text('Add Product');
        $('#productModal').modal('show');
    });

    $('#productMetal').change(function(){
        const metalId = this.value;
        const gradeSelect = $('#productGrade');
        const url = "{{ route('grades.byMetal', ':id') }}".replace(':id', metalId);
        gradeSelect.empty().append('<option value="">-- Select Grade --</option>');

        if (metalId) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    if (Array.isArray(data)) {
                        data.forEach(function (grade) {
                            gradeSelect.append(
                                $('<option>', {
                                    value: grade.id,
                                    text: grade.name
                                })
                            );
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching grades:', error);
                }
            });
        }
    });
    // Open Edit Product Modal
    $('.editProductBtn').click(function() {
        let product = $(this).data();
        $('#productId').val(product.id);
        $('#productName').val(product.name);
        $('#productCode').val(product.code);
        $('#productSize').val(product.size);
        $('#productMetal').val(product.metal_id).trigger('change');
        $('#productGrade').val(product.grade).trigger('change');
        $('#productCastingRatio').val(product.casting);
        $('#productSupplier').val(product.supplier);
        $('#productCategory').val(product.category.id);

        $('#productModalLabel').text('Edit Product');
        $('#saveProductBtn').text('Update Product');
        $('#productModal').modal('show');
    });

    // AJAX Add/Edit Product
    $('#productForm').submit(function(e) {
        e.preventDefault();
        let id = $('#productId').val();
        let url = id ? "{{ route('products.update', ':id') }}".replace(':id', id) : "{{ route('products.store') }}";

        let formData = new FormData(this);

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#productModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                alert('Error: Please check all fields.');
            }
        });
    });

    // AJAX Delete Product
    $('.deleteProductBtn').click(function() {
        if(!confirm('Are you sure?')) return;

        let id = $(this).data('id');
        let url = "{{ route('products.destroy', ':id') }}".replace(':id', id);

        $.ajax({
            url: url,
            type: 'POST',
            data: {_method:'DELETE', _token:'{{ csrf_token() }}'},
            success: function(response){
                alert('Product deleted successfully!');
                location.reload();
            },
            error: function(){
                alert('Error deleting product!');
            }
        });
    });
});
</script>
@endpush
