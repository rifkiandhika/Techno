@extends('admin.layouts.app')

@section('title', 'Product Gallery - EQUALITY Perfume')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
            <i class="ti ti-photo me-2"></i> Gallery: {{ $product->name }}
        </h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGalleryModal">
            <i class="ti ti-plus me-1"></i> Add Images
        </button>
    </div>
    <div class="card-body">
        @if($galleries->count() > 0)
        <div class="row" id="gallery-sortable">
            @foreach($galleries as $gallery)
            <div class="col-md-3 mb-3" data-id="{{ $gallery->id }}">
                <div class="card">
                    <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                    <div class="card-body p-2 text-center">
                        <span class="badge bg-secondary mb-2">{{ ucfirst($gallery->type) }}</span>
                        <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')">
                                <i class="ti ti-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="ti ti-photo-off ti-3x text-muted mb-3 d-block"></i>
            <p>No images yet. Click "Add Images" to upload.</p>
        </div>
        @endif
    </div>
</div>

<!-- Add Gallery Modal -->
<div class="modal fade" id="addGalleryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.gallery.store', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Gallery Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Image Type</label>
                        <select name="type" class="form-select" required>
                            <option value="thumbnail">Thumbnail</option>
                            <option value="packaging">Packaging</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="detail">Detail Product</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Images (multiple)</label>
                        <input type="file" name="images[]" class="form-control" accept="image/*" multiple required>
                        <small class="text-muted">You can select multiple images at once.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Upload Images</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    // Make gallery sortable
    new Sortable(document.getElementById('gallery-sortable'), {
        animation: 150,
        onEnd: function() {
            let order = [];
            document.querySelectorAll('#gallery-sortable .col-md-3').forEach((el, index) => {
                order.push({
                    id: el.dataset.id,
                    order: index + 1
                });
            });
            
            fetch('{{ route("admin.gallery.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ orders: order })
            });
        }
    });
</script>
@endpush
@endsection