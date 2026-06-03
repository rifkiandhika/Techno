@extends('layouts.app')

@section('title', 'Journal — EQUALITY Perfume')
@section('meta_description', 'Baca artikel menarik tentang parfum, tips memilih wewangian, dan review produk dari EQUALITY Perfume.')
@section('meta_keywords', 'blog parfum, tips parfum, review wewangian, edukasi aroma')

@section('content')

<!-- ── BREADCRUMB ─────────────────────────────────── -->
<div class="breadcrumb-bar" style="margin-top:60px;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Journal</li>
            </ol>
        </nav>
    </div>
</div>

<!-- ── PAGE HEADER ────────────────────────────────── -->
<div style="background: var(--ink); padding: 80px 0 70px; position: relative; overflow: hidden;">
    <div style="position:absolute; top:40px; right:80px; width:120px; height:1px; background:rgba(184,147,60,0.2);"></div>
    <div style="position:absolute; bottom:40px; left:80px; width:80px; height:1px; background:rgba(184,147,60,0.2);"></div>
    <div class="container">
        <div data-aos="fade-up">
            <span class="section-label" style="color:rgba(255,255,255,0.3);">Stories &amp; Insights</span>
            <h1 style="font-family:'Cormorant Garamond',serif; font-size:clamp(2.5rem,5vw,4rem); font-weight:300; color:white; line-height:1.1;">
                The EQUALITY<br><em>Journal</em>
            </h1>
        </div>
    </div>
</div>


<!-- ── MAIN CONTENT ───────────────────────────────── -->
<div class="container py-5">
    <div class="row g-5">

        <!-- SIDEBAR -->
        <div class="col-lg-3" data-aos="fade-right">
            <div class="filter-sidebar">
                <div class="filter-panel">

                    <!-- Search -->
                    <h6>Search</h6>
                    <form method="GET" action="{{ route('articles.index') }}" class="mb-4">
                        <div style="display:flex; gap:0;">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Search articles..."
                                   value="{{ request('search') }}"
                                   style="border-right:none; flex:1;">
                            <button class="btn-eq" type="submit"
                                    style="padding:0 14px; border-left:none; border:1px solid var(--rule); background:var(--ink); color:white; cursor:pointer;">
                                <i class="fas fa-search" style="font-size:0.78rem;"></i>
                            </button>
                        </div>
                    </form>

                    <div class="filter-divider"></div>

                    <!-- Categories -->
                    <h6>Categories</h6>
                    <div style="display:flex; flex-direction:column; gap:4px;">
                        <a href="{{ route('articles.index') }}"
                           style="display:block; padding:9px 14px; font-size:0.82rem; font-weight:300; color:{{ !request('category') ? 'white' : 'var(--muted)' }}; background:{{ !request('category') ? 'var(--ink)' : 'transparent' }}; border: 1px solid {{ !request('category') ? 'var(--ink)' : 'var(--rule)' }}; text-decoration:none; transition: all 0.2s;">
                            All Articles
                        </a>
                        @foreach($categories as $cat)
                        <a href="{{ route('articles.index', ['category' => $cat]) }}"
                           style="display:block; padding:9px 14px; font-size:0.82rem; font-weight:300; color:{{ request('category') == $cat ? 'white' : 'var(--muted)' }}; background:{{ request('category') == $cat ? 'var(--ink)' : 'transparent' }}; border: 1px solid {{ request('category') == $cat ? 'var(--ink)' : 'var(--rule)' }}; text-decoration:none; transition: all 0.2s;">
                            {{ $cat }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- ARTICLES GRID -->
        <div class="col-lg-9">

            @if($articles->count() > 0)

            <!-- Count row -->
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3"
                 style="border-bottom: 1px solid var(--rule);">
                <p style="font-size:0.82rem; color:var(--muted); font-weight:300; margin:0;">
                    {{ $articles->total() }} article{{ $articles->total() != 1 ? 's' : '' }}
                    @if(request('category')) in <strong style="color:var(--ink);">{{ request('category') }}</strong>@endif
                    @if(request('search')) matching <strong style="color:var(--ink);">"{{ request('search') }}"</strong>@endif
                </p>
            </div>

            <div class="row g-4">
                @foreach($articles as $article)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 60 }}">
                    <article style="background: white; border: 1px solid var(--rule); transition: transform 0.3s, border-color 0.3s; height:100%; display:flex; flex-direction:column;"
                             onmouseenter="this.style.transform='translateY(-4px)'; this.style.borderColor='var(--ink)'"
                             onmouseleave="this.style.transform=''; this.style.borderColor='var(--rule)'">

                        <!-- Image -->
                        <div style="overflow:hidden; flex-shrink:0;">
                            <img src="{{ asset('storage/' . $article->featured_image) }}"
                                 alt="{{ $article->title }}"
                                 style="width:100%; height:200px; object-fit:cover; display:block; transition: transform 0.5s ease;">
                        </div>

                        <!-- Body -->
                        <div style="padding: 20px; display:flex; flex-direction:column; flex:1;">
                            <span style="font-size:0.63rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--gold); display:block; margin-bottom:8px;">
                                {{ $article->category }}
                            </span>
                            <h5 style="font-family:'Cormorant Garamond',serif; font-size:1.1rem; font-weight:400; color:var(--ink); line-height:1.35; margin-bottom:10px;">
                                {{ Str::limit($article->title, 55) }}
                            </h5>
                            <p style="font-size:0.82rem; color:var(--muted); font-weight:300; line-height:1.65; margin-bottom:16px; flex:1;">
                                {{ Str::limit($article->excerpt, 90) }}
                            </p>
                            <div style="display:flex; justify-content:space-between; align-items:center; padding-top:14px; border-top:1px solid var(--rule); margin-top:auto;">
                                <span style="font-size:0.72rem; color:var(--muted); font-weight:300;">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $article->published_at->format('d M Y') }}
                                </span>
                                <a href="{{ route('articles.show', $article->slug) }}"
                                   class="btn-eq-outline"
                                   style="padding:6px 14px; font-size:0.65rem;">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $articles->links() }}
            </div>

            @else
            <div class="text-center py-5">
                <div style="width:70px; height:70px; border:1px solid var(--rule); display:flex; align-items:center; justify-content:center; margin:0 auto 24px;">
                    <i class="fas fa-newspaper" style="font-size:1.5rem; color:var(--gold-light);"></i>
                </div>
                <h4 style="font-family:'Cormorant Garamond',serif; font-weight:400; font-size:1.5rem; margin-bottom:10px;">No Articles Found</h4>
                <p style="color:var(--muted); font-size:0.88rem; margin-bottom:28px;">Check back later for new content.</p>
                <a href="{{ route('articles.index') }}" class="btn-eq">View All Articles</a>
            </div>
            @endif

        </div>
    </div>
</div>

@endsection