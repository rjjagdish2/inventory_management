@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Order #{{ $order->id }}</h2>
    <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
    <p><strong>Date:</strong> {{ $order->created_at->format('d-m-Y') }}</p>

    <p><strong>Order Description: </strong> {{ $order->description}}</p>

    <h4>Products</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->products as $product)
            {{-- @dd($product); --}}
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->suppliers[0]['name'] ?? 'N/A' }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ $product->category->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
