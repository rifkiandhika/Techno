<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EQUALITY Perfume - Wewangian Berkualitas')</title>
    <meta name="description" content="@yield('meta_description', 'Temukan wewangian terbaik dari EQUALITY Perfume. Parfum berkualitas dengan aroma tahan lama untuk pria dan wanita.')">
    <meta name="keywords" content="@yield('meta_keywords', 'parfum, wewangian, equality, perfume, fragrance, toko parfum online')">

    <link rel="icon" type="image/x-icon" href="{{ asset('image/icon.png') }}">

    <!-- Fonts: Cormorant Garamond (display) + DM Sans (body) -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* ─── TOKENS ─────────────────────────────────────────── */
        :root {
            --ink:        #1c1410;
            --ink-light:  #3d2f27;
            --muted:      #8a7d75;
            --rule:       #e8e0d8;
            --cream:      #faf7f4;
            --warm-white: #fffdf9;
            --gold:       #b8933c;
            --gold-light: #e8d9b0;
            --success:    #3a7c55;
            --danger:     #9c3333;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            font-weight: 300;
            color: var(--ink);
            background: var(--warm-white);
            overflow-x: hidden;
        }

        /* ─── SCROLLBAR ───────────────────────────────────────── */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--cream); }
        ::-webkit-scrollbar-thumb { background: var(--ink-light); border-radius: 3px; }

        /* ─── TYPOGRAPHY ─────────────────────────────────────── */
        h1, h2, h3, h4 {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-weight: 400;
            line-height: 1.15;
            letter-spacing: -0.01em;
        }

        /* ─── LOADER ──────────────────────────────────────────── */
        .page-loader {
            position: fixed;
            inset: 0;
            background: var(--warm-white);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.6s ease;
        }
        .page-loader.out { opacity: 0; pointer-events: none; }
        .loader-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            letter-spacing: 0.25em;
            color: var(--ink);
            margin-bottom: 24px;
        }
        .loader-line {
            width: 60px;
            height: 1px;
            background: var(--rule);
            position: relative;
            overflow: hidden;
        }
        .loader-line::after {
            content: '';
            position: absolute;
            left: -100%;
            top: 0;
            width: 100%;
            height: 100%;
            background: var(--gold);
            animation: sweep 1.2s ease-in-out infinite;
        }
        @keyframes sweep { to { left: 100%; } }

        /* ─── NAVBAR ──────────────────────────────────────────── */
        .site-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 0;
            transition: all 0.4s ease;
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 40px;
            border-bottom: 1px solid transparent;
            transition: all 0.4s ease;
            background: transparent;
        }

        .site-nav.scrolled .nav-inner {
            padding: 14px 40px;
            background: rgba(255, 253, 249, 0.96);
            backdrop-filter: blur(12px);
            border-bottom-color: var(--rule);
        }

        .nav-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 500;
            letter-spacing: 0.18em;
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }
        .site-nav.scrolled .nav-brand { color: var(--ink); }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 40px;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            font-weight: 400;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            position: relative;
            transition: color 0.3s;
        }
        .site-nav.scrolled .nav-links a { color: var(--muted); }
        .nav-links a:hover,
        .nav-links a.active { color: white; }
        .site-nav.scrolled .nav-links a:hover,
        .site-nav.scrolled .nav-links a.active { color: var(--ink); }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 1px;
            background: currentColor;
            transition: width 0.3s ease;
        }
        .nav-links a:hover::after,
        .nav-links a.active::after { width: 100%; }

        .nav-cta {
            font-size: 0.75rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--ink);
            background: white;
            border: none;
            padding: 10px 22px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .site-nav.scrolled .nav-cta {
            background: var(--ink);
            color: white;
        }
        .nav-cta:hover {
            background: var(--gold);
            color: var(--ink);
        }

        /* Mobile toggle */
        .nav-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 4px;
        }
        .nav-toggle span {
            display: block;
            width: 24px;
            height: 1px;
            background: white;
            transition: all 0.3s;
        }
        .site-nav.scrolled .nav-toggle span { background: var(--ink); }

        @media (max-width: 991px) {
            .nav-toggle { display: flex; }
            .nav-links { display: none; }
            .nav-links.open {
                display: flex;
                flex-direction: column;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: var(--ink);
                align-items: center;
                justify-content: center;
                gap: 32px;
                z-index: 999;
            }
            .nav-links.open a { color: rgba(255,255,255,0.7); font-size: 1rem; }
            .nav-links.open a:hover { color: white; }
            .nav-inner { padding: 16px 24px; }
            .site-nav.scrolled .nav-inner { padding: 14px 24px; }
            .nav-cta { display: none; }
        }

        /* ─── HERO SWIPER ─────────────────────────────────────── */
        .hero-swiper { width: 100%; }
        .hero-slide {
            min-height: 90vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding-bottom: 80px;
        }
        .hero-slide::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15,10,8,0.75) 0%, rgba(15,10,8,0.15) 60%, transparent 100%);
        }
        .hero-content {
            position: relative;
            z-index: 1;
            color: white;
            max-width: 620px;
        }
        .hero-eyebrow {
            font-size: 0.72rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold-light);
            margin-bottom: 16px;
            display: block;
        }
        .hero-content h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.8rem, 6vw, 5rem);
            font-weight: 300;
            line-height: 1.1;
            color: white;
            margin-bottom: 20px;
        }
        .hero-content .lead {
            font-size: 1rem;
            font-weight: 300;
            color: rgba(255,255,255,0.75);
            margin-bottom: 32px;
        }
        .swiper-pagination-bullet { background: white; opacity: 0.5; }
        .swiper-pagination-bullet-active { opacity: 1; }
        .swiper-button-next,
        .swiper-button-prev { color: white; }

        /* ─── BUTTONS ─────────────────────────────────────────── */
        .btn-dark-eq {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: white;
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.75rem;
            font-weight: 400;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            text-decoration: none;
            padding: 13px 28px;
            border: 1px solid white;
            transition: all 0.3s;
        }
        .btn-dark-eq:hover {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--ink);
        }

        .btn-eq {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--ink);
            color: white;
            font-size: 0.75rem;
            font-weight: 400;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            padding: 12px 26px;
            border: 1px solid var(--ink);
            transition: all 0.3s;
        }
        .btn-eq:hover {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--ink);
        }

        .btn-eq-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--ink);
            font-size: 0.72rem;
            font-weight: 400;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            padding: 10px 22px;
            border: 1px solid var(--ink);
            transition: all 0.3s;
        }
        .btn-eq-outline:hover {
            background: var(--ink);
            color: white;
        }

        .btn-wa {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #22c55e;
            color: white;
            font-size: 0.75rem;
            font-weight: 400;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            text-decoration: none;
            padding: 12px 24px;
            border: none;
            transition: all 0.3s;
        }
        .btn-wa:hover {
            background: #16a34a;
            color: white;
        }

        /* ─── SECTION STRUCTURE ───────────────────────────────── */
        .section-label {
            font-size: 0.68rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold);
            display: block;
            margin-bottom: 12px;
        }
        .section-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 300;
            color: var(--ink);
            margin-bottom: 12px;
        }
        .section-rule {
            width: 40px;
            height: 1px;
            background: var(--gold);
            margin: 20px auto;
        }
        .section-rule.left { margin-left: 0; }

        /* ─── PRODUCT CARD ────────────────────────────────────── */
        .product-card {
            background: var(--warm-white);
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }
        .product-card:hover { transform: translateY(-4px); }

        .product-card .img-wrap {
            overflow: hidden;
            position: relative;
            background: var(--cream);
        }
        .product-card .img-wrap img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.6s ease;
            display: block;
        }
        .product-card:hover .img-wrap img { transform: scale(1.04); }

        .product-card .card-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 5px 12px;
            background: var(--ink);
            color: white;
            z-index: 1;
        }
        .product-card .card-badge.gold {
            background: var(--gold);
            color: var(--ink);
        }

        .product-card .wishlist-btn {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 34px;
            height: 34px;
            background: white;
            border: 1px solid var(--rule);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            z-index: 1;
        }
        .product-card .wishlist-btn:hover { background: var(--ink); color: white; }

        .product-card .card-body {
            padding: 18px 0 12px;
        }
        .product-card .cat-label {
            font-size: 0.65rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 6px;
        }
        .product-card h5 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            font-weight: 400;
            color: var(--ink);
            margin-bottom: 12px;
            line-height: 1.3;
        }
        .product-card .price {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--ink);
        }
        .product-card .card-footer-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid var(--rule);
            margin-top: 12px;
        }

        /* ─── BREADCRUMB ──────────────────────────────────────── */
        .breadcrumb-bar {
            background: var(--cream);
            border-bottom: 1px solid var(--rule);
            padding: 14px 0;
            margin-top: 60px;
        }
        .breadcrumb-bar .breadcrumb { margin: 0; font-size: 0.78rem; }
        .breadcrumb-bar .breadcrumb-item + .breadcrumb-item::before { color: var(--muted); }
        .breadcrumb-bar .breadcrumb-item a { color: var(--muted); text-decoration: none; }
        .breadcrumb-bar .breadcrumb-item a:hover { color: var(--ink); }
        .breadcrumb-bar .breadcrumb-item.active { color: var(--ink); }

        /* ─── FILTER SIDEBAR ──────────────────────────────────── */
        .filter-sidebar {
            position: sticky;
            top: 90px;
        }
        .filter-panel {
            background: white;
            border: 1px solid var(--rule);
            padding: 28px;
        }
        .filter-panel h6 {
            font-size: 0.68rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 16px;
        }
        .filter-panel label {
            font-size: 0.8rem;
            color: var(--muted);
            font-weight: 300;
            margin-bottom: 6px;
        }
        .form-control, .form-select {
            border: 1px solid var(--rule);
            border-radius: 0;
            font-size: 0.85rem;
            font-weight: 300;
            padding: 10px 14px;
            color: var(--ink);
            background: var(--warm-white);
            transition: border-color 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--ink);
            box-shadow: none;
            background: white;
        }
        .filter-divider {
            height: 1px;
            background: var(--rule);
            margin: 20px 0;
        }

        /* ─── PERFORMANCE METER ───────────────────────────────── */
        .perf-meter {
            height: 2px;
            background: var(--rule);
            margin: 8px 0 4px;
        }
        .perf-fill {
            height: 100%;
            background: var(--gold);
        }

        /* ─── FRAGRANCE PYRAMID ───────────────────────────────── */
        .frag-note {
            background: var(--cream);
            border: 1px solid var(--rule);
            padding: 28px 20px;
            text-align: center;
        }
        .frag-note h6 {
            font-size: 0.68rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 10px;
        }
        .frag-note p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.05rem;
            font-weight: 400;
            color: var(--ink);
            margin: 0;
        }

        /* ─── VARIANT ROW ─────────────────────────────────────── */
        .variant-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border: 1px solid var(--rule);
            margin-bottom: 8px;
            transition: border-color 0.2s;
        }
        .variant-row:hover { border-color: var(--ink); }
        .variant-size {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
        }
        .variant-price {
            font-size: 1rem;
            font-weight: 500;
            color: var(--ink);
        }
        .stock-tag {
            display: inline-block;
            font-size: 0.63rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 3px 10px;
        }
        .stock-ok { background: #ecf5ee; color: #2d6e3e; }
        .stock-low { background: #fdf6e3; color: #7a5c1a; }
        .stock-out { background: #fdf0f0; color: #8c2e2e; }

        /* ─── TESTIMONIAL CARD ────────────────────────────────── */
        .testi-card {
            background: white;
            border: 1px solid var(--rule);
            padding: 28px;
        }
        .testi-card .quote-mark {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3.5rem;
            line-height: 1;
            color: var(--gold-light);
            margin-bottom: -8px;
        }
        .testi-card p {
            font-size: 0.9rem;
            font-weight: 300;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .testi-card .reviewer-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            color: var(--ink);
        }
        .star-row i {
            font-size: 0.7rem;
            color: var(--gold);
            margin-right: 1px;
        }
        .star-row .muted-star { color: var(--rule); }

        /* ─── VALUES ──────────────────────────────────────────── */
        .value-item {
            padding: 32px 24px;
            border: 1px solid var(--rule);
            text-align: center;
            transition: border-color 0.3s, transform 0.3s;
        }
        .value-item:hover {
            border-color: var(--gold);
            transform: translateY(-4px);
        }
        .value-icon {
            width: 50px;
            height: 50px;
            border: 1px solid var(--gold-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--gold);
        }
        .value-item h5 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            font-weight: 400;
            color: var(--ink);
            margin-bottom: 8px;
        }
        .value-item p {
            font-size: 0.82rem;
            color: var(--muted);
            font-weight: 300;
            margin: 0;
            line-height: 1.6;
        }

        /* ─── CONTACT ─────────────────────────────────────────── */
        .contact-block {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 20px;
            border: 1px solid var(--rule);
            margin-bottom: 12px;
            transition: border-color 0.2s;
        }
        .contact-block:hover { border-color: var(--ink); }
        .contact-icon {
            width: 42px;
            height: 42px;
            border: 1px solid var(--rule);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            flex-shrink: 0;
            font-size: 1rem;
        }
        .contact-block h6 {
            font-size: 0.68rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 4px;
        }
        .contact-block a, .contact-block p {
            font-size: 0.88rem;
            color: var(--ink);
            text-decoration: none;
            margin: 0;
        }
        .contact-block a:hover { color: var(--gold); }

        /* ─── SOCIAL LINKS ────────────────────────────────────── */
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border: 1px solid var(--rule);
            color: var(--muted);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.3s;
            margin-right: 8px;
        }
        .social-link:hover {
            border-color: var(--ink);
            background: var(--ink);
            color: white;
        }

        /* ─── NEWSLETTER SECTION ──────────────────────────────── */
        .newsletter-section {
            background: var(--ink);
            padding: 80px 0;
        }
        .newsletter-section h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            font-weight: 300;
            color: white;
            margin-bottom: 12px;
        }
        .newsletter-section p { color: rgba(255,255,255,0.5); font-size: 0.88rem; }
        .newsletter-input-group {
            display: flex;
            max-width: 440px;
            margin: 32px auto 0;
        }
        .newsletter-input-group input {
            flex: 1;
            border: 1px solid rgba(255,255,255,0.15);
            background: rgba(255,255,255,0.05);
            color: white;
            padding: 13px 18px;
            font-size: 0.85rem;
            font-weight: 300;
            outline: none;
            border-radius: 0;
        }
        .newsletter-input-group input::placeholder { color: rgba(255,255,255,0.35); }
        .newsletter-input-group button {
            background: var(--gold);
            border: none;
            color: var(--ink);
            padding: 0 24px;
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s;
            white-space: nowrap;
        }
        .newsletter-input-group button:hover { background: #d4a94a; }

        /* ─── FOOTER ──────────────────────────────────────────── */
        .site-footer {
            background: var(--ink);
            color: rgba(255,255,255,0.45);
            padding: 60px 0 28px;
        }
        .site-footer h5 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25rem;
            font-weight: 400;
            color: white;
            letter-spacing: 0.06em;
            margin-bottom: 6px;
        }
        .site-footer h6 {
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            margin-bottom: 20px;
        }
        .site-footer a {
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            font-size: 0.83rem;
            font-weight: 300;
            transition: color 0.3s;
            display: block;
            margin-bottom: 10px;
        }
        .site-footer a:hover { color: var(--gold); }
        .footer-rule {
            height: 1px;
            background: rgba(255,255,255,0.08);
            margin: 40px 0 24px;
        }
        .footer-copy {
            font-size: 0.75rem;
            font-weight: 300;
        }
        .footer-tagline {
            font-size: 0.78rem;
            font-weight: 300;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        /* ─── WA FLOAT ────────────────────────────────────────── */
        .wa-float {
            position: fixed;
            bottom: 32px;
            right: 32px;
            width: 50px;
            height: 50px;
            background: #22c55e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: white;
            text-decoration: none;
            z-index: 900;
            transition: transform 0.3s;
        }
        .wa-float:hover { transform: scale(1.08); color: white; }

        /* ─── BACK TO TOP ─────────────────────────────────────── */
        .back-top {
            position: fixed;
            bottom: 32px;
            left: 32px;
            width: 42px;
            height: 42px;
            background: var(--ink);
            color: white;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.8rem;
            z-index: 900;
            transition: background 0.3s;
        }
        .back-top:hover { background: var(--gold); color: var(--ink); }

        /* ─── PAGINATION ──────────────────────────────────────── */
        .pagination .page-link {
            border: 1px solid var(--rule);
            color: var(--ink);
            border-radius: 0;
            padding: 8px 14px;
            font-size: 0.82rem;
            margin: 0 2px;
        }
        .pagination .page-item.active .page-link {
            background: var(--ink);
            border-color: var(--ink);
            color: white;
        }
        .pagination .page-link:hover { background: var(--cream); color: var(--ink); }

        /* ─── ABOUT PAGE ──────────────────────────────────────── */
        .about-stat {
            padding: 24px 20px;
            border-top: 2px solid var(--gold);
            background: var(--cream);
        }
        .about-stat .num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            font-weight: 300;
            color: var(--ink);
            line-height: 1;
        }
        .about-stat .lbl {
            font-size: 0.72rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-top: 6px;
        }

        /* ─── PRODUCT GALLERY SWIPER ──────────────────────────── */
        .product-gallery .swiper-button-next,
        .product-gallery .swiper-button-prev {
            color: var(--ink);
            background: white;
            width: 36px;
            height: 36px;
            border: 1px solid var(--rule);
        }
        .product-gallery .swiper-button-next::after,
        .product-gallery .swiper-button-prev::after { font-size: 12px; }
        .gallery-thumb {
            cursor: pointer;
            opacity: 0.55;
            transition: opacity 0.2s;
            border: 1px solid transparent;
        }
        .gallery-thumb:hover, .gallery-thumb.active { opacity: 1; border-color: var(--gold); }

        /* ─── SECTION BG VARIATIONS ───────────────────────────── */
        .bg-cream { background: var(--cream); }
        .bg-dark-eq { background: var(--ink); }

        /* ─── UTILITY ─────────────────────────────────────────── */
        .text-gold { color: var(--gold); }
        .text-muted-eq { color: var(--muted); }
        .border-rule { border-color: var(--rule) !important; }

        /* ─── RESPONSIVE ──────────────────────────────────────── */
        @media (max-width: 768px) {
            .hero-slide { min-height: 70vh; padding-bottom: 50px; }
            .hero-content h1 { font-size: 2.4rem; }
            .product-card .img-wrap img { height: 220px; }
            .wa-float { bottom: 20px; right: 20px; }
            .back-top { bottom: 20px; left: 20px; }
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- ── LOADER ──────────────────────────────────── -->
<div class="page-loader" id="pageLoader">
    <div class="loader-brand">EQUALITY</div>
    <div class="loader-line"></div>
</div>

<!-- ── NAVIGATION ──────────────────────────────── -->
<nav class="site-nav" id="siteNav">
    <div class="nav-inner">
        <a class="nav-brand" href="{{ route('home') }}">EQUALITY</a>

        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Products</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
            <li><a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.*') ? 'active' : '' }}">Journal</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
        </ul>

        <div class="d-flex align-items-center gap-3">
            <a href="https://wa.me/{{ $contact->whatsapp ?? '628123456789' }}" class="nav-cta" target="_blank">
                <i class="fab fa-whatsapp"></i> Order Now
            </a>
            <div class="nav-toggle" id="navToggle" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </div>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<!-- ── FOOTER ──────────────────────────────────── -->
@php $contactInfo = App\Models\Contact::first(); @endphp

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-5">
                <h5>EQUALITY</h5>
                <p class="footer-tagline">Wewangian berkualitas untuk setiap momen spesial Anda. Nikmati aroma tahan lama dengan bahan pilihan.</p>
                <div class="mt-3">
                    @if($contactInfo && $contactInfo->instagram)
                    <a href="https://instagram.com/{{ $contactInfo->instagram }}" target="_blank" class="social-link d-inline-flex"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($contactInfo && $contactInfo->tiktok)
                    <a href="https://tiktok.com/@{{ $contactInfo->tiktok }}" target="_blank" class="social-link d-inline-flex"><i class="fab fa-tiktok"></i></a>
                    @endif
                    @if($contactInfo && $contactInfo->facebook)
                    <a href="https://facebook.com/{{ $contactInfo->facebook }}" target="_blank" class="social-link d-inline-flex"><i class="fab fa-facebook-f"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <h6>Navigate</h6>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('products.index') }}">Products</a>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('articles.index') }}">Journal</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
            <div class="col-lg-3 col-6 mb-4">
                <h6>Collections</h6>
                @foreach(App\Models\Category::all() as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                @endforeach
            </div>
            <div class="col-lg-3 mb-4">
                <h6>Get In Touch</h6>
                @if($contactInfo && $contactInfo->whatsapp)
                <a href="https://wa.me/{{ $contactInfo->whatsapp }}" class="mb-2">
                    <i class="fab fa-whatsapp me-2" style="color: #22c55e"></i>{{ $contactInfo->whatsapp }}
                </a>
                @endif
                @if($contactInfo && $contactInfo->email)
                <a href="mailto:{{ $contactInfo->email }}" class="mb-2">
                    <i class="fas fa-envelope me-2" style="color: var(--gold)"></i>{{ $contactInfo->email }}
                </a>
                @endif
                @if($contactInfo && $contactInfo->address)
                <p style="font-size:0.82rem; color:rgba(255,255,255,0.35); font-weight:300;">
                    <i class="fas fa-map-marker-alt me-2" style="color:var(--gold)"></i>{{ $contactInfo->address }}
                </p>
                @endif
            </div>
        </div>
        <div class="footer-rule"></div>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <small class="footer-copy">&copy; {{ date('Y') }} EQUALITY Perfume. All rights reserved.</small>
            <small class="footer-copy">Crafted with care in Indonesia</small>
        </div>
    </div>
</footer>

<!-- ── WA FLOAT ─────────────────────────────────── -->
@php $waNumber = $contactInfo->whatsapp ?? '628123456789'; @endphp
<a href="https://wa.me/{{ $waNumber }}?text=Halo%20EQUALITY%20Perfume%2C%20saya%20ingin%20bertanya%20tentang%20produknya"
   class="wa-float" target="_blank" title="Chat via WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- ── BACK TO TOP ───────────────────────────────── -->
<div class="back-top" id="backTop">
    <i class="fas fa-arrow-up"></i>
</div>

<!-- ── SCRIPTS ───────────────────────────────────── -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    // Loader
    window.addEventListener('load', () => {
        const loader = document.getElementById('pageLoader');
        loader.classList.add('out');
        setTimeout(() => loader.style.display = 'none', 700);
    });

    // Navbar scroll
    const nav = document.getElementById('siteNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 40);
        const bt = document.getElementById('backTop');
        bt.style.display = window.scrollY > 300 ? 'flex' : 'none';
    });

    // Back to top
    document.getElementById('backTop').addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Mobile menu
    function toggleMenu() {
        document.getElementById('navLinks').classList.toggle('open');
    }

    // AOS
    AOS.init({ duration: 700, once: true, offset: 60, easing: 'ease-out-cubic' });

    // Hero swiper
    @if(isset($banners) && $banners->count() > 0)
    new Swiper('.hero-swiper', {
        loop: true,
        autoplay: { delay: 5500, disableOnInteraction: false },
        pagination: { el: '.swiper-pagination', clickable: true },
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        effect: 'fade',
        fadeEffect: { crossFade: true }
    });
    @endif
</script>

@stack('scripts')
</body>
</html>