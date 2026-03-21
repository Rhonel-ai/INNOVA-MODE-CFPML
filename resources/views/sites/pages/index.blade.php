@extends('layouts.admin.site')
@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Cormorant+Garamond:wght@300;400;600&family=Bebas+Neue&family=Montserrat:wght@300;400;500;600&display=swap');

        /* ─── VARIABLES ──────────────────────────────────────── */
        :root {
            --terracotta:       #C0522A;
            --terracotta-light: #D4693D;
            --navy:             #1A2744;
            --gold:             #C9A84C;
            --gold-light:       #E2C97E;
            --cream:            #F5F0E8;
            --sand:             #E8DDD0;
            --white:            #FFFFFF;
            --muted:            #8A7F75;
            --grey-bg:          #D3D3D3;
            --grey-mid:         #BEBEBE;
            --grey-dark:        #9E9E9E;
            --on-grey:          #1A2744;
            --on-grey-muted:    #5C5C5C;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--grey-bg);
            color: var(--on-grey);
            font-family: 'Montserrat', sans-serif;
        }

        /* ─── HERO ───────────────────────────────────────────── */
        .primes-hero {
            position: relative;
            min-height: 72vh;
            background: linear-gradient(135deg, #CBCBCB 0%, #D8D8D8 45%, #C8C8C8 100%);
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 0;
        }

        .primes-hero::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 55% 70% at 78% 55%, rgba(192,82,42,0.14) 0%, transparent 65%),
                radial-gradient(ellipse 40% 55% at 10% 18%, rgba(201,168,76,0.10) 0%, transparent 60%),
                radial-gradient(ellipse 30% 40% at 50% 100%, rgba(26,39,68,0.07) 0%, transparent 60%);
            pointer-events: none;
        }

        .primes-hero::after {
            content: '';
            position: absolute;
            top: -20%; right: 30%;
            width: 2px; height: 140%;
            background: linear-gradient(to bottom, transparent 0%, var(--terracotta) 40%, var(--gold) 70%, transparent 100%);
            transform: rotate(-12deg);
            opacity: 0.55;
        }

        .hero-inner {
            position: relative; z-index: 2;
            width: 100%; max-width: 1280px;
            margin: 0 auto; padding: 80px 64px;
            display: grid; grid-template-columns: 1.1fr 1fr;
            gap: 60px; align-items: center;
        }

        /* Brand strip */
        .brand-strip {
            display: flex; align-items: center;
            gap: 14px; margin-bottom: 36px;
        }

        .brand-logo-wrap {
            width: 64px; height: 64px;
            border-radius: 50%;
            border: 2px solid var(--gold);
            background: var(--navy);
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 20px rgba(201,168,76,0.30), 0 4px 12px rgba(0,0,0,0.18);
            flex-shrink: 0;
        }

        .brand-logo-wrap img { width: 100%; height: 100%; object-fit: cover; }

        .brand-logo-placeholder {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 15px; color: var(--gold);
            letter-spacing: 1px; text-align: center;
        } 

        .brand-meta { display: flex; flex-direction: column; gap: 2px; }

        .brand-presenter {
            font-family: 'Montserrat', sans-serif;
            font-size: 9px; font-weight: 700;
            letter-spacing: 4px; text-transform: uppercase;
            color: var(--terracotta);
        }

        .brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px; font-weight: 600;
            color: var(--navy); letter-spacing: 0.5px;
        }

        /* Eyebrow */
        .hero-eyebrow {
            display: flex; align-items: center; gap: 12px;
            font-family: 'Montserrat', sans-serif;
            font-size: 10px; font-weight: 700;
            letter-spacing: 6px; text-transform: uppercase;
            color: var(--terracotta); margin-bottom: 18px;
        }

        .hero-eyebrow::after {
            content: '';
            display: block; width: 70px; height: 1px;
            background: linear-gradient(to right, var(--terracotta), transparent);
        }

        /* Titre */
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(60px, 7vw, 90px);
            font-weight: 900; line-height: 0.88;
            color: var(--navy); margin-bottom: 8px;
        }

        .hero-title .accent-word {
            display: block; color: var(--terracotta); font-style: italic;
        }

        .hero-title .year-tag {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px; color: var(--gold);
            letter-spacing: 4px; vertical-align: super;
            margin-left: 8px; font-style: normal;
        }

        /* Tagline */
        .hero-tagline {
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px; font-weight: 400;
            color: var(--on-grey-muted); line-height: 1.75;
            margin: 28px 0 40px;
            padding-left: 18px;
            border-left: 3px solid var(--terracotta);
            max-width: 440px;
        }

        /* Pills */
        .hero-meta { display: flex; gap: 14px; flex-wrap: wrap; }

        .hero-meta-item {
            display: flex; align-items: center; gap: 9px;
            padding: 10px 18px;
            background: rgba(255,255,255,0.55);
            border: 1px solid rgba(192,82,42,0.25);
            border-radius: 2px;
            backdrop-filter: blur(4px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .hero-meta-item i { color: var(--terracotta); font-size: 13px; }

        .hero-meta-item span {
            font-family: 'Montserrat', sans-serif;
            font-size: 11px; font-weight: 600;
            color: var(--navy); letter-spacing: 1px;
        }

        /* Panneau déco droite */
        .hero-visual {
            display: flex; flex-direction: column;
            align-items: flex-end; gap: 16px;
        }

        .hero-phases-label {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 72px; line-height: 1;
            color: rgba(26,39,68,0.06);
            letter-spacing: 8px; user-select: none;
            text-align: right; margin-bottom: -24px;
        }

        .hero-deco-frame {
            position: relative;
            width: 100%; max-width: 360px;
        }

        .hero-deco-frame::before {
            content: '';
            position: absolute; top: -10px; right: -10px;
            width: 100%; height: 100%;
            border: 1px solid rgba(201,168,76,0.30);
            pointer-events: none;
        }

        /* ─── STATS BAR ──────────────────────────────────────── */
        .stats-section {
            background: var(--white);
            padding: 0;
            border-top: 3px solid var(--terracotta);
            border-bottom: 1px solid var(--grey-mid);
            box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        }

        .stats-inner {
            max-width: 1280px; margin: 0 auto;
            padding: 0 64px;
            display: grid; grid-template-columns: repeat(3, 1fr);
        }

        .stat-tile {
            padding: 36px 28px;
            display: flex; align-items: center; gap: 20px;
            border-right: 1px solid rgba(26,39,68,0.10);
            transition: background 0.3s;
        }

        .stat-tile:last-child { border-right: none; }
        .stat-tile:hover      { background: rgba(192,82,42,0.04); }

        .stat-icon-wrap {
            width: 50px; height: 50px;
            background: var(--navy);
            display: flex; align-items: center; justify-content: center;
            border-radius: 2px; flex-shrink: 0;
        }

        .stat-icon-wrap i { color: var(--gold); font-size: 19px; }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 38px; font-weight: 900;
            color: var(--navy); line-height: 1;
        }

        .stat-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 10px; font-weight: 700;
            letter-spacing: 3px; text-transform: uppercase;
            color: var(--terracotta); margin-top: 4px;
        }

        /* ─── PHASES SECTION ─────────────────────────────────── */
        .phases-section {
            background: var(--grey-bg);
            padding: 72px 64px 90px;
        }

        .phases-container { max-width: 1280px; margin: 0 auto; }

        .section-header { text-align: center; margin-bottom: 60px; }

        .section-overline {
            display: block;
            font-family: 'Montserrat', sans-serif;
            font-size: 10px; font-weight: 700;
            letter-spacing: 6px; text-transform: uppercase;
            color: var(--terracotta); margin-bottom: 12px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 44px; font-weight: 900; color: var(--navy);
        }

        .section-title .accent { color: var(--terracotta); font-style: italic; }

        .section-rule {
            display: flex; align-items: center; justify-content: center;
            gap: 14px; margin-top: 16px;
        }

        .section-rule::before,
        .section-rule::after {
            content: ''; display: block;
            width: 60px; height: 1px;
            background: linear-gradient(to right, transparent, var(--gold));
        }

        .section-rule::after { background: linear-gradient(to left, transparent, var(--gold)); }
        .rule-diamond { width: 6px; height: 6px; background: var(--gold); transform: rotate(45deg); }

        /* ── Event Cards ── */
        .event-card {
            position: relative;
            display: grid; grid-template-columns: 1fr 1.65fr;
            background: var(--white);
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 3px;
            margin-bottom: 28px; overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
            transition: transform 0.32s ease, box-shadow 0.32s ease;
        }

        .event-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.14);
        }

        .event-card::before {
            content: '';
            position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
            border-radius: 3px 0 0 3px;
        }

        .event-card.active::before    { background: linear-gradient(to bottom, var(--terracotta), var(--gold)); }
        .event-card.upcoming::before  { background: var(--gold); }
        .event-card.completed::before { background: var(--grey-mid); }

        /* Panneau gauche */
        .card-header-panel {
            padding: 36px 34px;
            display: flex; flex-direction: column; justify-content: space-between;
            background: var(--grey-bg);
            border-right: 1px solid rgba(0,0,0,0.07);
        }

        .status-row {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 20px; flex-wrap: wrap;
        }

        .status-pill {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 5px 14px; border-radius: 100px;
            font-family: 'Montserrat', sans-serif;
            font-size: 10px; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase;
        }

        .pill-active    { background: rgba(192,82,42,0.12); color: var(--terracotta);   border: 1px solid rgba(192,82,42,0.30); }
        .pill-upcoming  { background: rgba(201,168,76,0.14); color: #8A6A10;            border: 1px solid rgba(201,168,76,0.40); }
        .pill-completed { background: rgba(0,0,0,0.06);      color: var(--on-grey-muted); border: 1px solid rgba(0,0,0,0.12); }

        .pulse-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: currentColor;
            animation: pulse-anim 1.7s ease-in-out infinite;
        }

        @keyframes pulse-anim {
            0%, 100% { opacity: 1;    transform: scale(1); }
            50%       { opacity: 0.35; transform: scale(0.65); }
        }

        .card-time-remaining {
            font-family: 'Montserrat', sans-serif;
            font-size: 11px; font-weight: 500;
            color: var(--terracotta); letter-spacing: 1px;
        }

        .card-event-name {
            font-family: 'Playfair Display', serif;
            font-size: 26px; font-weight: 900;
            color: var(--navy); line-height: 1.18; margin-bottom: 10px;
        }

        .card-event-desc {
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px; font-weight: 400;
            color: var(--on-grey-muted); line-height: 1.65;
        }

        /* Bloc leader */
        .leader-block {
            padding: 16px 20px;
            background: rgba(192,82,42,0.07);
            border-left: 3px solid var(--terracotta);
        }

        .leader-block.winner-block {
            background: rgba(201,168,76,0.10);
            border-left-color: var(--gold);
        }

        .leader-overline {
            font-family: 'Montserrat', sans-serif;
            font-size: 9px; font-weight: 700;
            letter-spacing: 4px; text-transform: uppercase;
            color: var(--terracotta); margin-bottom: 6px;
        }

        .winner-block .leader-overline { color: #8A6A10; }

        .leader-name-display {
            font-family: 'Playfair Display', serif;
            font-size: 20px; font-weight: 700;
            color: var(--navy); margin-bottom: 5px;
        }

        .leader-sub { display: flex; gap: 14px; flex-wrap: wrap; }

        .leader-badge {
            font-family: 'Montserrat', sans-serif;
            font-size: 11px; font-weight: 500; color: var(--on-grey-muted);
        }

        /* Panneau droit */
        .card-body-panel {
            padding: 36px 38px;
            display: flex; flex-direction: column;
            justify-content: space-between; gap: 24px;
            background: var(--white);
        }

        .details-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 4px 24px;
        }

        .detail-cell {
            display: flex; flex-direction: column; gap: 3px;
            padding: 13px 0;
            border-bottom: 1px solid rgba(0,0,0,0.07);
        }

        .detail-cell-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 9px; font-weight: 700;
            letter-spacing: 3px; text-transform: uppercase;
            color: var(--grey-dark);
        }

        .detail-cell-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px; font-weight: 600;
            color: var(--navy); line-height: 1.2;
        }

        /* Footer */
        .card-footer-row {
            display: flex; align-items: center;
            justify-content: space-between; flex-wrap: wrap; gap: 16px;
            padding-top: 10px;
            border-top: 1px solid rgba(0,0,0,0.07);
        }

        .price-tag { display: flex; flex-direction: column; gap: 2px; }

        .price-lbl {
            font-family: 'Montserrat', sans-serif;
            font-size: 9px; font-weight: 700;
            letter-spacing: 3px; text-transform: uppercase;
            color: var(--grey-dark);
        }

        .price-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px; letter-spacing: 2px;
            color: var(--gold); line-height: 1;
        }

        /* Boutons */
        .btn-vote {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 13px 28px;
            font-family: 'Montserrat', sans-serif;
            font-size: 11px; font-weight: 700;
            letter-spacing: 3px; text-transform: uppercase;
            border: none; border-radius: 2px;
            cursor: pointer; transition: all 0.28s ease;
        }

        .btn-vote-active {
            background: linear-gradient(135deg, var(--terracotta) 0%, var(--terracotta-light) 100%);
            color: var(--white);
            box-shadow: 0 6px 20px rgba(192,82,42,0.30);
        }

        .btn-vote-active:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(192,82,42,0.45);
        }

        .btn-vote-active i { font-size: 13px; }

        .btn-vote-disabled {
            background: var(--grey-bg);
            color: var(--grey-dark);
            cursor: not-allowed;
            border: 1px solid var(--grey-mid);
        }

        /* ─── MODAL ──────────────────────────────────────────── */
        .modal-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(26,39,68,0.88);
            z-index: 1000;
            align-items: center; justify-content: center;
            backdrop-filter: blur(6px);
        }

        /* ─── RESPONSIVE ─────────────────────────────────────── */
        @media (max-width: 980px) {
            .hero-inner        { grid-template-columns: 1fr; padding: 56px 32px; }
            .hero-visual       { display: none; }
            .stats-inner       { grid-template-columns: 1fr; padding: 0 32px; }
            .stat-tile         { border-right: none; border-bottom: 1px solid rgba(26,39,68,0.10); }
            .stat-tile:last-child { border-bottom: none; }
            .event-card        { grid-template-columns: 1fr; }
            .card-header-panel { border-right: none; border-bottom: 1px solid rgba(0,0,0,0.07); }
            .phases-section    { padding: 56px 32px 72px; }
        }

        @media (max-width: 580px) {
            .hero-title        { font-size: 52px; }
            .details-grid      { grid-template-columns: 1fr; }
            .card-footer-row   { flex-direction: column; align-items: flex-start; }
            .btn-vote          { width: 100%; justify-content: center; }
            .hero-meta         { flex-direction: column; }
        }
    </style>

    <!-- ═══════════════ HERO ════════════════════════════════════ -->
    <section class="primes-hero">
        <div class="hero-inner">

            <!-- Colonne gauche -->
            <div class="hero-left">

                <div class="brand-strip">
                    <div class="brand-logo-wrap">
                        <img src="{{ asset('site/assets/images/logo.png') }}" alt="CFPML">
                    </div>
                    <div class="brand-meta">
                        <span class="brand-presenter">Présenté par</span>
                        <span class="brand-name">Centre de Formation Professionnel Des Métiers Libéraux</span>
                    </div>
                </div>

                <div class="hero-eyebrow">Compétition Innova Mode 2026</div>

                <h1 class="hero-title">
                    <em class="accent-word">Innova</em>
                    Mode<span class="year-tag">2026</span>
                </h1>

                <p class="hero-tagline">
                    Chaque pièce est confectionnée avec une grande attention portée aux détails,
                    reflétant notre engagement envers la qualité et le style.
                </p>

                <div class="hero-meta">
                    <div class="hero-meta-item">
                        <i class="fas fa-trophy"></i>
                        <span>{{ $stats['total_primes'] }} phases au total</span>
                    </div>
                    <div class="hero-meta-item">
                        <i class="fas fa-play-circle"></i>
                        <span>{{ $stats['in_progress'] }} en cours</span>
                    </div>
                    <div class="hero-meta-item">
                        <i class="fas fa-clock"></i>
                        <span>{{ $stats['upcoming'] }} à venir</span>
                    </div>
                </div>
            </div>

            <!-- Colonne droite déco -->
            <div class="hero-visual">
                <div class="hero-phases-label">INNOVA MODE</div>
                <div class="hero-deco-frame">
                    <div style="
                        background: rgba(255,255,255,0.60);
                        border: 1px solid rgba(201,168,76,0.35);
                        padding: 40px;
                        display: flex; flex-direction: column; gap: 16px;
                        backdrop-filter: blur(6px);
                        box-shadow: 0 8px 32px rgba(0,0,0,0.10);
                    ">
                        <div style="font-family:'Bebas Neue',sans-serif;font-size:13px;letter-spacing:4px;color:var(--terracotta);">SAMEDI 18.04.26</div>
                        <div style="font-family:'Playfair Display',serif;font-size:20px;color:var(--navy);font-style:italic;line-height:1.3;">Akpakpa — Salle des fêtes St Charbel</div>
                        <div style="font-family:'Cormorant Garamond',serif;font-size:15px;color:var(--on-grey-muted);">
                            À côté de l'Hôtel du Lac
                        </div>
                        <div style="height:1px;background:linear-gradient(to right,var(--terracotta),var(--gold),transparent);"></div>
                        <div style="font-family:'Montserrat',sans-serif;font-size:10px;font-weight:700;color:var(--on-grey-muted);letter-spacing:3px;text-transform:uppercase;">À partir de 18h</div>
                        <div style="
                            display:inline-flex;align-items:center;justify-content:center;
                            padding:12px 24px; margin-top:6px;
                            background:var(--navy);
                            border:1px solid var(--gold);
                            font-family:'Bebas Neue',sans-serif;
                            font-size:22px;letter-spacing:3px;
                            color:var(--gold);
                        ">PASS · 5 000 F</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ═══════════════ STATS BAR ═══════════════════════════════ -->
    {{-- <section class="stats-section">
        <div class="stats-inner">
            <div class="stat-tile">
                <div class="stat-icon-wrap"><i class="fas fa-trophy"></i></div>
                <div class="stat-text">
                    <div class="stat-number">{{ $stats['total_primes'] }}</div>
                    <div class="stat-label">Phases Total</div>
                </div>
            </div>
            <div class="stat-tile">
                <div class="stat-icon-wrap"><i class="fas fa-play-circle"></i></div>
                <div class="stat-text">
                    <div class="stat-number">{{ $stats['in_progress'] }}</div>
                    <div class="stat-label">En Cours</div>
                </div>
            </div>
            <div class="stat-tile">
                <div class="stat-icon-wrap"><i class="fas fa-clock"></i></div>
                <div class="stat-text">
                    <div class="stat-number">{{ $stats['upcoming'] }}</div>
                    <div class="stat-label">À Venir</div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- ═══════════════ PHASES / EVENTS ════════════════════════ -->
    {{-- <section class="phases-section"> --}}
        {{-- <div class="phases-container"> --}}

            {{-- <div class="section-header">
                <span class="section-overline">Compétition · Innova Mode 2026</span>
                <h2 class="section-title">Les <span class="accent">Phases</span></h2>
                <div class="section-rule"><span class="rule-diamond"></span></div>
            </div> --}}

            {{-- ── EN COURS ── --}}
            {{-- @foreach ($eventsInProgress as $event)
            <div class="event-card active">
                <div class="card-header-panel">
                    <div>
                        <div class="status-row">
                            <span class="status-pill pill-active"><span class="pulse-dot"></span> En Cours</span>
                            <span class="card-time-remaining">{{ $event->time_remaining }}</span>
                        </div>
                        <h3 class="card-event-name">{{ $event->name }}</h3>
                        <p class="card-event-desc">{{ $event->description }}</p>
                    </div>
                    @if ($stats['topUser'])
                    <div class="leader-block" style="margin-top:24px;">
                        <div class="leader-overline">Leader actuel</div>
                        <div class="leader-name-display">{{ $stats['topUser']->first_name }} {{ $stats['topUser']->last_name }}</div>
                        <div class="leader-sub">
                            <span class="leader-badge"><i class="fas fa-vote-yea"></i> {{ $stats['topUser']->votes }} votes</span>
                            <span class="leader-badge">Code : {{ $stats['topUser']->code }}</span>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-body-panel">
                    <div class="details-grid">
                        <div class="detail-cell">
                            <span class="detail-cell-label">Candidats</span>
                            <span class="detail-cell-value">{{ $stats['totalCandidats'] }}</span>
                        </div>
                        <div class="detail-cell">
                            <span class="detail-cell-label">Votes</span>
                            <span class="detail-cell-value">{{ $stats['totalVotes'] }}</span>
                        </div>
                        <div class="detail-cell">
                            <span class="detail-cell-label">Début</span>
                            <span class="detail-cell-value">{{ $event->start_date->format('d/m/Y') }}</span>
                        </div>
                        <div class="detail-cell">
                            <span class="detail-cell-label">Fin</span>
                            <span class="detail-cell-value">{{ $event->end_date->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    <div class="card-footer-row">
                        <div class="price-tag">
                            <span class="price-lbl">Prix par vote</span>
                            <span class="price-val">100 FCFA</span>
                        </div>
                        <button class="btn-vote btn-vote-active" onclick="window.location.href='/'">
                            <i class="fas fa-hand-point-up"></i> Voter Maintenant
                        </button>
                    </div>
                </div>
            </div>
            @endforeach --}}

            {{-- ── À VENIR ── --}}
            {{-- @foreach ($upcomingEvents as $event)
            <div class="event-card upcoming">
                <div class="card-header-panel">
                    <div>
                        <div class="status-row">
                            <span class="status-pill pill-upcoming">À Venir</span>
                        </div>
                        <h3 class="card-event-name">{{ $event->name }}</h3>
                        <p class="card-event-desc">{{ $event->description }}</p>
                    </div>
                </div>
                <div class="card-body-panel">
                    <div class="details-grid">
                        <div class="detail-cell">
                            <span class="detail-cell-label">Candidats</span>
                            <span class="detail-cell-value">—</span>
                        </div>
                        <div class="detail-cell">
                            <span class="detail-cell-label">Votes</span>
                            <span class="detail-cell-value">0</span>
                        </div>
                        <div class="detail-cell">
                            <span class="detail-cell-label">Début</span>
                            <span class="detail-cell-value">{{ $event->start_date->format('d/m/Y') }}</span>
                        </div>
                        <div class="detail-cell">
                            <span class="detail-cell-label">Fin</span>
                            <span class="detail-cell-value">{{ $event->end_date->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    <div class="card-footer-row">
                        <div class="price-tag">
                            <span class="price-lbl">Prix par vote</span>
                            <span class="price-val">100 FCFA</span>
                        </div>
                        <button class="btn-vote btn-vote-disabled" disabled>Indisponible</button>
                    </div>
                </div>
            </div>
            @endforeach --}}

            {{-- ── TERMINÉS ── --}}
            {{-- @foreach ($completedEvents as $event)
            <div class="event-card completed">
                <div class="card-header-panel">
                    <div>
                        <div class="status-row">
                            <span class="status-pill pill-completed">Terminé</span>
                        </div>
                        <h3 class="card-event-name">{{ $event->name }}</h3>
                        <p class="card-event-desc">{{ $event->description }}</p>
                    </div>
                    @if ($event->leader)
                    <div class="leader-block winner-block" style="margin-top:24px;">
                        <div class="leader-overline">🏆 Gagnant</div>
                        <div class="leader-name-display">{{ $event->leader->first_name }} {{ $event->leader->last_name }}</div>
                    </div>
                    @endif
                </div>
                <div class="card-body-panel">
                    <div class="details-grid">
                        <div class="detail-cell">
                            <span class="detail-cell-label">Candidats</span>
                            <span class="detail-cell-value">—</span>
                        </div>
                        <div class="detail-cell">
                            <span class="detail-cell-label">Votes</span>
                            <span class="detail-cell-value">—</span>
                        </div>
                        <div class="detail-cell">
                            <span class="detail-cell-label">Début</span>
                            <span class="detail-cell-value">{{ $event->start_date->format('d/m/Y') }}</span>
                        </div>
                        <div class="detail-cell">
                            <span class="detail-cell-label">Fin</span>
                            <span class="detail-cell-value">{{ $event->end_date->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    <div class="card-footer-row">
                        <div class="price-tag">
                            <span class="price-lbl">Prix par vote</span>
                            <span class="price-val">100 FCFA</span>
                        </div>
                        <button class="btn-vote btn-vote-disabled" disabled>Indisponible</button>
                    </div>
                </div>
            </div>
            @endforeach --}}

        {{-- </div> --}}
    {{-- </section> --}}

    {{-- Modal (inchangé) --}}
    <div class="modal-overlay" id="modalOverlay">
        ...
    </div>

@endsection