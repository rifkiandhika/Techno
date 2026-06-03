@extends('admin.layouts.app')

@section('title', 'Edit Product - EQUALITY Perfume')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="ti ti-edit me-2"></i> Edit Product: {{ $product->name }}
        </h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Product Code <span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $product->code) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="male" {{ $product->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $product->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="unisex" {{ $product->gender == 'unisex' ? 'selected' : '' }}>Unisex</option>
                    </select>
                </div>
                
                <div class="col-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="5" class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Current Thumbnail</label>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" class="rounded" width="100" alt="{{ $product->name }}">
                    </div>
                    <label class="form-label">Change Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                
                <!-- Fragrance Notes -->
                <div class="col-12 mb-3">
                    <h6 class="mt-2">Fragrance Notes</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Top Notes</label>
                            <input type="text" name="top_notes" class="form-control" value="{{ old('top_notes', $product->top_notes) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Notes</label>
                            <input type="text" name="middle_notes" class="form-control" value="{{ old('middle_notes', $product->middle_notes) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Base Notes</label>
                            <input type="text" name="base_notes" class="form-control" value="{{ old('base_notes', $product->base_notes) }}">
                        </div>
                    </div>
                </div>
                
                <!-- Performance -->
                <div class="col-12 mb-3">
                    <h6 class="mt-2">Performance</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Longevity (hours)</label>
                            <input type="number" name="longevity" class="form-control" value="{{ old('longevity', $product->longevity) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sillage (1-10)</label>
                            <input type="number" name="sillage" class="form-control" min="0" max="10" value="{{ old('sillage', $product->sillage) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Projection (1-10)</label>
                            <input type="number" name="projection" class="form-control" min="0" max="10" value="{{ old('projection', $product->projection) }}">
                        </div>
                    </div>
                </div>
                
                <!-- Variants -->
                <div class="col-12 mb-3">
                    <h6 class="mt-2">Product Variants</h6>
                    <div id="variants-container">
                        @foreach($product->variants as $index => $variant)
                        <div class="row variant-row mb-2">
                            <input type="hidden" name="variant_ids[]" value="{{ $variant->id }}">
                            <div class="col-3">
                                <input type="number" name="sizes[]" class="form-control" value="{{ $variant->size }}" placeholder="Size (ml)">
                            </div>
                            <div class="col-3">
                                <input type="text" name="prices[]" class="form-control" value="{{ $variant->price }}" placeholder="Price">
                            </div>
                            <div class="col-3">
                                <input type="number" name="stocks[]" class="form-control" value="{{ $variant->stock }}" placeholder="Stock">
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-danger remove-variant">
                                    <i class="ti ti-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-variant">
                        <i class="ti ti-plus"></i> Add Variant
                    </button>
                </div>
                
                <!-- Featured & Best Seller -->
                <div class="col-12 mb-3">
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" name="is_featured" class="form-check-input" id="featuredSwitch" value="1" {{ $product->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label" for="featuredSwitch">Featured Product</label>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_best_seller" class="form-check-input" id="bestSellerSwitch" value="1" {{ $product->is_best_seller ? 'checked' : '' }}>
                        <label class="form-check-label" for="bestSellerSwitch">Best Seller</label>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i> Update Product
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
    
    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-variant') || e.target.parentElement?.classList.contains('remove-variant')) {
            let btn = e.target.classList.contains('remove-variant') ? e.target : e.target.parentElement;
            btn.closest('.variant-row').remove();
        }
    });
</script>
@endpush
@endsection