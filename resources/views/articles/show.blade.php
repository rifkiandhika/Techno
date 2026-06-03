@extends('admin.layouts.app')

@section('title', $article->title . ' - EQUALITY Perfume')

@section('meta_description', Str::limit(strip_tags($article->content), 160))
@section('meta_keywords', $article->category . ', parfum, wewangian, tips parfum, review parfum')

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-wrapper">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('articles.index') }}" class="text-decoration-none">Blog</a></li>
                <li class="breadcrumb-item"><a href="{{ route('articles.index', ['category' => $article->category]) }}" class="text-decoration-none">{{ $article->category }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 40) }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <article data-aos="fade-up">
                <div class="text-center mb-4">
                    <span class="badge bg-secondary mb-3 px-3 py-2">{{ $article->category }}</span>
                    <h1 class="display-5 fw-bold mb-3">{{ $article->title }}</h1>
                    <div class="text-muted">
                        <span><i class="fas fa-calendar-alt me-1"></i> {{ $article->published_at->format('d F Y') }}</span>
                        <span class="mx-2">|</span>
                        <span><i class="fas fa-eye me-1"></i> {{ number_format($article->views) }} views</span>
                    </div>
                </div>
                
                <img src="{{ asset('storage/' . $article->featured_image) }}" class="img-fluid rounded-4 mb-4 w-100 shadow-sm" alt="{{ $article->title }}">
                
                <div class="article-content" style="font-size: 1.1rem; line-height: 1.8;">
                    {!! nl2br(e($article->content)) !!}
                </div>
            </article>
            
            <!-- Share Section -->
            <div class="mt-5 pt-3 text-center border-top">
                <h6>Share this article</h6>
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . route('articles.show', $article->slug)) }}" target="_blank" class="btn btn-success rounded-pill">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articles.show', $article->slug)) }}" target="_blank" class="btn btn-primary rounded-pill">
                        <i class="fab fa-facebook"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('articles.show', $article->slug)) }}&text={{ urlencode($article->title) }}" target="_blank" class="btn btn-info rounded-pill text-white">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="text-center mb-4">Related Articles</h3>
            <div class="row">
                @foreach($relatedArticles as $related)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4">
                        <img src="{{ asset('storage/' . $related->featured_image) }}" class="card-img-top" alt="{{ $related->title }}" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">{{ Str::limit($related->title, 50) }}</h6>
                            <a href="{{ route('articles.show', $related->slug) }}" class="btn btn-sm btn-outline-primary rounded-pill mt-2">
                                Read More <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    .article-content p {
        margin-bottom: 1.5rem;
    }
    .article-content h2, .article-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
</style>
@endsection