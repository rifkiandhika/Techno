@extends('layouts.app')

@section('title', 'EQUALITY Perfume — Wewangian Premium untuk Semua')
@section('meta_description', 'Temukan koleksi parfum terbaik dari EQUALITY Perfume. Aroma tahan lama, bahan berkualitas, harga terjangkau. Untuk pria dan wanita.')
@section('meta_keywords', 'parfum, wewangian, equality perfume, toko parfum, parfum original')

@section('content')

<!-- ── HERO BANNER ───────────────────────────────── -->
@if($banners->count() > 0)
<div class="swiper hero-swiper">
    <div class="swiper-wrapper">
        @foreach($banners as $banner)
        <div class="swiper-slide">
            <div class="hero-slide" style="background-image: url('{{ asset($banner->image) }}');">
                <div class="container px-4 px-lg-5">
                    <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                        <span class="hero-eyebrow">EQUALITY Perfume</span>
                        <h1>{{ $banner->title }}</h1>
                        @if($banner->subtitle)
                        <p class="lead">{{ $banner->subtitle }}</p>
                        @endif
                        @if($banner->cta_text && $banner->cta_link)
                        <a href="{{ $banner->cta_link }}" class="btn-dark-eq">
                            {{ $banner->cta_text }}
                            <i class="fas fa-arrow-right" style="font-size:0.7rem"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
@else
<!-- Fallback hero when no banners -->
<div class="hero-slide" style="background: linear-gradient(135deg, #1c1410 0%, #3d2f27 100%); min-height: 85vh;">
    <div class="container px-4 px-lg-5">
        <div class="hero-content" data-aos="fade-up">
            <span class="hero-eyebrow">Est. Indonesia</span>
            <h1>The Art of<br><em>Fine Fragrance</em></h1>
            <p class="lead">Wewangian berkualitas premium yang dapat dinikmati oleh semua kalangan.</p>
            <a href="{{ route('products.index') }}" class="btn-dark-eq">
                Explore Collection <i class="fas fa-arrow-right" style="font-size:0.7rem"></i>
            </a>
        </div>
    </div>
</div>
@endif


<!-- ── WHY CHOOSE US — STRIP ─────────────────────── -->
<div style="background: var(--cream); border-bottom: 1px solid var(--rule);">
    <div class="container">
        <div class="row text-center g-0">
            <div class="col-6 col-md-3" style="padding: 28px 16px; border-right: 1px solid var(--rule);">
                <i class="fas fa-leaf" style="font-size:1.1rem; color:var(--gold); margin-bottom:8px; display:block;"></i>
                <p style="font-size:0.72rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--ink); margin:0; font-weight:400;">Natural Ingredients</p>
            </div>
            <div class="col-6 col-md-3" style="padding: 28px 16px; border-right: 1px solid var(--rule);">
                <i class="fas fa-truck-fast" style="font-size:1.1rem; color:var(--gold); margin-bottom:8px; display:block;"></i>
                <p style="font-size:0.72rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--ink); margin:0; font-weight:400;">Fast Shipping</p>
            </div>
            <div class="col-6 col-md-3" style="padding: 28px 16px; border-right: 1px solid var(--rule);">
                <i class="fas fa-check-circle" style="font-size:1.1rem; color:var(--gold); margin-bottom:8px; display:block;"></i>
                <p style="font-size:0.72rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--ink); margin:0; font-weight:400;">100% Original</p>
            </div>
            <div class="col-6 col-md-3" style="padding: 28px 16px;">
                <i class="fas fa-headset" style="font-size:1.1rem; color:var(--gold); margin-bottom:8px; display:block;"></i>
                <p style="font-size:0.72rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--ink); margin:0; font-weight:400;">24/7 Support</p>
            </div>
        </div>
    </div>
</div>


<!-- ── FEATURED PRODUCTS ─────────────────────────── -->
<section class="py-5 mt-3">
    <div class="container">
        <div class="row align-items-end mb-5">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="section-label">Curated Selection</span>
                <h2 class="section-heading">Featured Products</h2>
                <p style="font-size:0.9rem; color:var(--muted); font-weight:300; margin:0;">Pilihan terbaik dari koleksi kami, dipilih dengan cermat untuk Anda.</p>
            </div>
            <div class="col-lg-5 text-lg-end mt-3 mt-lg-0" data-aos="fade-left">
                <a href="{{ route('products.index') }}" class="btn-eq-outline">
                    View All Products <i class="fas fa-arrow-right" style="font-size:0.7rem"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            @forelse($featuredProducts as $product)
            <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                <div class="product-card">
                    <div class="img-wrap">
                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}">
                        <span class="card-badge gold">Featured</span>
                        <div class="wishlist-btn"><i class="far fa-heart" style="font-size:0.85rem"></i></div>
                    </div>
                    <div class="card-body">
                        <p class="cat-label">{{ $product->category->name ?? 'Uncategorized' }}</p>
                        <h5>{{ $product->name }}</h5>
                        <div class="card-footer-row">
                            <span class="price">Rp {{ number_format($product->lowest_price, 0, ',', '.') }}</span>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn-eq-outline" style="padding:7px 16px; font-size:0.68rem;">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p style="color:var(--muted)">No featured products available.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>


