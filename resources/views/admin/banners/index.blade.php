@extends('admin.layouts.app')

@section('title', 'Banners - EQUALITY Perfume')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
            <i class="ti ti-photo me-2"></i> Hero Banners
        </h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBannerModal">
            <i class="ti ti-plus me-1"></i> Add Banner
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset($banner->image) }}" class="product-thumb" alt="{{ $banner->title }}" style="width: 80px; height: 50px; object-fit: cover;">
                        </td>
                        <td><strong>{{ $banner->title }}</strong></td>
                        <td>{{ Str::limit($banner->subtitle, 40) }}</td>
                        <td>
                            <span class="status-badge {{ $banner->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $banner->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $banner->order }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#editBannerModal{{ $banner->id }}">
                                    <i class="ti ti-edit"></i>
                                </button>
                                <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" id="delete-form-{{ $banner->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="confirmDelete({{ $banner->id }})">
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
    </div>
</div>

<!-- Add Banner Modal -->
<div class="modal fade" id="addBannerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subtitle</label>
                        <input type="text" name="subtitle" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CTA Text</label>
                        <input type="text" name="cta_text" class="form-control" placeholder="Shop Now">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CTA Link</label>
                        <input type="url" name="cta_link" class="form-control" placeholder="https://...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                        <small class="text-muted">Recommended: 1920x1080px</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" name="order" class="form-control" value="{{ $banners->count() + 1 }}">
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_active" class="form-check-input" id="activeSwitch" checked>
                        <label class="form-check-label" for="activeSwitch">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Banner Modals -->
@foreach($banners as $banner)
<div class="modal fade" id="editBannerModal{{ $banner->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $banner->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subtitle</label>
                        <input type="text" name="subtitle" class="form-control" value="{{ $banner->subtitle }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CTA Text</label>
                        <input type="text" name="cta_text" class="form-control" value="{{ $banner->cta_text }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CTA Link</label>
                        <input type="url" name="cta_link" class="form-control" value="{{ $banner->cta_link }}">
                    </div>
                    @if($banner->image)
                    <div class="mb-3">
                        <label class="form-label">Current Image</label>
                        <div><img src="{{ asset($banner->image) }}" width="150" class="rounded"></div>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Change Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_active" class="form-check-input" id="editActiveSwitch{{ $banner->id }}" {{ $banner->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="editActiveSwitch{{ $banner->id }}">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endforeach
@endsection