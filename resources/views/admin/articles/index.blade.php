@extends('admin.layouts.app')

@section('title', 'Articles - EQUALITY Perfume')

@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
            <i class="ti ti-news me-2"></i> Blog Articles
        </h5>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Write Article
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $article->featured_image) }}" class="product-thumb" alt="{{ $article->title }}" style="width: 60px; height: 40px; object-fit: cover;">
                         </td>
                        <td><strong>{{ Str::limit($article->title, 40) }}</strong></td>
                        <td><span class="badge bg-info">{{ $article->category }}</span></td>
                        <td>{{ number_format($article->views) }} views</td>
                        <td>
                            <span class="status-badge {{ $article->is_published ? 'status-active' : 'status-inactive' }}">
                                {{ $article->is_published ? 'Published' : 'Draft' }}
                            </span>
                         </td>
                        <td>
                            @if($article->published_at)
                            {{ $article->published_at->format('d M Y') }}
                            @else
                            <span class="text-muted">-</span>
                            @endif
                         </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-icon btn-primary">
                                    <i class="ti ti-edit"></i>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" id="delete-form-{{ $article->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="confirmDelete({{ $article->id }})">
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
</div>
@endsection