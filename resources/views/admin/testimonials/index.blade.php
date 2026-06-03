@extends('admin.layouts.app')

@section('title', 'Testimonials - EQUALITY Perfume')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
            <i class="ti ti-star me-2"></i> Customer Testimonials
        </h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
            <i class="ti ti-plus me-1"></i> Add Testimonial
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Review</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $testimonial)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($testimonial->photo)
                            <img src="{{ asset('storage/' . $testimonial->photo) }}" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                            @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="ti ti-user ti-sm"></i>
                            </div>
                            @endif
                        </td>
                        <td><strong>{{ $testimonial->name }}</strong></td>
                        <td>{{ Str::limit($testimonial->review, 50) }}</td>
                        <td>
                            <div class="text-warning">
                                @for($i=1; $i<=5; $i++)
                                    <i class="ti ti-star-filled {{ $i <= $testimonial->rating ? '' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                        </td>
                        <td>
                            <span class="status-badge {{ $testimonial->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#editTestimonialModal{{ $testimonial->id }}">
                                    <i class="ti ti-edit"></i>
                                </button>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" id="delete-form-{{ $testimonial->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="confirmDelete({{ $testimonial->id }})">
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

<!-- Add Testimonial Modal -->
<div class="modal fade" id="addTestimonialModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Review</label>
                        <textarea name="review" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select name="rating" class="form-select">
                            <option value="5">★★★★★ (5)</option>
                            <option value="4">★★★★☆ (4)</option>
                            <option value="3">★★★☆☆ (3)</option>
                            <option value="2">★★☆☆☆ (2)</option>
                            <option value="1">★☆☆☆☆ (1)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_active" class="form-check-input" id="testimonialActiveSwitch" checked>
                        <label class="form-check-label" for="testimonialActiveSwitch">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Testimonial</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Testimonial Modals -->
@foreach($testimonials as $testimonial)
<div class="modal fade" id="editTestimonialModal{{ $testimonial->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $testimonial->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Review</label>
                        <textarea name="review" class="form-control" rows="3" required>{{ $testimonial->review }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select name="rating" class="form-select">
                            @for($i=5; $i>=1; $i--)
                            <option value="{{ $i }}" {{ $testimonial->rating == $i ? 'selected' : '' }}>{{ str_repeat('★', $i) . str_repeat('☆', 5-$i) }} ({{ $i }})</option>
                            @endfor
                        </select>
                    </div>
                    @if($testimonial->photo)
                    <div class="mb-3">
                        <label class="form-label">Current Photo</label>
                        <div><img src="{{ asset('storage/' . $testimonial->photo) }}" width="80" class="rounded-circle"></div>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Change Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_active" class="form-check-input" id="editTestimonialSwitch{{ $testimonial->id }}" {{ $testimonial->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="editTestimonialSwitch{{ $testimonial->id }}">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Testimonial</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endforeach
@endsection