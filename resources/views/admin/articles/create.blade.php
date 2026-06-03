@extends('admin.layouts.app')

@section('title', 'Write Article - EQUALITY Perfume')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="ti ti-pencil me-2"></i> Write New Article
        </h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select" required>
                        <option value="Tips Parfum">Tips Parfum</option>
                        <option value="Lifestyle">Lifestyle</option>
                        <option value="Review Produk">Review Produk</option>
                        <option value="Edukasi Aroma">Edukasi Aroma</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control" rows="15" required></textarea>
                    <small class="text-muted">You can use HTML tags for formatting.</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="form-control" accept="image/*" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <div class="form-check form-switch mt-2">
                        <input type="checkbox" name="is_published" class="form-check-input" id="publishSwitch">
                        <label class="form-check-label" for="publishSwitch">Publish immediately</label>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i> Save Article
                </button>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
</div>
@endsection