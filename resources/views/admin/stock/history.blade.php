@extends('admin.layouts.app')

@section('title', 'Stock History - EQUALITY Perfume')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="ti ti-history me-2"></i> Stock Movement History
        </h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <form method="GET" class="row g-2">
                <div class="col-md-4">
                    <select name="variant_id" class="form-select select2">
                        <option value="">All Products</option>
                        @foreach($variants as $variant)
                        <option value="{{ $variant->id }}" {{ request('variant_id') == $variant->id ? 'selected' : '' }}>
                            {{ $variant->product->name }} - {{ $variant->size }}ml
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Note</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                    <tr>
                        <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>
                        <td><strong>{{ $history->variant->product->name }}</strong></td>
                        <td>{{ $history->variant->size }} ml</td>
                        <td>
                            @if($history->type == 'in')
                            <span class="status-badge status-active"><i class="ti ti-arrow-up"></i> Stock In</span>
                            @else
                            <span class="status-badge status-inactive"><i class="ti ti-arrow-down"></i> Stock Out</span>
                            @endif
                        </td>
                        <td>{{ number_format($history->quantity) }}</td>
                        <td>{{ $history->note ?? '-' }}</td>
                        <td>{{ $history->user->name ?? 'System' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $histories->links() }}
        </div>
    </div>
</div>
</div>
@endsection