<!-- ── BEST SELLERS ───────────────────────────────── -->
<section class="py-5 bg-cream">
    <div class="container">
        <div class="row align-items-end mb-5">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="section-label">Customer Favourites</span>
                <h2 class="section-heading">Best Sellers</h2>
                <p style="font-size:0.9rem; color:var(--muted); font-weight:300; margin:0;">Produk favorit pelanggan setia kami.</p>
            </div>
        </div>

        <div class="row g-4">
            @forelse($bestSellers as $product)
            <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                <div class="product-card" style="background: white;">
                    <div class="img-wrap">
                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}">
                        <span class="card-badge">Best Seller</span>
                        <div class="wishlist-btn"><i class="far fa-heart" style="font-size:0.85rem"></i></div>
                    </div>
                    <div class="card-body">
                        <p class="cat-label">{{ $product->category->name ?? 'Uncategorized' }}</p>
                        <h5>{{ $product->name }}</h5>
                        <div class="card-footer-row">
                            <span class="price">Rp {{ number_format($product->lowest_price, 0, ',', '.') }}</span>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn-eq-outline" style="padding:7px 16px; font-size:0.68rem;">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p style="color:var(--muted)">No best sellers available.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>


<!-- ── ABOUT BRAND ────────────────────────────────── -->
@if($aboutUs && ($aboutUs->brand_history || $aboutUs->vision))
<section class="py-5" style="margin: 40px 0;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                @if($aboutUs->founder_photo)
                <img src="{{ asset($aboutUs->founder_photo) }}" class="img-fluid" alt="Founder"
                     style="width:100%; aspect-ratio:4/5; object-fit:cover; display:block;">
                @else
                <div style="background:var(--cream); aspect-ratio:4/5; display:flex; align-items:center; justify-content:center; border: 1px solid var(--rule);">
                    <i class="fas fa-spa fa-3x" style="color:var(--gold-light)"></i>
                </div>
                @endif
            </div>
            <div class="col-lg-6 offset-lg-1" data-aos="fade-left">
                <span class="section-label">Our Story</span>
                <h2 class="section-heading">The EQUALITY<br><em>Philosophy</em></h2>
                <div class="section-rule left"></div>
                <p style="font-size:0.95rem; color:var(--muted); font-weight:300; line-height:1.8; margin-bottom:20px;">
                    {{ Str::limit($aboutUs->brand_history ?? 'EQUALITY Perfume menghadirkan wewangian berkualitas untuk semua kalangan.', 280) }}
                </p>
                @if($aboutUs->vision)
                <blockquote style="border-left: 2px solid var(--gold); padding-left: 20px; margin: 24px 0;">
                    <p style="font-family:'Cormorant Garamond',serif; font-size:1.1rem; font-style:italic; color:var(--ink); margin:0;">
                        {{ $aboutUs->vision }}
                    </p>
                </blockquote>
                @endif
                <a href="{{ route('about') }}" class="btn-eq mt-2">
                    Read Our Story <i class="fas fa-arrow-right" style="font-size:0.7rem"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endif


<!-- ── TESTIMONIALS ───────────────────────────────── -->
@if($testimonials->count() > 0)
<section class="py-5 bg-cream">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-label">Reviews</span>
            <h2 class="section-heading">What Our Customers Say</h2>
            <div class="section-rule"></div>
        </div>

        <div class="row g-4">
            @foreach($testimonials as $testimonial)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="testi-card">
                    <div class="quote-mark">"</div>
                    <p>{{ $testimonial->review }}</p>
                    <div class="star-row mb-12" style="margin-bottom:12px;">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $testimonial->rating ? '' : 'muted-star' }}"></i>
                        @endfor
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        @if($testimonial->photo)
                        <img src="{{ asset($testimonial->photo) }}" width="40" height="40"
                             style="border-radius:50%; object-fit:cover; border: 1px solid var(--rule);">
                        @else
                        <div style="width:40px;height:40px;border-radius:50%;background:var(--cream);border:1px solid var(--rule);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-user" style="font-size:0.8rem;color:var(--muted)"></i>
                        </div>
                        @endif
                        <span class="reviewer-name">{{ $testimonial->name }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


<!-- ── NEWSLETTER ─────────────────────────────────── -->
<section class="newsletter-section">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <span class="section-label" style="color:rgba(255,255,255,0.35);">Stay Updated</span>
            <h3>Dapatkan Penawaran Eksklusif</h3>
            <p>Informasi promo dan koleksi terbaru langsung ke email Anda</p>
            <div class="newsletter-input-group">
                <input type="email" placeholder="Email address">
                <button type="button">Subscribe</button>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.querySelectorAll('.wishlist-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const icon = this.querySelector('i');
            icon.classList.toggle('far');
            icon.classList.toggle('fas');
            if (icon.classList.contains('fas')) icon.style.color = '#9c3333';
            else icon.style.color = '';
        });
    });
</script>
@endpush