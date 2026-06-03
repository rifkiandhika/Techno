@extends('admin.layouts.app')

@section('title', 'Stock Management - EQUALITY Perfume')

@section('content')
<div class="container-fluid">
<div class="row">
    <!-- Stock In Form -->
    <div class="col-lg-6 col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="ti ti-arrow-badge-up me-2 text-success"></i> Stock In
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.stock.in') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Product Variant</label>
                        <select name="variant_id" class="form-select select2" required>
                            <option value="">Choose product...</option>
                            @foreach($products as $product)
                                @foreach($product->variants as $variant)
                                <option value="{{ $variant->id }}">
                                    {{ $product->name }} - {{ $variant->size }}ml (Current Stock: {{ $variant->stock }})
                                </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" required min="1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note (Optional)</label>
                        <textarea name="note" class="form-control" rows="2" placeholder="e.g., Restock from supplier"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="ti ti-plus me-1"></i> Add Stock
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Stock Out Form -->
    <div class="col-lg-6 col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="ti ti-arrow-badge-down me-2 text-danger"></i> Stock Out
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.stock.out') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Product Variant</label>
                        <select name="variant_id" class="form-select select2" required>
                            <option value="">Choose product...</option>
                            @foreach($products as $product)
                                @foreach($product->variants as $variant)
                                <option value="{{ $variant->id }}">
                                    {{ $product->name }} - {{ $variant->size }}ml (Stock: {{ $variant->stock }})
                                </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" required min="1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note (Optional)</label>
                        <textarea name="note" class="form-control" rows="2" placeholder="e.g., Sold, damaged, expired"></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">
                        <i class="ti ti-minus me-1"></i> Reduce Stock
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Low Stock Products -->
<div class="card mt-3">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="ti ti-alert-triangle me-2 text-warning"></i> Low Stock Products
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Size</th>
                        <th>Current Stock</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowStockVariants as $variant)
                    <tr class="table-warning">
                        <td>{{ $variant->product->name }}</td>
                        <td>{{ $variant->size }} ml</td>
                        <td><strong>{{ $variant->stock }}</strong> pcs</td>
                        <td><span class="status-badge bg-warning bg-opacity-10 text-warning">Low Stock</span></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#restockModal" onclick="setVariant({{ $variant->id }}, '{{ $variant->product->name }} - {{ $variant->size }}ml')">
                                <i class="ti ti-refresh"></i> Restock
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">All stocks are sufficient</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Restock Modal -->
<div class="modal fade" id="restockModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.stock.in') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Restock Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="variant_id" id="restockVariantId">
                    <div class="mb-3">
                        <label>Product</label>
                        <input type="text" id="restockProductName" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Quantity to Add</label>
                        <input type="number" name="quantity" class="form-control" required min="1">
                    </div>
                    <div class="mb-3">
                        <label>Note</label>
                        <textarea name="note" class="form-control" rows="2" placeholder="Restock from supplier"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@push('scripts')
<script>
    function setVariant(id, name) {
        document.getElementById('restockVariantId').value = id;
        document.getElementById('restockProductName').value = name;
    }
    
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush
@endsection