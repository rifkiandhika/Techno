@extends('layouts.app')

@section('title', 'All Products — EQUALITY Perfume')
@section('meta_description', 'Koleksi lengkap parfum EQUALITY untuk pria dan wanita. Temukan wewangian favorit Anda dengan harga terbaik.')
@section('meta_keywords', 'koleksi parfum, beli parfum online, parfum pria, parfum wanita')

@section('content')

<!-- ── BREADCRUMB ─────────────────────────────────── -->
<div class="breadcrumb-bar" style="margin-top:60px;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </nav>
    </div>
</div>

<!-- ── PAGE HEADER ────────────────────────────────── -->
<div class="bg-cream" style="padding: 48px 0; border-bottom: 1px solid var(--rule);">
    <div class="container">
        <span class="section-label">EQUALITY Collection</span>
        <h1 class="section-heading" style="margin-bottom:0;">All Products</h1>
    </div>
</div>


<!-- ── MAIN CONTENT ───────────────────────────────── -->
<div class="container py-5">
    <div class="row g-4">

        <!-- SIDEBAR FILTER -->
        <div class="col-lg-3">
            <div class="filter-sidebar">
                <div class="filter-panel">
                    <h6>Filter &amp; Search</h6>

                    <form method="GET" action="{{ route('products.index') }}" id="filterForm">

                        <!-- Search -->
                        <div class="mb-4">
                            <label style="font-size:0.68rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);">Search</label>
                            <div class="input-group mt-2" style="gap:0;">
                                <input type="text" name="search" class="form-control" placeholder="Product name..." value="{{ request('search') }}"
                                       style="border-right:none;">
                                <button class="btn-eq" type="submit" style="padding:0 16px; border-left:none;">
                                    <i class="fas fa-search" style="font-size:0.8rem;"></i>
                                </button>
                            </div>
                        </div>

                        <div class="filter-divider"></div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label style="font-size:0.68rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);" class="d-block mb-2">Category</label>
                            <select name="category" class="form-select" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Gender -->
                        <div class="mb-4">
                            <label style="font-size:0.68rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);" class="d-block mb-2">Gender</label>
                            <select name="gender" class="form-select" onchange="this.form.submit()">
                                <option value="">All</option>
                                <option value="male"   {{ request('gender') == 'male'   ? 'selected' : '' }}>Men</option>
                                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Women</option>
                                <option value="unisex" {{ request('gender') == 'unisex' ? 'selected' : '' }}>Unisex</option>
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-4">
                            <label style="font-size:0.68rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);" class="d-block mb-2">Price Range (Rp)</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ request('min_price') }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ request('max_price') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Size -->
                        <div class="mb-4">
                            <label style="font-size:0.68rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);" class="d-block mb-2">Size (ml)</label>
                            <select name="size" class="form-select" onchange="this.form.submit()">
                                <option value="">All Sizes</option>
                                <option value="30"  {{ request('size') == '30'  ? 'selected' : '' }}>30 ml</option>
                                <option value="50"  {{ request('size') == '50'  ? 'selected' : '' }}>50 ml</option>
                                <option value="100" {{ request('size') == '100' ? 'selected' : '' }}>100 ml</option>
                            </select>
                        </div>

                        <div class="filter-divider"></div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn-eq" style="border:none;cursor:pointer;width:100%;justify-content:center;">
                                Apply Filters
                            </button>
                            <a href="{{ route('products.index') }}" class="btn-eq-outline" style="text-align:center;justify-content:center;">
                                Reset All
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- PRODUCT GRID -->
        <div class="col-lg-9">
            <!-- Count row -->
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3" style="border-bottom: 1px solid var(--rule);">
                <h4 style="font-family:'DM Sans',sans-serif; font-size:0.85rem; font-weight:400; color:var(--muted); margin:0; letter-spacing:0.05em;">
                    Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}
                    <span style="color:var(--ink);">of {{ $products->total() }}</span> products
                </h4>
            </div>

            @if($products->count() > 0)
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-md-4 col-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 6) * 40 }}">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                            @if($product->is_best_seller)
                                <span class="card-badge">Best Seller</span>
                            @elseif($product->is_featured)
                                <span class="card-badge gold">Featured</span>
                            @endif
                            <div class="wishlist-btn"><i class="far fa-heart" style="font-size:0.8rem;"></i></div>
                        </div>
                        <div class="card-body">
                            <p class="cat-label">
                                {{ $product->category->name ?? 'Uncategorized' }}
                                <span style="margin-left:6px; color:var(--rule);">·</span>
                                <span style="margin-left:6px;">
                                    @if($product->gender == 'male') Men
                                    @elseif($product->gender == 'female') Women
                                    @else Unisex @endif
                                </span>
                            </p>
                            <h5>{{ Str::limit($product->name, 38) }}</h5>
                            <div class="card-footer-row">
                                <span class="price">Rp {{ number_format($product->lowest_price, 0, ',', '.') }}</span>
                                <a href="{{ route('products.show', $product->slug) }}" class="btn-eq-outline" style="padding:7px 14px; font-size:0.65rem;">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $products->links() }}
            </div>

            @else
            <div class="text-center py-5">
                <div style="width:70px;height:70px;border:1px solid var(--rule);display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
                    <i class="fas fa-box-open" style="font-size:1.5rem; color:var(--gold-light);"></i>
                </div>
                <h4 style="font-family:'Cormorant Garamond',serif; font-weight:400; font-size:1.5rem; margin-bottom:10px;">No Products Found</h4>
                <p style="color:var(--muted); font-size:0.88rem; margin-bottom:28px;">Try adjusting your filters or search terms.</p>
                <a href="{{ route('products.index') }}" class="btn-eq">
                    View All Products
                </a>
            </div>
            @endif
        </div>

    </div>
</div>

@endsection