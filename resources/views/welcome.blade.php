<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NusaNet — Internet Cepat & Andal untuk Indonesia</title>
    <meta name="description" content="NusaNet menyediakan layanan internet WiFi berkecepatan tinggi untuk rumah dan bisnis di seluruh Indonesia. Koneksi stabil, harga terjangkau.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:       #0057FF;
            --primary-dark:  #0040CC;
            --primary-light: #E8F0FF;
            --accent:        #00C9A7;
            --text-1:        #0A0F1E;
            --text-2:        #4A5568;
            --text-3:        #94A3B8;
            --surface:       #FFFFFF;
            --surface-2:     #F7F9FC;
            --border:        #E2E8F0;
            --radius-sm:     8px;
            --radius-md:     14px;
            --radius-lg:     24px;
            --shadow-sm:     0 1px 3px rgba(0,0,0,.07), 0 1px 2px rgba(0,0,0,.05);
            --shadow-md:     0 4px 16px rgba(0,0,0,.09);
            --shadow-lg:     0 20px 48px rgba(0,87,255,.13);
            --transition:    .22s cubic-bezier(.4,0,.2,1);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: var(--text-1);
            background: var(--surface);
            -webkit-font-smoothing: antialiased;
        }

        /* ── NAVBAR ─────────────────────────────────────────── */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 5vw;
            height: 68px;
            background: rgba(255,255,255,.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            transition: box-shadow var(--transition);
        }
        .navbar.scrolled { box-shadow: var(--shadow-md); }

        .logo {
            display: flex; align-items: center; gap: 10px;
            font-size: 1.25rem; font-weight: 800; color: var(--primary);
            text-decoration: none; letter-spacing: -.5px;
        }
        .logo-icon {
            width: 36px; height: 36px;
            background: var(--primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .logo-icon svg { width: 20px; height: 20px; fill: #fff; }

        .nav-links { display: flex; align-items: center; gap: 2rem; list-style: none; }
        .nav-links a {
            font-size: .925rem; font-weight: 500; color: var(--text-2);
            text-decoration: none; transition: color var(--transition);
        }
        .nav-links a:hover { color: var(--primary); }

        .nav-cta {
            display: flex; align-items: center; gap: .75rem;
        }
        .btn {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .6rem 1.3rem; border-radius: var(--radius-sm);
            font-size: .9rem; font-weight: 600; cursor: pointer;
            text-decoration: none; transition: all var(--transition);
            border: none;
        }
        .btn-ghost {
            background: transparent; color: var(--text-2);
        }
        .btn-ghost:hover { color: var(--primary); background: var(--primary-light); }
        .btn-primary {
            background: var(--primary); color: #fff;
            box-shadow: 0 2px 12px rgba(0,87,255,.28);
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0,87,255,.35);
        }
        .btn-primary:active { transform: translateY(0); }

        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 4px; }
        .hamburger span { display: block; width: 24px; height: 2px; background: var(--text-1); border-radius: 4px; transition: var(--transition); }

        /* ── HERO ────────────────────────────────────────────── */
        .hero {
            min-height: 100vh;
            display: flex; align-items: center;
            padding: 100px 5vw 80px;
            background: linear-gradient(135deg, #EAF0FF 0%, #F0FDF9 50%, #FFFFFF 100%);
            overflow: hidden; position: relative;
        }
        .hero::before {
            content: '';
            position: absolute; top: -200px; right: -150px;
            width: 700px; height: 700px;
            background: radial-gradient(circle, rgba(0,87,255,.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero::after {
            content: '';
            position: absolute; bottom: -100px; left: 10%;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(0,201,167,.07) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-inner {
            max-width: 1200px; margin: 0 auto; width: 100%;
            display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .35rem .9rem; border-radius: 999px;
            background: var(--primary-light); color: var(--primary);
            font-size: .8rem; font-weight: 600; margin-bottom: 1.5rem;
        }
        .badge-dot { width: 7px; height: 7px; background: var(--primary); border-radius: 50%; }

        .hero-title {
            font-size: clamp(2.2rem, 4.5vw, 3.4rem);
            font-weight: 800; line-height: 1.18;
            letter-spacing: -1.5px; color: var(--text-1);
            margin-bottom: 1.25rem;
        }
        .hero-title .highlight { color: var(--primary); }

        .hero-subtitle {
            font-size: 1.1rem; color: var(--text-2); line-height: 1.7;
            max-width: 480px; margin-bottom: 2.5rem;
        }

        .hero-actions { display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; }
        .btn-lg { padding: .85rem 2rem; font-size: 1rem; border-radius: var(--radius-md); }

        .hero-stats {
            display: flex; gap: 2.5rem; margin-top: 3rem;
            padding-top: 2rem; border-top: 1px solid var(--border);
        }
        .stat-item { display: flex; flex-direction: column; }
        .stat-number { font-size: 1.7rem; font-weight: 800; color: var(--text-1); letter-spacing: -1px; }
        .stat-label { font-size: .8rem; color: var(--text-3); font-weight: 500; margin-top: .1rem; }

        /* Hero Visual */
        .hero-visual { position: relative; display: flex; justify-content: center; align-items: center; }
        .hero-card {
            width: 100%; max-width: 440px;
            background: #fff;
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-lg);
            position: relative; z-index: 2;
        }
        .speed-display {
            text-align: center; padding: 2rem 1rem;
        }
        .speed-ring {
            width: 160px; height: 160px; margin: 0 auto 1.5rem;
            border-radius: 50%;
            background: conic-gradient(var(--primary) 75%, var(--border) 75%);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 0 8px var(--primary-light);
            position: relative;
        }
        .speed-ring-inner {
            width: 130px; height: 130px;
            background: #fff; border-radius: 50%;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
        }
        .speed-value { font-size: 2.2rem; font-weight: 800; color: var(--primary); line-height: 1; }
        .speed-unit  { font-size: .75rem; color: var(--text-3); font-weight: 600; }
        .speed-label { font-size: .9rem; color: var(--text-2); font-weight: 500; }

        .speed-bars { display: flex; flex-direction: column; gap: .75rem; margin-top: 1.5rem; }
        .speed-bar-row { display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .speed-bar-info { display: flex; align-items: center; gap: .5rem; min-width: 70px; }
        .speed-bar-icon { width: 28px; height: 28px; border-radius: 7px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .icon-dl { background: rgba(0,87,255,.1); }
        .icon-ul { background: rgba(0,201,167,.1); }
        .speed-bar-name { font-size: .8rem; color: var(--text-2); font-weight: 500; }
        .speed-bar-track { flex: 1; height: 6px; background: var(--border); border-radius: 3px; overflow: hidden; }
        .speed-bar-fill { height: 100%; border-radius: 3px; }
        .fill-dl { background: var(--primary); width: 85%; }
        .fill-ul { background: var(--accent); width: 62%; }
        .speed-bar-val { font-size: .8rem; font-weight: 700; color: var(--text-1); min-width: 52px; text-align: right; }

        .floating-badge {
            position: absolute;
            background: #fff; border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            padding: .75rem 1rem;
            display: flex; align-items: center; gap: .6rem;
        }
        
        .floating-badge {
        z-index: 10;  /* atau nilai lebih tinggi dari hero-card */
        }

        .hero-card {
        z-index: 1;   /* pastikan lebih rendah dari badge */
        }
        .fb-top    { top: 10%; right: -8%; }
        .fb-bottom { bottom: 15%; left: -8%; }
        .fb-icon { width: 36px; height: 36px; border-radius: 9px; display: flex; align-items: center; justify-content: center; }
        .fb-icon-green { background: rgba(0,201,167,.12); }
        .fb-icon-orange{ background: rgba(255,159,67,.12); }
        .fb-text-title { font-size: .7rem; font-weight: 700; color: var(--text-1); }
        .fb-text-sub   { font-size: .65rem; color: var(--text-3); }

        /* ── SECTION SHARED ──────────────────────────────────── */
        .section { padding: 96px 5vw; }
        .section-alt { background: var(--surface-2); }
        .section-inner { max-width: 1200px; margin: 0 auto; }

        .section-tag {
            display: inline-flex; align-items: center; gap: .5rem;
            font-size: .78rem; font-weight: 700; color: var(--primary);
            text-transform: uppercase; letter-spacing: 1.2px;
            margin-bottom: 1rem;
        }
        .section-tag::before {
            content: ''; display: block;
            width: 18px; height: 2px; background: var(--primary); border-radius: 2px;
        }
        .section-title {
            font-size: clamp(1.7rem, 3vw, 2.5rem);
            font-weight: 800; letter-spacing: -1px; line-height: 1.2;
            color: var(--text-1); margin-bottom: 1rem;
        }
        .section-subtitle {
            font-size: 1.05rem; color: var(--text-2); max-width: 560px; line-height: 1.7;
        }
        .section-header { margin-bottom: 3.5rem; }
        .section-header-center { text-align: center; display: flex; flex-direction: column; align-items: center; }

        /* ── FEATURES ────────────────────────────────────────── */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        .feature-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 2rem;
            transition: all var(--transition);
            cursor: default;
        }
        .feature-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
        }
        .feature-icon {
            width: 52px; height: 52px; border-radius: 14px;
            background: var(--primary-light);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.25rem;
        }
        .feature-icon svg { width: 26px; height: 26px; stroke: var(--primary); fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .feature-title { font-size: 1.05rem; font-weight: 700; margin-bottom: .5rem; color: var(--text-1); }
        .feature-desc  { font-size: .9rem; color: var(--text-2); line-height: 1.65; }

        /* ── PACKAGES ────────────────────────────────────────── */
        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem; align-items: start;
        }
        .pkg-card {
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 2.25rem;
            transition: all var(--transition);
            position: relative; overflow: hidden;
        }
        .pkg-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-4px); }
        .pkg-card.featured {
            border-color: var(--primary);
            background: var(--primary);
            color: #fff;
        }
        .pkg-card.featured .pkg-price,
        .pkg-card.featured .pkg-name,
        .pkg-card.featured .pkg-speed { color: #fff; }
        .pkg-card.featured .pkg-period,
        .pkg-card.featured .pkg-desc,
        .pkg-card.featured .pkg-feature { color: rgba(255,255,255,.75); }
        .pkg-card.featured .pkg-divider { border-color: rgba(255,255,255,.2); }

        .pkg-badge-popular {
            position: absolute; top: 1.25rem; right: 1.25rem;
            background: #fff; color: var(--primary);
            font-size: .7rem; font-weight: 700;
            padding: .25rem .75rem; border-radius: 999px;
            letter-spacing: .5px;
        }
        .pkg-name  { font-size: .8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text-3); margin-bottom: .75rem; }
        .pkg-speed { font-size: 2.5rem; font-weight: 800; line-height: 1; color: var(--text-1); letter-spacing: -1.5px; }
        .pkg-speed span { font-size: 1rem; font-weight: 500; }
        .pkg-desc  { font-size: .875rem; color: var(--text-2); margin: .5rem 0 1.5rem; }
        .pkg-divider { border: none; border-top: 1px solid var(--border); margin: 1.5rem 0; }
        .pkg-price { font-size: 1.8rem; font-weight: 800; color: var(--text-1); letter-spacing: -1px; }
        .pkg-period{ font-size: .85rem; color: var(--text-3); margin-left: .25rem; font-weight: 400; }
        .pkg-features { list-style: none; display: flex; flex-direction: column; gap: .65rem; margin-bottom: 1.75rem; }
        .pkg-feature {
            display: flex; align-items: center; gap: .6rem;
            font-size: .875rem; color: var(--text-2);
        }
        .check-icon { width: 16px; height: 16px; flex-shrink: 0; }
        .btn-pkg-primary {
            display: block; text-align: center; width: 100%;
            padding: .85rem; border-radius: var(--radius-sm);
            font-weight: 700; font-size: .95rem; text-decoration: none;
            transition: all var(--transition); cursor: pointer; border: none;
        }
        .btn-pkg-primary.light {
            background: #fff; color: var(--primary);
        }
        .btn-pkg-primary.light:hover { background: #f0f4ff; }
        .btn-pkg-primary.dark {
            background: var(--primary); color: #fff;
            box-shadow: 0 2px 12px rgba(0,87,255,.28);
        }
        .btn-pkg-primary.dark:hover { background: var(--primary-dark); transform: translateY(-1px); }

        /* ── HOW IT WORKS ────────────────────────────────────── */
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem; position: relative;
        }
        .step-card { text-align: center; }
        .step-number {
            width: 56px; height: 56px; border-radius: 50%;
            background: var(--primary-light);
            color: var(--primary); font-size: 1.2rem; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
        }
        .step-title { font-size: 1rem; font-weight: 700; margin-bottom: .5rem; }
        .step-desc  { font-size: .875rem; color: var(--text-2); line-height: 1.65; }

        /* ── TESTIMONIALS ────────────────────────────────────── */
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .testi-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 2rem;
            transition: box-shadow var(--transition);
        }
        .testi-card:hover { box-shadow: var(--shadow-md); }
        .testi-stars { display: flex; gap: .2rem; margin-bottom: 1rem; }
        .star { color: #FBBF24; font-size: 1rem; }
        .testi-text { font-size: .95rem; color: var(--text-2); line-height: 1.7; margin-bottom: 1.5rem; font-style: italic; }
        .testi-author { display: flex; align-items: center; gap: .85rem; }
        .testi-avatar {
            width: 44px; height: 44px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; font-weight: 700; color: #fff;
            flex-shrink: 0;
        }
        .testi-name   { font-size: .9rem; font-weight: 700; color: var(--text-1); }
        .testi-loc    { font-size: .78rem; color: var(--text-3); }

        /* ── CTA BAND ─────────────────────────────────────────── */
        .cta-band {
            padding: 80px 5vw;
            background: linear-gradient(135deg, var(--primary) 0%, #0040CC 100%);
            text-align: center; overflow: hidden; position: relative;
        }
        .cta-band::before {
            content: '';
            position: absolute; top: -60%; left: -10%;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(255,255,255,.07) 0%, transparent 60%);
        }
        .cta-band h2 { font-size: clamp(1.8rem, 3.5vw, 2.8rem); font-weight: 800; color: #fff; margin-bottom: 1rem; letter-spacing: -1px; }
        .cta-band p  { color: rgba(255,255,255,.8); font-size: 1.05rem; margin-bottom: 2.5rem; max-width: 540px; margin-left: auto; margin-right: auto; }
        .cta-actions { display: flex; align-items: center; justify-content: center; gap: 1rem; flex-wrap: wrap; }
        .btn-white {
            background: #fff; color: var(--primary); font-weight: 700;
            padding: .9rem 2.2rem; border-radius: var(--radius-md);
            font-size: 1rem; text-decoration: none;
            display: inline-flex; align-items: center; gap: .5rem;
            transition: all var(--transition);
        }
        .btn-white:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.2); }
        .btn-outline-white {
            background: transparent; color: #fff;
            border: 2px solid rgba(255,255,255,.5);
            padding: .85rem 2rem; border-radius: var(--radius-md);
            font-size: 1rem; font-weight: 600; text-decoration: none;
            display: inline-flex; align-items: center; gap: .5rem;
            transition: all var(--transition);
        }
        .btn-outline-white:hover { border-color: #fff; background: rgba(255,255,255,.1); }

        /* ── FOOTER ──────────────────────────────────────────── */
        footer {
            background: var(--text-1);
            color: rgba(255,255,255,.7);
            padding: 64px 5vw 32px;
        }
        .footer-inner {
            max-width: 1200px; margin: 0 auto;
            display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 3rem;
        }
        .footer-brand .logo { color: #fff; margin-bottom: 1rem; display: inline-flex; }
        .footer-tagline { font-size: .875rem; line-height: 1.7; color: rgba(255,255,255,.55); max-width: 240px; margin-bottom: 1.5rem; }
        .footer-social { display: flex; gap: .75rem; }
        .social-link {
            width: 36px; height: 36px; border-radius: 8px;
            background: rgba(255,255,255,.08);
            display: flex; align-items: center; justify-content: center;
            text-decoration: none; transition: background var(--transition);
        }
        .social-link:hover { background: var(--primary); }
        .social-link svg { width: 16px; height: 16px; fill: rgba(255,255,255,.7); }

        .footer-col-title { font-size: .8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #fff; margin-bottom: 1.25rem; }
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: .65rem; }
        .footer-links a { font-size: .875rem; color: rgba(255,255,255,.55); text-decoration: none; transition: color var(--transition); }
        .footer-links a:hover { color: #fff; }

        .footer-bottom {
            max-width: 1200px; margin: 3rem auto 0;
            padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,.1);
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem;
            font-size: .8rem; color: rgba(255,255,255,.4);
        }

        /* ── COVERAGE MAP VISUAL ────────────────────────────── */
        .coverage-visual {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            display: flex; flex-direction: column; align-items: center;
            gap: 1.5rem;
        }
        .coverage-map-placeholder {
            width: 100%; max-width: 520px; height: 280px;
            background: linear-gradient(145deg, #EAF0FF, #F0FDF9);
            border-radius: var(--radius-md);
            position: relative; overflow: hidden;
            display: flex; align-items: center; justify-content: center;
        }
        .map-dots { position: absolute; inset: 0; }
        .map-dot {
            position: absolute; border-radius: 50%;
            background: var(--primary); opacity: .7;
            animation: pulse-dot 2s ease-in-out infinite;
        }
        .map-dot::after {
            content: ''; position: absolute; inset: -4px;
            border-radius: 50%; border: 2px solid var(--primary);
            opacity: .4; animation: ripple 2s ease-in-out infinite;
        }
        @keyframes pulse-dot { 0%,100%{transform:scale(1)} 50%{transform:scale(1.2)} }
        @keyframes ripple    { 0%{transform:scale(.7);opacity:.5} 100%{transform:scale(2);opacity:0} }

        .island-outline {
            width: 85%; max-width: 440px;
            fill: rgba(0,87,255,.08); stroke: rgba(0,87,255,.2); stroke-width: 1;
        }

        .coverage-cities {
            display: flex; flex-wrap: wrap; gap: .65rem; justify-content: center;
        }
        .city-tag {
            padding: .3rem .9rem; border-radius: 999px;
            background: var(--primary-light); color: var(--primary);
            font-size: .8rem; font-weight: 600;
        }

        /* ── COVERAGE SECTION ───────────────────────────────── */
        .coverage-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center;
        }
        .coverage-content .section-subtitle { max-width: 420px; }
        .coverage-list { list-style: none; display: flex; flex-direction: column; gap: .85rem; margin-top: 1.75rem; }
        .coverage-item {
            display: flex; align-items: flex-start; gap: .85rem;
        }
        .ci-icon {
            width: 36px; height: 36px; border-radius: 9px;
            background: var(--primary-light); flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .ci-icon svg { width: 18px; height: 18px; stroke: var(--primary); fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .ci-text strong { display: block; font-size: .9rem; font-weight: 700; color: var(--text-1); }
        .ci-text span   { font-size: .825rem; color: var(--text-2); }

        /* ── RESPONSIVE ──────────────────────────────────────── */
        @media (max-width: 900px) {
            .hero-inner { grid-template-columns: 1fr; gap: 3rem; }
            .hero-visual { display: none; }
            .coverage-grid { grid-template-columns: 1fr; }
            .footer-inner { grid-template-columns: 1fr 1fr; }
            .hero-stats { gap: 1.5rem; }
        }
        @media (max-width: 680px) {
            .nav-links, .nav-cta .btn-ghost { display: none; }
            .hamburger { display: flex; }
            .packages-grid { grid-template-columns: 1fr; }
            .footer-inner { grid-template-columns: 1fr; }
            .hero-stats { flex-wrap: wrap; gap: 1.25rem; }
        }

        /* ── SCROLL REVEAL ───────────────────────────────────── */
        .reveal { opacity: 0; transform: translateY(24px); transition: opacity .6s ease, transform .6s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="navbar" role="navigation" aria-label="Navigasi utama">
    <a href="#" class="logo" aria-label="NusaNet - Beranda">
        <div class="logo-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24"><path d="M1.5 8.25c5.64-5.64 14.78-5.88 20.72-.73M5.25 12c3.75-3.75 9.85-4.12 14.04-.75M9 15.75c1.88-1.88 4.94-2.06 7.02-.37M12 19.5v.01"/></svg>
        </div>
        NusaNet
    </a>
    <ul class="nav-links" role="list">
        <li><a href="#fitur">Fitur</a></li>
        <li><a href="#paket">Paket</a></li>
        <li><a href="#jangkauan">Jangkauan</a></li>
        <li><a href="#testimoni">Testimoni</a></li>
        <li><a href="#kontak">Kontak</a></li>
    </ul>
    <div class="nav-cta">
        <a href="#kontak" class="btn btn-ghost">Masuk</a>
        <a href="#paket" class="btn btn-primary">Mulai Sekarang</a>
    </div>
    <button class="hamburger" aria-label="Buka menu" aria-expanded="false" onclick="toggleMenu(this)">
        <span></span><span></span><span></span>
    </button>
</nav>

<!-- HERO -->
<section class="hero" aria-labelledby="hero-heading">
    <div class="hero-inner">
        <div class="hero-content">
            <div class="hero-badge" aria-label="Produk baru">
                <span class="badge-dot" aria-hidden="true"></span>
                Kini Tersedia di 50+ Kota Indonesia
            </div>
            <h1 class="hero-title" id="hero-heading">
                Internet <span class="highlight">Cepat & Andal</span><br>
                untuk Semua<br>Kalangan
            </h1>
            <p class="hero-subtitle">
                NusaNet menghadirkan koneksi WiFi fiber optik berkecepatan tinggi yang stabil, terjangkau, dan dapat diandalkan — dari Sabang sampai Merauke.
            </p>
            <div class="hero-actions">
                <a href="#paket" class="btn btn-primary btn-lg">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    Pilih Paket
                </a>
                <a href="#fitur" class="btn btn-ghost btn-lg">Pelajari Lebih Lanjut</a>
            </div>
            <div class="hero-stats" role="list" aria-label="Statistik perusahaan">
                <div class="stat-item" role="listitem">
                    <span class="stat-number">50+</span>
                    <span class="stat-label">Kota Terjangkau</span>
                </div>
                <div class="stat-item" role="listitem">
                    <span class="stat-number">500K+</span>
                    <span class="stat-label">Pelanggan Aktif</span>
                </div>
                <div class="stat-item" role="listitem">
                    <span class="stat-number">99.9%</span>
                    <span class="stat-label">Uptime SLA</span>
                </div>
                <div class="stat-item" role="listitem">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Dukungan Teknis</span>
                </div>
            </div>
        </div>

    <!-- Hero Visual Card -->
    <div class="hero-visual">
            <!-- Floating badge top-right -->
            <div class="floating-badge fb-top" aria-label="Sinyal Kuat: Fiber Optik Langsung">
                <div class="fb-icon fb-icon-green" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00C9A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><title>Sinyal Kuat</title><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div class="fb-text">
                    <div class="fb-text-title">Sinyal Kuat</div>
                    <div class="fb-text-sub">Fiber Optik Langsung</div>
                </div>
            </div>
            <!-- Main card -->
            <div class="hero-card" aria-label="Kartu Kecepatan Internet">
                <div class="speed-display">
                    <div class="speed-ring" role="img" aria-label="Kecepatan Unduh 300 Mbps">
                        <div class="speed-ring-inner">
                            <span class="speed-value">300</span>
                            <span class="speed-unit">Mbps</span>
                        </div>
                    </div>
                    <div class="speed-label">Kecepatan Unduh</div>
                </div>
                <div class="speed-bars">
                    <div class="speed-bar-row">
                        <div class="speed-bar-info">
                            <div class="speed-bar-icon icon-dl" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0057FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><title>Unduh</title><path d="M12 5v14M19 12l-7 7-7-7"/></svg>
                            </div>
                            <span class="speed-bar-name">Unduh</span>
                        </div>
                        <div class="speed-bar-track"><div class="speed-bar-fill fill-dl"></div></div>
                        <span class="speed-bar-val">300 Mbps</span>
                    </div>
                    <div class="speed-bar-row">
                        <div class="speed-bar-info">
                            <div class="speed-bar-icon icon-ul" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00C9A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><title>Unggah</title><path d="M12 19V5M5 12l7-7 7 7"/></svg>
                            </div>
                            <span class="speed-bar-name">Unggah</span>
                        </div>
                        <div class="speed-bar-track"><div class="speed-bar-fill fill-ul"></div></div>
                        <span class="speed-bar-val">150 Mbps</span>
                    </div>
                </div>
            </div>
            <!-- Floating badge bottom-left -->
            <div class="floating-badge fb-bottom" aria-label="Respons Cepat dengan Latensi kurang dari 5ms">
                <div class="fb-icon fb-icon-orange" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FF9F43" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><title>Respons Cepat</title><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="fb-text">
                    <div class="fb-text-title">Respons Cepat</div>
                    <div class="fb-text-sub">Latensi &lt; 5ms</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="section section-alt" id="fitur" aria-labelledby="fitur-heading">
    <div class="section-inner">
        <div class="section-header section-header-center reveal">
            <span class="section-tag">Fitur Unggulan</span>
            <h2 class="section-title" id="fitur-heading">Kenapa Memilih NusaNet?</h2>
            <p class="section-subtitle">Teknologi terdepan, dukungan terpercaya, dan harga yang bersahabat untuk kebutuhan internet Anda.</p>
        </div>
        <div class="features-grid">
            <article class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <h3 class="feature-title">Kecepatan Fiber Optik</h3>
                <p class="feature-desc">Nikmati kecepatan hingga 1 Gbps dengan teknologi fiber optik terkini. Streaming, gaming, dan WFH tanpa hambatan.</p>
            </article>
            <article class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="feature-title">Jaringan Aman & Terlindungi</h3>
                <p class="feature-desc">Proteksi jaringan berlapis dengan enkripsi end-to-end dan firewall canggih untuk menjaga privasi data Anda.</p>
            </article>
            <article class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <h3 class="feature-title">Uptime 99.9% Terjamin</h3>
                <p class="feature-desc">SLA uptime 99.9% didukung infrastruktur redundan dan tim NOC yang memantau jaringan 24 jam penuh.</p>
            </article>
            <article class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.07 1.18 2 2 0 012.05 0h3a2 2 0 012 1.72 12.5 12.5 0 00.34 1.91 2 2 0 01-.45 2.11L5.91 6.76a16 16 0 006.29 6.29l1.02-1.02a2 2 0 012.11-.45 12.5 12.5 0 001.91.34A2 2 0 0122 13.92z"/></svg>
                </div>
                <h3 class="feature-title">Dukungan 24/7</h3>
                <p class="feature-desc">Tim teknisi siap membantu kapan saja melalui telepon, live chat, atau kunjungan lapangan tanpa biaya tambahan.</p>
            </article>
            <article class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                </div>
                <h3 class="feature-title">Manajemen Mudah via App</h3>
                <p class="feature-desc">Pantau penggunaan, kelola perangkat, dan bayar tagihan langsung dari aplikasi NusaNet di smartphone Anda.</p>
            </article>
            <article class="feature-card reveal">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                </div>
                <h3 class="feature-title">Harga Transparan</h3>
                <p class="feature-desc">Tidak ada biaya tersembunyi. Harga sudah termasuk instalasi, modem WiFi, dan maintenance rutin setiap tahun.</p>
            </article>
        </div>
    </div>
</section>

<!-- PACKAGES -->
<section class="section" id="paket" aria-labelledby="paket-heading">
    <div class="section-inner">
        <div class="section-header section-header-center reveal">
            <span class="section-tag">Paket Internet</span>
            <h2 class="section-title" id="paket-heading">Pilih Paket yang Tepat</h2>
            <p class="section-subtitle">Tersedia paket untuk rumahan hingga korporat. Semua sudah termasuk instalasi gratis dan router WiFi.</p>
        </div>
        <div class="packages-grid">
            <!-- Basic -->
            <article class="pkg-card reveal">
                <div class="pkg-name">Paket Starter</div>
                <div class="pkg-speed">30 <span>Mbps</span></div>
                <p class="pkg-desc">Ideal untuk 1-2 pengguna, browsing dan streaming SD/HD.</p>
                <hr class="pkg-divider">
                <div>
                    <span class="pkg-price">Rp 149K</span>
                    <span class="pkg-period">/bulan</span>
                </div>
                <ul class="pkg-features" role="list" aria-label="Fitur paket starter">
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="#00C9A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Kecepatan 30 Mbps stabil
                    </li>
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="#00C9A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Kuota Unlimited
                    </li>
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="#00C9A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Router WiFi 4
                    </li>
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="#00C9A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Support 24/7
                    </li>
                </ul>
                <a href="#kontak" class="btn-pkg-primary dark" role="button">Pilih Paket Ini</a>
            </article>

            <!-- Popular -->
            <article class="pkg-card featured reveal">
                <div class="pkg-badge-popular" aria-label="Paling populer">Terpopuler</div>
                <div class="pkg-name">Paket Pro</div>
                <div class="pkg-speed">100 <span>Mbps</span></div>
                <p class="pkg-desc">Terbaik untuk keluarga dan WFH. Streaming 4K, video call tanpa lag.</p>
                <hr class="pkg-divider">
                <div>
                    <span class="pkg-price">Rp 299K</span>
                    <span class="pkg-period">/bulan</span>
                </div>
                <ul class="pkg-features" role="list" aria-label="Fitur paket pro">
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.9)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Kecepatan 100 Mbps stabil
                    </li>
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.9)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Kuota Unlimited
                    </li>
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.9)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Router WiFi 6 Dual-Band
                    </li>
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.9)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Prioritas Teknis VIP
                    </li>
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.9)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Static IP Opsional
                    </li>
                </ul>
                <a href="#kontak" class="btn-pkg-primary light" role="button">Pilih Paket Ini</a>
            </article>

            <!-- Business -->
            <article class="pkg-card reveal">
                <div class="pkg-name">Paket Bisnis</div>
                <div class="pkg-speed">300 <span>Mbps</span></div>
                <p class="pkg-desc">Solusi andal untuk UMKM, café, dan kantor kecil dengan traffic tinggi.</p>
                <hr class="pkg-divider">
                <div>
                    <span class="pkg-price">Rp 599K</span>
                    <span class="pkg-period">/bulan</span>
                </div>
                <ul class="pkg-features" role="list" aria-label="Fitur paket bisnis">
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="#00C9A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Kecepatan 300 Mbps dedicated
                    </li>
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="#00C9A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Kuota Unlimited Tanpa FUP
                    </li>
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="#00C9A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Router Enterprise + Mesh
                    </li>
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="#00C9A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        SLA 99.9% + Backup Link
                    </li>
                    <li class="pkg-feature">
                        <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="#00C9A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        2 Static IP + Panel Manajemen
                    </li>
                </ul>
                <a href="#kontak" class="btn-pkg-primary dark" role="button">Pilih Paket Ini</a>
            </article>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="section section-alt">
    <div class="section-inner">
        <div class="section-header section-header-center reveal">
            <span class="section-tag">Cara Kerja</span>
            <h2 class="section-title">Terhubung dalam 3 Langkah</h2>
            <p class="section-subtitle">Proses pendaftaran cepat dan instalasi profesional. Nikmati internet dalam waktu 1×24 jam.</p>
        </div>
        <div class="steps-grid">
            <div class="step-card reveal">
                <div class="step-number" aria-hidden="true">1</div>
                <h3 class="step-title">Pilih Paket</h3>
                <p class="step-desc">Pilih paket internet yang sesuai kebutuhan dan lokasi Anda. Cek ketersediaan jaringan secara instan.</p>
            </div>
            <div class="step-card reveal">
                <div class="step-number" aria-hidden="true">2</div>
                <h3 class="step-title">Daftar Online</h3>
                <p class="step-desc">Isi formulir pendaftaran secara online dalam 5 menit. Tidak perlu antri atau datang ke kantor.</p>
            </div>
            <div class="step-card reveal">
                <div class="step-number" aria-hidden="true">3</div>
                <h3 class="step-title">Instalasi Gratis</h3>
                <p class="step-desc">Teknisi kami akan datang ke lokasi Anda untuk instalasi kabel fiber dan konfigurasi router WiFi secara gratis.</p>
            </div>
            <div class="step-card reveal">
                <div class="step-number" aria-hidden="true">4</div>
                <h3 class="step-title">Nikmati Internet</h3>
                <p class="step-desc">Internet Anda sudah aktif. Pantau dan kelola koneksi kapan saja lewat aplikasi NusaNet di HP Anda.</p>
            </div>
        </div>
    </div>
</section>

<!-- COVERAGE -->
<section class="section" id="jangkauan" aria-labelledby="jangkauan-heading">
    <div class="section-inner">
        <div class="coverage-grid">
            <div class="coverage-content reveal">
                <span class="section-tag">Jangkauan Nasional</span>
                <h2 class="section-title" id="jangkauan-heading">Hadir di Seluruh Nusantara</h2>
                <p class="section-subtitle">Infrastruktur fiber optik kami terus berkembang, menjangkau kota-kota utama dan daerah terpencil di Indonesia.</p>
                <ul class="coverage-list" role="list">
                    <li class="coverage-item">
                        <div class="ci-icon"><svg viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="3"/></svg></div>
                        <div class="ci-text">
                            <strong>50+ Kota di Seluruh Indonesia</strong>
                            <span>Jawa, Bali, Sumatera, Kalimantan, Sulawesi, dan terus bertambah</span>
                        </div>
                    </li>
                    <li class="coverage-item">
                        <div class="ci-icon"><svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
                        <div class="ci-text">
                            <strong>Jaringan Backbone 10 Gbps</strong>
                            <span>Infrastruktur tulang punggung kapasitas tinggi untuk latensi rendah</span>
                        </div>
                    </li>
                    <li class="coverage-item">
                        <div class="ci-icon"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="2"/><path d="M7 2v20M17 2v20M2 12h20M2 7h5M2 17h5M17 17h5M17 7h5"/></svg></div>
                        <div class="ci-text">
                            <strong>200+ Node Distribusi</strong>
                            <span>Tersebar strategis untuk memastikan koneksi stabil ke setiap rumah</span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="coverage-visual reveal" aria-label="Peta jangkauan NusaNet">
                <div class="coverage-map-placeholder" role="img" aria-label="Ilustrasi peta Indonesia dengan titik jaringan">
                    <div class="map-dots" aria-hidden="true">
                        <!-- SVG peta stilistik Indonesia -->
                        <svg viewBox="0 0 520 280" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;position:absolute;inset:0" aria-hidden="true">
                            <!-- Sumatera -->
                            <ellipse cx="110" cy="155" rx="60" ry="28" fill="rgba(0,87,255,.1)" stroke="rgba(0,87,255,.3)" stroke-width="1.5" transform="rotate(-20,110,155)"/>
                            <!-- Jawa -->
                            <ellipse cx="250" cy="185" rx="80" ry="16" fill="rgba(0,87,255,.12)" stroke="rgba(0,87,255,.3)" stroke-width="1.5" transform="rotate(-5,250,185)"/>
                            <!-- Kalimantan -->
                            <ellipse cx="295" cy="125" rx="60" ry="52" fill="rgba(0,87,255,.1)" stroke="rgba(0,87,255,.3)" stroke-width="1.5"/>
                            <!-- Sulawesi -->
                            <ellipse cx="390" cy="120" rx="28" ry="45" fill="rgba(0,87,255,.1)" stroke="rgba(0,87,255,.3)" stroke-width="1.5" transform="rotate(15,390,120)"/>
                            <!-- Papua -->
                            <ellipse cx="465" cy="140" rx="45" ry="32" fill="rgba(0,87,255,.1)" stroke="rgba(0,87,255,.3)" stroke-width="1.5"/>
                            <!-- Bali -->
                            <circle cx="330" cy="188" r="10" fill="rgba(0,87,255,.12)" stroke="rgba(0,87,255,.3)" stroke-width="1.5"/>

                            <!-- Network dots -->
                            <circle cx="110" cy="155" r="5" fill="#0057FF" opacity=".9"/>
                            <circle cx="110" cy="155" r="12" fill="none" stroke="#0057FF" stroke-width="1.5" opacity=".4">
                                <animate attributeName="r" values="5;18;5" dur="2.5s" repeatCount="indefinite"/>
                                <animate attributeName="opacity" values=".6;0;.6" dur="2.5s" repeatCount="indefinite"/>
                            </circle>

                            <circle cx="250" cy="185" r="5" fill="#0057FF" opacity=".9"/>
                            <circle cx="250" cy="185" r="12" fill="none" stroke="#0057FF" stroke-width="1.5" opacity=".4">
                                <animate attributeName="r" values="5;18;5" dur="3s" repeatCount="indefinite"/>
                                <animate attributeName="opacity" values=".6;0;.6" dur="3s" repeatCount="indefinite"/>
                            </circle>

                            <circle cx="295" cy="130" r="5" fill="#0057FF" opacity=".9"/>
                            <circle cx="390" cy="120" r="4" fill="#00C9A7" opacity=".9"/>
                            <circle cx="465" cy="145" r="4" fill="#00C9A7" opacity=".9"/>
                            <circle cx="330" cy="188" r="3.5" fill="#0057FF" opacity=".8"/>

                            <!-- Connection lines -->
                            <line x1="110" y1="155" x2="250" y2="185" stroke="#0057FF" stroke-width="1" stroke-dasharray="4 4" opacity=".3"/>
                            <line x1="250" y1="185" x2="295" y2="130" stroke="#0057FF" stroke-width="1" stroke-dasharray="4 4" opacity=".3"/>
                            <line x1="295" y1="130" x2="390" y2="120" stroke="#0057FF" stroke-width="1" stroke-dasharray="4 4" opacity=".3"/>
                            <line x1="390" y1="120" x2="465" y2="145" stroke="#0057FF" stroke-width="1" stroke-dasharray="4 4" opacity=".3"/>
                        </svg>
                    </div>
                </div>
                <div class="coverage-cities" role="list" aria-label="Kota-kota yang terjangkau">
                    <span class="city-tag" role="listitem">Jakarta</span>
                    <span class="city-tag" role="listitem">Surabaya</span>
                    <span class="city-tag" role="listitem">Bandung</span>
                    <span class="city-tag" role="listitem">Medan</span>
                    <span class="city-tag" role="listitem">Bali</span>
                    <span class="city-tag" role="listitem">Makassar</span>
                    <span class="city-tag" role="listitem">Semarang</span>
                    <span class="city-tag" role="listitem">Yogyakarta</span>
                    <span class="city-tag" role="listitem">Palembang</span>
                    <span class="city-tag" role="listitem">+40 lainnya</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="section section-alt" id="testimoni" aria-labelledby="testimoni-heading">
    <div class="section-inner">
        <div class="section-header section-header-center reveal">
            <span class="section-tag">Testimoni</span>
            <h2 class="section-title" id="testimoni-heading">Dipercaya Ratusan Ribu Pelanggan</h2>
            <p class="section-subtitle">Dengarkan pengalaman nyata dari pelanggan NusaNet di seluruh Indonesia.</p>
        </div>
        <div class="testimonials-grid">
            <article class="testi-card reveal">
                <div class="testi-stars" aria-label="5 bintang">
                    <span class="star" aria-hidden="true">★</span><span class="star" aria-hidden="true">★</span><span class="star" aria-hidden="true">★</span><span class="star" aria-hidden="true">★</span><span class="star" aria-hidden="true">★</span>
                </div>
                <p class="testi-text">"Sejak pakai NusaNet, kerja dari rumah jauh lebih nyaman. Video call ke klien nggak pernah putus lagi. Tim teknisnya juga cepat banget respons kalau ada masalah."</p>
                <div class="testi-author">
                    <div class="testi-avatar" style="background:#0057FF;" aria-label="Avatar Budi Santoso">BS</div>
                    <div>
                        <div class="testi-name">Budi Santoso</div>
                        <div class="testi-loc">Konsultan IT, Jakarta</div>
                    </div>
                </div>
            </article>
            <article class="testi-card reveal">
                <div class="testi-stars" aria-label="5 bintang">
                    <span class="star" aria-hidden="true">★</span><span class="star" aria-hidden="true">★</span><span class="star" aria-hidden="true">★</span><span class="star" aria-hidden="true">★</span><span class="star" aria-hidden="true">★</span>
                </div>
                <p class="testi-text">"Warung kopi saya jadi lebih ramai setelah pasang NusaNet. Tamu senang karena WiFi-nya kencang dan stabil. Harganya juga cocok untuk usaha kecil."</p>
                <div class="testi-author">
                    <div class="testi-avatar" style="background:#00C9A7;" aria-label="Avatar Siti Rahayu">SR</div>
                    <div>
                        <div class="testi-name">Siti Rahayu</div>
                        <div class="testi-loc">Pemilik Café, Bandung</div>
                    </div>
                </div>
            </article>
            <article class="testi-card reveal">
                <div class="testi-stars" aria-label="5 bintang">
                    <span class="star" aria-hidden="true">★</span><span class="star" aria-hidden="true">★</span><span class="star" aria-hidden="true">★</span><span class="star" aria-hidden="true">★</span><span class="star" aria-hidden="true">★</span>
                </div>
                <p class="testi-text">"Gaming online tanpa lag itu impian. Dengan NusaNet 100 Mbps, ping di bawah 10ms. Instalasi juga cepat, teknisinya profesional dan ramah."</p>
                <div class="testi-author">
                    <div class="testi-avatar" style="background:#FF9F43;" aria-label="Avatar Rizky Pratama">RP</div>
                    <div>
                        <div class="testi-name">Rizky Pratama</div>
                        <div class="testi-loc">Gamers & Content Creator, Surabaya</div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA BAND -->
<section class="cta-band" id="kontak" aria-labelledby="cta-heading">
    <div class="section-inner">
        <h2 id="cta-heading">Siap Menikmati Internet Lebih Cepat?</h2>
        <p>Bergabunglah dengan 500.000+ pelanggan NusaNet. Daftar sekarang dan dapatkan instalasi gratis + 1 bulan pertama diskon 50%.</p>
        <div class="cta-actions">
            <a href="#paket" class="btn-white" role="button">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                Daftar Sekarang
            </a>
            <a href="tel:+62215001234" class="btn-outline-white" role="button">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a2 2 0 012-2.18h3a2 2 0 012 1.72 12.5 12.5 0 00.34 1.91 2 2 0 01-.45 2.11L8.91 8.76a16 16 0 006.29 6.29"/></svg>
                021 500-1234
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer role="contentinfo">
    <div class="footer-inner">
        <div class="footer-brand">
            <a href="#" class="logo" aria-label="NusaNet - Beranda">
                <div class="logo-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M1.5 8.25c5.64-5.64 14.78-5.88 20.72-.73M5.25 12c3.75-3.75 9.85-4.12 14.04-.75M9 15.75c1.88-1.88 4.94-2.06 7.02-.37M12 19.5v.01"/></svg>
                </div>
                NusaNet
            </a>
            <p class="footer-tagline">Internet cepat dan andal untuk semua kalangan di seluruh Indonesia.</p>
            <div class="footer-social" role="list" aria-label="Media sosial NusaNet">
                <a href="#" class="social-link" role="listitem" aria-label="Instagram NusaNet">
                    <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </a>
                <a href="#" class="social-link" role="listitem" aria-label="Twitter NusaNet">
                    <svg viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                </a>
                <a href="#" class="social-link" role="listitem" aria-label="LinkedIn NusaNet">
                    <svg viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                </a>
                <a href="#" class="social-link" role="listitem" aria-label="YouTube NusaNet">
                    <svg viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
                </a>
            </div>
        </div>
        <nav aria-label="Tautan layanan">
            <div class="footer-col-title">Layanan</div>
            <ul class="footer-links" role="list">
                <li><a href="#paket">Paket Rumahan</a></li>
                <li><a href="#paket">Paket Bisnis</a></li>
                <li><a href="#paket">Paket Korporat</a></li>
                <li><a href="#jangkauan">Cek Jangkauan</a></li>
                <li><a href="#">Dedicated Fiber</a></li>
            </ul>
        </nav>
        <nav aria-label="Tautan perusahaan">
            <div class="footer-col-title">Perusahaan</div>
            <ul class="footer-links" role="list">
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Berita & Blog</a></li>
                <li><a href="#">Karir</a></li>
                <li><a href="#">Mitra & Reseller</a></li>
                <li><a href="#">Keberlanjutan</a></li>
            </ul>
        </nav>
        <nav aria-label="Tautan dukungan">
            <div class="footer-col-title">Dukungan</div>
            <ul class="footer-links" role="list">
                <li><a href="#">Pusat Bantuan</a></li>
                <li><a href="#">Cek Gangguan</a></li>
                <li><a href="#">Panduan Instalasi</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
                <li><a href="#">Syarat & Ketentuan</a></li>
            </ul>
        </nav>
    </div>
    <div class="footer-bottom">
        <span>&copy; 2025 NusaNet Indonesia. Seluruh hak cipta dilindungi.</span>
        <span>PT Nusa Teknologi Internet &nbsp;·&nbsp; Terdaftar di Kominfo RI</span>
    </div>
</footer>

<script>
    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 24);
    }, { passive: true });

    // Scroll reveal
    const revealEls = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });
    revealEls.forEach(el => observer.observe(el));

    // Hamburger menu (mobile)
    function toggleMenu(btn) {
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', String(!expanded));
    }
</script>
</body>
</html>