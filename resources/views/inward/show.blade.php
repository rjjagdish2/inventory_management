@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Inward Details</h2>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Inward Info</div>
        <div class="card-body">
            <p><strong>GRN No:</strong> {{ $inward->grn_no }}</p>
            <p><strong>Order No:</strong> {{ $inward->order_id }}</p>
            <p><strong>Supervisor No:</strong> {{ $inward->supervisor_id }}</p>
            <p><strong>Created At:</strong> {{ $inward->created_at->format('d-m-Y H:i') }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-secondary text-white">Inward Items</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Supplier</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Tare Weight</th>
                        <th>Gross Weight</th>
                        <th>Net Weight</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inward->items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->supplier->name ?? 'N/A' }}</td>
                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                        <td>{{ $item->category->name ?? 'N/A' }}</td>
                        <td>{{ $item->tare_weight }}</td>
                        <td>{{ $item->gross_weight }}</td>
                        <td>{{ $item->net_weight }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('inward.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
