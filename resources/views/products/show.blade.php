@extends('layouts.app')

@section('title', $product->name . ' — EQUALITY Perfume')
@section('meta_description', strip_tags($product->description))
@section('meta_keywords', $product->name . ', parfum, wewangian, ' . ($product->category->name ?? ''))

@section('content')

<!-- ── BREADCRUMB ─────────────────────────────────── -->
<div class="breadcrumb-bar" style="margin-top:60px;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('products.index', ['category' => $product->category->slug ?? '']) }}">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </a>
                </li>
                <li class="breadcrumb-item active">{{ Str::limit($product->name, 30) }}</li>
            </ol>
        </nav>
    </div>
</div>


<!-- ── PRODUCT DETAIL ─────────────────────────────── -->
<div class="container py-5">
    <div class="row g-5">

        <!-- GALLERY -->
        <div class="col-lg-6" data-aos="fade-right">
            <div class="swiper product-gallery mb-3" style="border: 1px solid var(--rule);">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}"
                             style="width:100%; aspect-ratio:1/1; object-fit:cover; display:block;">
                    </div>
                    @foreach($product->galleries as $gallery)
                    <div class="swiper-slide">
                        <img src="{{ asset($gallery->image) }}" alt="{{ $product->name }}"
                             style="width:100%; aspect-ratio:1/1; object-fit:cover; display:block;">
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>

            @if($product->galleries->count() > 0)
            <div class="row g-2">
                <div class="col-3">
                    <img src="{{ asset($product->thumbnail) }}"
                         class="img-fluid gallery-thumb" style="aspect-ratio:1/1; object-fit:cover; width:100%;"
                         onclick="gallerySwiper.slideTo(0)">
                </div>
                @foreach($product->galleries->take(3) as $index => $gallery)
                <div class="col-3">
                    <img src="{{ asset($gallery->image) }}"
                         class="img-fluid gallery-thumb" style="aspect-ratio:1/1; object-fit:cover; width:100%;"
                         onclick="gallerySwiper.slideTo({{ $index + 1 }})">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- INFO -->
        <div class="col-lg-6" data-aos="fade-left">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span style="font-size:0.65rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--muted);">
                    {{ $product->category->name ?? 'Uncategorized' }}
                </span>
                <span style="color:var(--rule);">·</span>
                <span style="font-size:0.65rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted);">
                    @if($product->gender == 'male') For Men
                    @elseif($product->gender == 'female') For Women
                    @else Unisex @endif
                </span>
                @if($product->is_best_seller)
                <span style="color:var(--rule);">·</span>
                <span style="font-size:0.63rem; letter-spacing:0.1em; text-transform:uppercase; padding:3px 10px; background:var(--ink); color:white;">Best Seller</span>
                @endif
            </div>

            <h1 style="font-family:'Cormorant Garamond',serif; font-size:clamp(2rem,4vw,2.8rem); font-weight:400; line-height:1.15; color:var(--ink); margin-bottom:6px;">
                {{ $product->name }}
            </h1>

            <p style="font-size:0.78rem; color:var(--muted); margin-bottom:28px;">
                <i class="fas fa-eye me-1"></i> {{ number_format($product->views) }} views
            </p>

            <!-- Description -->
            <p style="font-size:0.9rem; color:var(--muted); font-weight:300; line-height:1.8; margin-bottom:32px; padding-bottom:28px; border-bottom: 1px solid var(--rule);">
                {{ $product->description }}
            </p>

            <!-- Variants -->
            <h6 style="font-size:0.68rem; letter-spacing:0.18em; text-transform:uppercase; color:var(--muted); margin-bottom:16px;">
                Available Sizes &amp; Pricing
            </h6>

            @foreach($product->variants as $variant)
            <div class="variant-row">
                <div class="d-flex align-items-center gap-3">
                    <span class="variant-size">{{ $variant->size }} <span style="font-size:0.75rem; color:var(--muted);">ml</span></span>
                    @if($variant->stock <= 0)
                        <span class="stock-tag stock-out">Out of Stock</span>
                    @elseif($variant->stock <= 10)
                        <span class="stock-tag stock-low">Only {{ $variant->stock }} left</span>
                    @else
                        <span class="stock-tag stock-ok">In Stock</span>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="variant-price">Rp {{ number_format($variant->price, 0, ',', '.') }}</span>
                    @if($variant->stock > 0)
                    <a href="https://wa.me/{{ $contact->whatsapp ?? '628123456789' }}?text=Halo%20EQUALITY%20Perfume%2C%20saya%20tertarik%20dengan%20{{ urlencode($product->name) }}%20({{ $variant->size }}ml)%20harga%20Rp%20{{ number_format($variant->price, 0, ',', '.') }}"
                       class="btn-wa" target="_blank" style="padding:9px 16px; font-size:0.68rem;">
                        <i class="fab fa-whatsapp"></i> Order
                    </a>
                    @endif
                </div>
            </div>
            @endforeach

            <!-- Quick contact -->
            <p style="font-size:0.78rem; color:var(--muted); margin-top:16px;">
                <i class="fas fa-info-circle me-1 text-gold"></i>
                Hubungi kami via WhatsApp untuk pemesanan dan pertanyaan.
            </p>
        </div>
    </div>


    <!-- ── FRAGRANCE PYRAMID ──────────────────────── -->
    @if($product->top_notes || $product->middle_notes || $product->base_notes)
    <div class="mt-5 pt-4" style="border-top: 1px solid var(--rule);" data-aos="fade-up">
        <div class="text-center mb-4">
            <span class="section-label">Scent Profile</span>
            <h3 class="section-heading" style="font-size:1.8rem;">Fragrance Pyramid</h3>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="frag-note">
                    <h6>Top Notes</h6>
                    <p>{{ $product->top_notes ?? '—' }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="frag-note" style="border-top: 2px solid var(--gold);">
                    <h6>Middle Notes</h6>
                    <p>{{ $product->middle_notes ?? '—' }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="frag-note">
                    <h6>Base Notes</h6>
                    <p>{{ $product->base_notes ?? '—' }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif


    <!-- ── PERFORMANCE ────────────────────────────── -->
    @if($product->longevity || $product->sillage || $product->projection)
    <div class="mt-5 pt-4" style="border-top: 1px solid var(--rule);" data-aos="fade-up">
        <div class="text-center mb-4">
            <span class="section-label">Fragrance Data</span>
            <h3 class="section-heading" style="font-size:1.8rem;">Performance</h3>
        </div>
        <div class="row justify-content-center">
            @if($product->longevity)
            <div class="col-lg-3 col-md-4 mb-4 text-center">
                <p style="font-size:0.68rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--muted); margin-bottom:10px;">Longevity</p>
                <div class="perf-meter"><div class="perf-fill" style="width:{{ min(100, ($product->longevity / 12) * 100) }}%;"></div></div>
                <p style="font-size:0.82rem; color:var(--ink); margin-top:6px;">{{ $product->longevity }} hours</p>
            </div>
            @endif
            @if($product->sillage)
            <div class="col-lg-3 col-md-4 mb-4 text-center">
                <p style="font-size:0.68rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--muted); margin-bottom:10px;">Sillage</p>
                <div class="perf-meter"><div class="perf-fill" style="width:{{ ($product->sillage / 10) * 100 }}%;"></div></div>
                <p style="font-size:0.82rem; color:var(--ink); margin-top:6px;">{{ $product->sillage }}/10</p>
            </div>
            @endif
            @if($product->projection)
            <div class="col-lg-3 col-md-4 mb-4 text-center">
                <p style="font-size:0.68rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--muted); margin-bottom:10px;">Projection</p>
                <div class="perf-meter"><div class="perf-fill" style="width:{{ ($product->projection / 10) * 100 }}%;"></div></div>
                <p style="font-size:0.82rem; color:var(--ink); margin-top:6px;">{{ $product->projection }}/10</p>
            </div>
            @endif
        </div>
    </div>
    @endif


    <!-- ── RELATED PRODUCTS ───────────────────────── -->
    @if($relatedProducts->count() > 0)
    <div class="mt-5 pt-4" style="border-top: 1px solid var(--rule);">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <span class="section-label">More From This Collection</span>
                <h3 class="section-heading" style="font-size:1.8rem; margin:0;">You May Also Like</h3>
            </div>
            <a href="{{ route('products.index') }}" class="btn-eq-outline" style="flex-shrink:0;">View All</a>
        </div>
        <div class="row g-4">
            @foreach($relatedProducts as $related)
            <div class="col-lg-3 col-md-4 col-6">
                <div class="product-card">
                    <div class="img-wrap">
                        <img src="{{ asset($related->thumbnail) }}" alt="{{ $related->name }}"
                             style="height:220px; object-fit:cover;">
                    </div>
                    <div class="card-body">
                        <h5>{{ Str::limit($related->name, 30) }}</h5>
                        <div class="card-footer-row">
                            <span class="price">Rp {{ number_format($related->lowest_price, 0, ',', '.') }}</span>
                            <a href="{{ route('products.show', $related->slug) }}" class="btn-eq-outline" style="padding:7px 14px; font-size:0.65rem;">View</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

@push('scripts')
<script>
    const gallerySwiper = new Swiper('.product-gallery', {
        loop: true,
        pagination: { el: '.swiper-pagination', clickable: true },
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    });

    document.querySelectorAll('.gallery-thumb').forEach((thumb, idx) => {
        thumb.addEventListener('click', function() {
            document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endpush
@endsection