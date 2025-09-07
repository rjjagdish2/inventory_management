@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Inward List</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>GRN No</th>
                            <th>Order No</th>
                            <th>Supervisor No</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inwards as $inward)
                        <tr>
                            <td>{{ $inward->id }}</td>
                            <td>{{ $inward->grn_no }}</td>
                            <td>{{ $inward->order_id }}</td>
                            <td>{{ $inward->supervisor_id }}</td>
                            <td>{{ $inward->created_at->format('d-m-Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('inward.show', $inward->id) }}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No Inwards found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
