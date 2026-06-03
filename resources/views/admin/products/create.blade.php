@extends('admin.layouts.app')

@section('title', 'Add Product - EQUALITY Perfume')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="ti ti-plus me-2"></i> Add New Product
        </h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Product Code <span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" required>
                    @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="unisex">Unisex</option>
                    </select>
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" required></textarea>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Thumbnail <span class="text-danger">*</span></label>
                    <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*" required>
                    <small class="text-muted">Recommended: 500x500px</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                
                <!-- Fragrance Notes -->
                <div class="col-12 mb-3">
                    <h6 class="mt-2">Fragrance Notes</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Top Notes</label>
                            <input type="text" name="top_notes" class="form-control" placeholder="e.g., Bergamot, Lemon, Orange">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Notes</label>
                            <input type="text" name="middle_notes" class="form-control" placeholder="e.g., Jasmine, Rose, Lavender">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Base Notes</label>
                            <input type="text" name="base_notes" class="form-control" placeholder="e.g., Vanilla, Musk, Sandalwood">
                        </div>
                    </div>
                </div>
                
                <!-- Performance -->
                <div class="col-12 mb-3">
                    <h6 class="mt-2">Performance (1-10)</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Longevity (hours)</label>
                            <input type="number" name="longevity" class="form-control" placeholder="e.g., 8">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sillage</label>
                            <input type="number" name="sillage" class="form-control" min="0" max="10" placeholder="1-10">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Projection</label>
                            <input type="number" name="projection" class="form-control" min="0" max="10" placeholder="1-10">
                        </div>
                    </div>
                </div>
                
                <!-- Variants -->
                <div class="col-12 mb-3">
                    <h6 class="mt-2">Product Variants (Size, Price, Stock)</h6>
                    <div id="variants-container">
                        <div class="row variant-row mb-2">
                            <div class="col-3">
                                <input type="number" name="sizes[]" class="form-control" placeholder="Size (ml)">
                            </div>
                            <div class="col-3">
                                <input type="text" name="prices[]" class="form-control" placeholder="Price">
                            </div>
                            <div class="col-3">
                                <input type="number" name="stocks[]" class="form-control" placeholder="Stock">
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-danger remove-variant">
                                    <i class="ti ti-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-variant">
                        <i class="ti ti-plus"></i> Add Variant
                    </button>
                </div>
                
                <!-- Featured & Best Seller -->
                <div class="col-12 mb-3">
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="is_featured" class="form-check-input" id="featuredSwitch" value="1">
                        <label class="form-check-label" for="featuredSwitch">Featured Product</label>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_best_seller" class="form-check-input" id="bestSellerSwitch" value="1">
                        <label class="form-check-label" for="bestSellerSwitch">Best Seller</label>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i> Save Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="ti ti-x me-1"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
</div>

@push('scripts')
<script>
    // Add variant row
    document.getElementById('add-variant').addEventListener('click', function() {
        let container = document.getElementById('variants-container');
        let newRow = document.createElement('div');
        newRow.className = 'row variant-row mb-2';
        newRow.innerHTML = `
            <div class="col-3"><input type="number" name="sizes[]" class="form-control" placeholder="Size (ml)"></div>
            <div class="col-3"><input type="text" name="prices[]" class="form-control" placeholder="Price"></div>
            <div class="col-3"><input type="number" name="stocks[]" class="form-control" placeholder="Stock"></div>
            <div class="col-3"><button type="button" class="btn btn-danger remove-variant"><i class="ti ti-trash"></i> Remove</button></div>
        `;
        container.appendChild(newRow);
    });
    
    // Remove variant row
    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-variant') || e.target.parentElement.classList.contains('remove-variant')) {
            let btn = e.target.classList.contains('remove-variant') ? e.target : e.target.parentElement;
            btn.closest('.variant-row').remove();
        }
    });
</script>
@endpush
@endsection