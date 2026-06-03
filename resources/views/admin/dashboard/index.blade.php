@extends('admin.layouts.app')

@section('title', 'Dashboard - EQUALITY Perfume')

@section('content')
<div class="container-fluid">
<div class="row">
    <!-- Stats Cards -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="card card-stats">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted">Total Products</span>
                        <h2 class="mb-0 mt-2">{{ $totalProducts }}</h2>
                    </div>
                    <div class="avatar bg-primary bg-opacity-10 p-3 rounded">
                        <i class="ti ti-box ti-lg text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="card card-stats">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted">Categories</span>
                        <h2 class="mb-0 mt-2">{{ $totalCategories }}</h2>
                    </div>
                    <div class="avatar bg-success bg-opacity-10 p-3 rounded">
                        <i class="ti ti-tags ti-lg text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="card card-stats">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted">Total Variants</span>
                        <h2 class="mb-0 mt-2">{{ $totalVariants }}</h2>
                    </div>
                    <div class="avatar bg-info bg-opacity-10 p-3 rounded">
                        <i class="ti ti-layer-group ti-lg text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="card card-stats">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted">Low Stock Alert</span>
                        <h2 class="mb-0 mt-2 text-warning">{{ $lowStockProducts->count() }}</h2>
                    </div>
                    <div class="avatar bg-warning bg-opacity-10 p-3 rounded">
                        <i class="ti ti-alert-triangle ti-lg text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Chart Products per Category -->
    <div class="col-lg-6 col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Products per Category</h5>
            </div>
            <div class="card-body">
                <canvas id="productsChart" height="250"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Chart Stock per Category -->
    <div class="col-lg-6 col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Stock per Category</h5>
            </div>
            <div class="card-body">
                <canvas id="stockChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Products -->
    <div class="col-lg-8 col-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Recent Products</h5>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentProducts as $product)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="product-thumb" alt="{{ $product->name }}">
                                </td>
                                <td>{{ $product->code }}</td>
                                <td>{{ Str::limit($product->name, 30) }}</td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td>
                                    <span class="status-badge {{ $product->status == 'active' ? 'status-active' : 'status-inactive' }}">
                                        {{ $product->status == 'active' ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-icon btn-primary">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Low Stock Alert -->
    <div class="col-lg-4 col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Low Stock Alert</h5>
            </div>
            <div class="card-body">
                @forelse($lowStockProducts as $variant)
                <div class="d-flex justify-content-between align-items-center mb-3 p-2 border rounded">
                    <div>
                        <strong>{{ $variant->product->name }}</strong>
                        <br>
                        <small class="text-muted">{{ $variant->size }}ml | Stock: {{ $variant->stock }}</small>
                    </div>
                    <a href="{{ route('admin.stock.index') }}" class="btn btn-sm btn-warning">
                        <i class="ti ti-refresh"></i> Restock
                    </a>
                </div>
                @empty
                <div class="text-center py-4">
                    <i class="ti ti-check-circle ti-lg text-success mb-2 d-block"></i>
                    <p class="text-muted">All stocks are sufficient</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>

@push('scripts')
<script>
    // Products per Category Chart
    const productsCtx = document.getElementById('productsChart').getContext('2d');
    new Chart(productsCtx, {
        type: 'bar',
        data: {
            labels: @json($productsPerCategory->pluck('name')),
            datasets: [{
                label: 'Number of Products',
                data: @json($productsPerCategory->pluck('products_count')),
                backgroundColor: '#7367f0',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });
    
    // Stock per Category Chart
    const stockCtx = document.getElementById('stockChart').getContext('2d');
    new Chart(stockCtx, {
        type: 'doughnut',
        data: {
            labels: @json($stockPerCategory->pluck('name')),
            datasets: [{
                data: @json($stockPerCategory->pluck('stock')),
                backgroundColor: ['#7367f0', '#28c76f', '#ff9f43', '#ea5455', '#00cfe8', '#ffc107']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });
</script>
@endpush
@endsection