@extends('admin.layouts.app')

@section('title', 'Products Management - EQUALITY Perfume')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
            <i class="ti ti-box me-2"></i> Products Management
        </h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Add Product
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" class="product-thumb" alt="{{ $product->name }}">
                        </td>
                        <td><span class="fw-semibold">{{ $product->code }}</span></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td>{{ $product->total_stock }}</td>
                        <td>Rp {{ number_format($product->lowest_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge {{ $product->status == 'active' ? 'status-active' : 'status-inactive' }}">
                                {{ $product->status == 'active' ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-icon btn-primary">
                                    <i class="ti ti-edit"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" id="delete-form-{{ $product->id }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="confirmDelete({{ $product->id }})">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
</div>
</div>
@endsection