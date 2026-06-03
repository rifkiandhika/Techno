@extends('layouts.app')

@section('title', 'Contact Us — EQUALITY Perfume')
@section('meta_description', 'Hubungi EQUALITY Perfume melalui WhatsApp, email, atau media sosial. Kami siap membantu Anda.')
@section('meta_keywords', 'kontak, customer service, whatsapp parfum')

@section('content')

<!-- ── BREADCRUMB ─────────────────────────────────── -->
<div class="breadcrumb-bar" style="margin-top:60px;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </nav>
    </div>
</div>

@php $contact = App\Models\Contact::first(); @endphp

<!-- ── PAGE HERO ──────────────────────────────────── -->
<div style="background: var(--ink); padding: 80px 0 70px;">
    <div class="container">
        <div data-aos="fade-up">
            <span class="section-label" style="color:rgba(255,255,255,0.3);">We'd Love to Hear From You</span>
            <h1 style="font-family:'Cormorant Garamond',serif; font-size:clamp(2.5rem,5vw,4rem); font-weight:300; color:white; line-height:1.1;">
                Get in Touch
            </h1>
        </div>
    </div>
</div>


<!-- ── CONTACT CONTENT ────────────────────────────── -->
<div class="container py-5">
    <div class="row g-5">

        <!-- CONTACT DETAILS -->
        <div class="col-lg-5" data-aos="fade-right">
            <span class="section-label">Reach Us Directly</span>
            <h2 class="section-heading" style="font-size:2rem;">Contact Information</h2>
            <div class="section-rule left mb-4"></div>
            <p style="font-size:0.88rem; color:var(--muted); font-weight:300; line-height:1.8; margin-bottom:32px;">
                Kami siap membantu Anda dengan pertanyaan, pemesanan, atau informasi produk melalui kanal pilihan Anda.
            </p>

            <div class="contact-block">
                <div class="contact-icon"><i class="fab fa-whatsapp" style="color:#22c55e;"></i></div>
                <div>
                    <h6>WhatsApp</h6>
                    <a href="https://wa.me/{{ $contact->whatsapp ?? '628123456789' }}" target="_blank">
                        {{ $contact->whatsapp ?? '628123456789' }}
                    </a>
                </div>
            </div>

            <div class="contact-block">
                <div class="contact-icon"><i class="fas fa-envelope" style="color:var(--gold);"></i></div>
                <div>
                    <h6>Email</h6>
                    <a href="mailto:{{ $contact->email ?? 'info@equality.com' }}">
                        {{ $contact->email ?? 'info@equality.com' }}
                    </a>
                </div>
            </div>

            <div class="contact-block">
                <div class="contact-icon"><i class="fas fa-map-marker-alt" style="color:var(--gold);"></i></div>
                <div>
                    <h6>Location</h6>
                    <p>{{ $contact->address ?? 'Jakarta, Indonesia' }}</p>
                </div>
            </div>

            <div class="contact-block">
                <div class="contact-icon"><i class="fas fa-clock" style="color:var(--gold);"></i></div>
                <div>
                    <h6>Business Hours</h6>
                    <p>Senin – Sabtu, 09:00 – 21:00 WIB</p>
                </div>
            </div>

            <!-- Social -->
            <div class="mt-4 pt-3" style="border-top: 1px solid var(--rule);">
                <p style="font-size:0.68rem; letter-spacing:0.18em; text-transform:uppercase; color:var(--muted); margin-bottom:14px;">Follow Us</p>
                <div>
                    @if($contact && $contact->instagram)
                    <a href="https://instagram.com/{{ $contact->instagram }}" target="_blank" class="social-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if($contact && $contact->tiktok)
                    <a href="https://tiktok.com/@{{ $contact->tiktok }}" target="_blank" class="social-link">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    @endif
                    @if($contact && $contact->facebook)
                    <a href="https://facebook.com/{{ $contact->facebook }}" target="_blank" class="social-link">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- WHATSAPP CTA -->
        <div class="col-lg-6 offset-lg-1" data-aos="fade-left">
            <div style="border: 1px solid var(--rule); padding: 48px 40px; height:100%; display:flex; flex-direction:column; justify-content:center;">
                <div style="width:64px; height:64px; background:#f0fdf4; border: 1px solid #bbf7d0; display:flex; align-items:center; justify-content:center; margin-bottom:28px;">
                    <i class="fab fa-whatsapp" style="font-size:1.8rem; color:#22c55e;"></i>
                </div>

                <h3 style="font-family:'Cormorant Garamond',serif; font-size:1.8rem; font-weight:400; color:var(--ink); margin-bottom:12px;">
                    Chat with Us on WhatsApp
                </h3>
                <p style="font-size:0.88rem; color:var(--muted); font-weight:300; line-height:1.7; margin-bottom:32px;">
                    Cara tercepat untuk mendapatkan jawaban — tanyakan tentang produk, ketersediaan stok, atau informasi pengiriman langsung melalui WhatsApp kami.
                </p>

                <a href="https://wa.me/{{ $contact->whatsapp ?? '628123456789' }}?text=Halo%20EQUALITY%20Perfume%2C%20saya%20mau%20bertanya%20tentang%20produk%20Anda"
                   class="btn-wa" target="_blank"
                   style="font-size:0.82rem; padding:14px 28px; width:fit-content;">
                    <i class="fab fa-whatsapp me-1"></i>
                    Start Conversation
                </a>

                <div style="margin-top:32px; padding-top:28px; border-top: 1px solid var(--rule);">
                    <p style="font-size:0.78rem; color:var(--muted); margin:0;">
                        Waktu respon rata-rata <strong style="color:var(--ink);">di bawah 1 jam</strong> pada hari kerja.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <!-- ── MAP ───────────────────────────────────── -->
    <div class="mt-5 pt-2" data-aos="fade-up">
        <div style="border:1px solid var(--rule); overflow:hidden;">
            <iframe
                width="100%"
                height="320"
                style="border:0; display:block;"
                loading="lazy"
                allowfullscreen
                src="https://maps.google.com/maps?q=-7.9147149,112.6509376&z=17&output=embed">
            </iframe>
        </div>
    </div>

</div>

@endsection