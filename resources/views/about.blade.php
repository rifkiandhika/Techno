@extends('layouts.app')

@section('title', 'About Us — EQUALITY Perfume')
@section('meta_description', 'Pelajari lebih lanjut tentang EQUALITY Perfume, brand parfum lokal dengan wewangian berkualitas.')
@section('meta_keywords', 'about equality, profil perusahaan, sejarah parfum')

@section('content')

<!-- ── BREADCRUMB ─────────────────────────────────── -->
<div class="breadcrumb-bar" style="margin-top:60px;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">About Us</li>
            </ol>
        </nav>
    </div>
</div>

<!-- ── PAGE HERO ──────────────────────────────────── -->
<div style="background: var(--ink); padding: 80px 0 70px; position: relative; overflow: hidden;">
    <!-- Decorative lines -->
    <div style="position:absolute; top:40px; right:80px; width:120px; height:1px; background:rgba(184,147,60,0.25);"></div>
    <div style="position:absolute; bottom:40px; left:80px; width:80px; height:1px; background:rgba(184,147,60,0.25);"></div>
    <div class="container">
        <div data-aos="fade-up">
            <span class="section-label" style="color:rgba(255,255,255,0.3);">Our Heritage</span>
            <h1 style="font-family:'Cormorant Garamond',serif; font-size:clamp(2.5rem,5vw,4rem); font-weight:300; color:white; line-height:1.1;">
                About <em>EQUALITY</em><br>Perfume
            </h1>
        </div>
    </div>
</div>


<!-- ── STORY & VISION ─────────────────────────────── -->
<div class="container py-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-5" data-aos="fade-right">
            @if($aboutUs->founder_photo)
            <img src="{{ asset($aboutUs->founder_photo) }}" class="img-fluid"
                 style="width:100%; aspect-ratio:3/4; object-fit:cover; display:block;" alt="Founder">
            @else
            <div style="background:var(--cream); aspect-ratio:3/4; display:flex; align-items:center; justify-content:center; border: 1px solid var(--rule);">
                <i class="fas fa-spa fa-4x" style="color:var(--gold-light)"></i>
            </div>
            @endif
        </div>

        <div class="col-lg-6 offset-lg-1" data-aos="fade-left">
            <span class="section-label">Our Story</span>
            <h2 class="section-heading">The Brand Behind<br>the Scent</h2>
            <div class="section-rule left"></div>

            <p style="font-size:0.95rem; color:var(--muted); font-weight:300; line-height:1.9; margin-bottom:24px;">
                {{ $aboutUs->brand_history ?? 'EQUALITY Perfume didirikan dengan visi untuk menghadirkan wewangian berkualitas tinggi yang dapat dinikmati oleh semua kalangan. Kami percaya bahwa setiap orang berhak merasakan keharuman premium tanpa harus mengeluarkan biaya yang berlebihan.' }}
            </p>

            @if($aboutUs->vision)
            <div style="padding: 24px; background: var(--cream); border-left: 2px solid var(--gold); margin-bottom: 24px;">
                <p style="font-size:0.68rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--muted); margin-bottom:10px;">Our Vision</p>
                <p style="font-family:'Cormorant Garamond',serif; font-size:1.15rem; color:var(--ink); line-height:1.6; margin:0;">
                    {{ $aboutUs->vision }}
                </p>
            </div>
            @endif

            @if($aboutUs->mission)
            <div style="padding: 24px; background: var(--cream); border-left: 2px solid var(--rule); margin-bottom: 24px;">
                <p style="font-size:0.68rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--muted); margin-bottom:10px;">Our Mission</p>
                <p style="font-size:0.88rem; color:var(--muted); font-weight:300; line-height:1.7; margin:0;">
                    {{ $aboutUs->mission }}
                </p>
            </div>
            @endif
        </div>
    </div>


    <!-- ── FOUNDER STORY ──────────────────────────── -->
    @if($aboutUs->founder_story)
    <div class="row mt-5 pt-4" style="border-top: 1px solid var(--rule);" data-aos="fade-up">
        <div class="col-lg-8 offset-lg-2 text-center">
            <span class="section-label">From The Founder</span>
            <div style="font-size:4rem; font-family:'Cormorant Garamond',serif; color:var(--gold-light); line-height:0.5; margin-bottom:20px;">"</div>
            <p style="font-family:'Cormorant Garamond',serif; font-size:1.25rem; font-style:italic; color:var(--ink); line-height:1.7; margin-bottom:20px;">
                {{ $aboutUs->founder_story }}
            </p>
        </div>
    </div>
    @endif


    <!-- ── VALUES ─────────────────────────────────── -->
    <div class="mt-5 pt-4" style="border-top: 1px solid var(--rule);" data-aos="fade-up">
        <div class="text-center mb-5">
            <span class="section-label">What We Stand For</span>
            <h2 class="section-heading">Our Core Values</h2>
            <div class="section-rule"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h5>Quality</h5>
                    <p>Kualitas terbaik dalam setiap produk yang kami hadirkan untuk Anda.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="80">
                <div class="value-item" style="border-top: 2px solid var(--gold);">
                    <div class="value-icon" style="border-color:var(--gold);">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h5>Integrity</h5>
                    <p>Kejujuran dan transparansi dalam setiap langkah dan transaksi kami.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="160">
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5>Community</h5>
                    <p>Membangun komunitas pecinta parfum yang solid dan saling mendukung.</p>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ── CTA ────────────────────────────────────────── -->
<div style="background: var(--cream); border-top: 1px solid var(--rule); border-bottom: 1px solid var(--rule); padding: 60px 0;" data-aos="fade-up">
    <div class="container text-center">
        <span class="section-label">Discover Our Collection</span>
        <h2 class="section-heading">Ready to Find Your Signature Scent?</h2>
        <div class="section-rule"></div>
        <a href="{{ route('products.index') }}" class="btn-eq mt-3">
            Explore Products <i class="fas fa-arrow-right" style="font-size:0.7rem"></i>
        </a>
    </div>
</div>

@endsection