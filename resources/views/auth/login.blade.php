<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}?v=2" type="image/png">
    <title>Login - My Platform</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Quicksand:wght@500;600;700&display=swap');

        :root {
            --bg: #0e0f13;
            --card: #16181f;
            --border: #2a2d38;
            --border-on: #f2f4f8;
            --text: #f2f4f8;
            --text-dim: #6b7080;
            --accent-1: #fb7185;
            --accent-2: #fbbf24;
            --accent-3: #34d399;
            --accent-4: #60a5fa;
            --bad: #fb7185;
            --good: #34d399;
            --purple: #7c3aed;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        @import url('https://fonts.googleapis.com/css2?family=Baloo+2:wght@700&family=Quicksand:wght@500&display=swap');

        /* ==========================================================================
   BIOLUMINESCENT TIDE BUTTON BASE & THEMES
   ========================================================================== */
        .ocean-btn {
            --bg-deep: #061821;
            --border-color: rgba(34, 211, 238, 0.35);
            --border-hover: rgba(124, 108, 232, 0.65);
            --glow-color: rgba(34, 211, 238, 0.45);
            --glow-secondary: rgba(124, 108, 232, 0.5);
            --foam: #e8fffb;
            --text-idle: #7fd8e0;

            /* Canvas Water & Crest Palette */
            --wave-top-hover: #1fb8c9;
            --wave-mid-hover: #0e6e86;
            --wave-bot-hover: #062634;
            --wave-top-idle: rgba(14, 148, 136, 0.55);
            --wave-mid-idle: rgba(9, 80, 95, 0.5);
            --wave-bot-idle: rgba(4, 30, 40, 0.45);
            --crest-stroke-hover: rgba(232, 255, 251, 0.9);
            --crest-stroke-idle: rgba(127, 216, 224, 0.45);
            --crest-shadow-hover: #7c6ce8;
            --crest-shadow-idle: #22d3ee;

            position: relative;
            isolation: isolate;
            padding: 10px 24px;
            min-height: 44px;
            border-radius: 16px;
            border: 1.5px solid var(--border-color);
            background: var(--bg-deep);
            cursor: pointer;
            overflow: hidden;
            outline-offset: 4px;
            transition: transform .4s cubic-bezier(.34, 1.56, .64, 1),
                border-color .4s ease,
                box-shadow .4s ease;
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0), inset 0 0 20px rgba(0, 0, 0, .4);
            -webkit-tap-highlight-color: transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* 1. INDIGO / PURPLE VARIANT (Log Activity) */
        .ocean-btn-indigo {
            --bg-deep: #0f172a;
            --border-color: rgba(99, 102, 241, 0.4);
            --border-hover: rgba(129, 140, 248, 0.8);
            --glow-color: rgba(99, 102, 241, 0.5);
            --glow-secondary: rgba(165, 180, 252, 0.5);
            --foam: #ffffff;
            --text-idle: #c7d2fe;

            --wave-top-hover: #6366f1;
            --wave-mid-hover: #4f46e5;
            --wave-bot-hover: #1e1b4b;
            --wave-top-idle: rgba(79, 70, 229, 0.55);
            --wave-mid-idle: rgba(49, 46, 129, 0.5);
            --wave-bot-idle: rgba(15, 23, 42, 0.45);
            --crest-stroke-hover: #e0e7ff;
            --crest-stroke-idle: rgba(199, 210, 254, 0.6);
            --crest-shadow-hover: #818cf8;
            --crest-shadow-idle: #6366f1;
        }

        /* 2. EMERALD / GREEN VARIANT (Export CSV) */
        .ocean-btn-emerald {
            --bg-deep: #022c22;
            --border-color: rgba(16, 185, 129, 0.4);
            --border-hover: rgba(52, 211, 153, 0.8);
            --glow-color: rgba(16, 185, 129, 0.5);
            --glow-secondary: rgba(110, 231, 183, 0.5);
            --foam: #ffffff;
            --text-idle: #a7f3d0;

            --wave-top-hover: #10b981;
            --wave-mid-hover: #059669;
            --wave-bot-hover: #064e3b;
            --wave-top-idle: rgba(5, 150, 105, 0.55);
            --wave-mid-idle: rgba(4, 120, 87, 0.5);
            --wave-bot-idle: rgba(2, 44, 34, 0.45);
            --crest-stroke-hover: #ecfdf5;
            --crest-stroke-idle: rgba(167, 243, 208, 0.6);
            --crest-shadow-hover: #34d399;
            --crest-shadow-idle: #10b981;
        }

        /* 3. AMBER / ORANGE VARIANT (Today's Handover) */
        .ocean-btn-amber {
            --bg-deep: #2d1202;
            --border-color: rgba(245, 158, 11, 0.4);
            --border-hover: rgba(251, 191, 36, 0.8);
            --glow-color: rgba(245, 158, 11, 0.5);
            --glow-secondary: rgba(253, 230, 138, 0.5);
            --foam: #ffffff;
            --text-idle: #fef3c7;

            --wave-top-hover: #f59e0b;
            --wave-mid-hover: #d97706;
            --wave-bot-hover: #451a03;
            --wave-top-idle: rgba(217, 119, 6, 0.55);
            --wave-mid-idle: rgba(180, 83, 9, 0.5);
            --wave-bot-idle: rgba(45, 18, 2, 0.45);
            --crest-stroke-hover: #fffbeb;
            --crest-stroke-idle: rgba(254, 243, 199, 0.6);
            --crest-shadow-hover: #fbbf24;
            --crest-shadow-idle: #f59e0b;
        }

        /* 4. SLATE / WHITE VARIANT (Filter) */
        .ocean-btn-slate {
            --bg-deep: #0f172a;
            --border-color: rgba(203, 213, 225, 0.4);
            --border-hover: rgba(241, 245, 249, 0.8);
            --glow-color: rgba(148, 163, 184, 0.45);
            --glow-secondary: rgba(203, 213, 225, 0.5);
            --foam: #ffffff;
            --text-idle: #494a4b;

            --wave-top-hover: #64748b;
            --wave-mid-hover: #475569;
            --wave-bot-hover: #1e293b;
            --wave-top-idle: rgba(71, 85, 105, 0.55);
            --wave-mid-idle: rgba(51, 65, 85, 0.5);
            --wave-bot-idle: rgba(15, 23, 42, 0.45);
            --crest-stroke-hover: #ffffff;
            --crest-stroke-idle: rgba(226, 232, 240, 0.6);
            --crest-shadow-hover: #cbd5e1;
            --crest-shadow-idle: #94a3b8;
        }

        /* Hover States */
        .ocean-btn:hover,
        .ocean-btn:focus-visible {
            transform: translateY(-3px) scale(1.03);
            border-color: var(--border-hover);
            box-shadow:
                0 12px 28px -8px var(--glow-color),
                0 0 20px -4px var(--glow-secondary),
                inset 0 0 20px rgba(0, 0, 0, .3);
        }

        .ocean-btn:active {
            transform: translateY(-1px) scale(1.01);
        }

        /* Canvas Layering */
        .ocean-btn .wave-canvas {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            display: block;
            z-index: 1;
            pointer-events: none;
        }

        /* Text Label Layering */
        .ocean-btn .label2 {
            position: relative;
            z-index: 3;
            font-family: 'Baloo 2', sans-serif;
            font-weight: 700;
            font-size: 24px;
            letter-spacing: 0.03em;
            color: var(--text-idle);
            text-shadow: 0 0 0 transparent;
            transition: color .5s ease, text-shadow .5s ease, letter-spacing .5s ease;
            pointer-events: none;
        }

        .ocean-btn:hover .label2,
        .ocean-btn:focus-visible .label2 {
            color: var(--foam);
            letter-spacing: 0.05em;
            text-shadow: 0 0 10px var(--border-hover), 0 0 20px var(--glow-secondary);
        }




        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 15% 15%, #2e1065 0%, #0f172a 60%, var(--bg) 100%);
            font-family: 'Quicksand', sans-serif;
            padding: 24px;
            color: var(--text);
        }

        /* SPLIT CARD CONTAINER */
        .login-card {
            width: 100%;
            max-width: 960px;
            display: flex;
            background: var(--card);
            border-radius: 32px;
            border: 1px solid var(--border);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6), 0 0 35px rgba(124, 58, 237, 0.25);
            overflow: hidden;
            min-height: 560px;
        }

        /* LEFT VISUAL PANEL */
        .card-visual {
            flex: 1.1;
            background: linear-gradient(145deg, #7c3aed 0%, #5b21b6 100%);
            padding: 40px 32px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .card-visual img {
            width: 100%;
            max-width: 370px;
            height: auto;
            object-fit: contain;
            margin: auto;
            filter: drop-shadow(0 12px 20px rgba(0, 0, 0, 0.35));
            transition: transform 0.3s ease;
        }

        .card-visual img:hover {
            transform: scale(1.03);
        }

        .visual-caption {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.6;
            max-width: 430px;
        }

        /* RIGHT FORM PANEL */
        .card-form {
            flex: 1;
            padding: 44px 44px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: var(--card);
        }

        .welcome-pill {
            display: inline-block;
            background: var(--purple);
            color: #ffffff;
            padding: 6px 18px;
            border-radius: 20px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .form-header-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text);
            margin-top: 14px;
            margin-bottom: 28px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* ================= YOUR EXACT CUSTOM INPUT FIELD FORMAT ================= */
        .field {
            position: relative;
        }

        .label {
            position: absolute;
            left: 22px;
            top: 24px;
            display: inline-flex;
            pointer-events: none;
            transform-origin: left top;
            transition: transform .32s cubic-bezier(.34, 1.56, .64, 1), top .32s ease;
        }

        .label .ch {
            display: inline-block;
            color: var(--text-dim);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 18px;
            opacity: 0;
            translate: 0 10px;
            animation: chIn .5s cubic-bezier(.34, 1.56, .64, 1) forwards;
            animation-delay: calc(var(--i) * 0.045s + var(--group-delay, 0s));
        }

        @keyframes chIn {
            to {
                opacity: 1;
                translate: 0 0;
            }
        }

        .field.active .label,
        .field.filled .label {
            top: 12px;
            transform: scale(.72);
        }

        .field.active .label .ch,
        .field.filled .label .ch {
            color: var(--accent-4);
        }

        .field.invalid.filled .label .ch {
            color: var(--bad);
        }

        .box {
            position: relative;
            height: 68px;
            border-radius: 16px;
            border: 1.5px solid var(--border);
            background: #101218;
            overflow: hidden;
            transition: height .4s cubic-bezier(.65, 0, .35, 1), border-color .3s ease;
        }

        .field.active .box {
            height: 90px;
            border-color: var(--border-on);
        }

        .field.invalid.filled .box {
            border-color: var(--bad);
        }

        input {
            all: unset;
            position: absolute;
            left: 22px;
            right: 58px;
            bottom: 12px;
            color: var(--text);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 22px;
            transition: bottom .3s ease;
        }

        .field.active input,
        .field.filled input {
            bottom: 14px;
        }

        .field.has-toggle input {
            right: 98px;
        }

        .underline {
            position: absolute;
            left: 0;
            bottom: 0;
            height: 4px;
            width: 100%;
            background: linear-gradient(90deg, var(--accent-1), var(--accent-2), var(--accent-3), var(--accent-4));
            background-size: 300% 100%;
            background-position: 0% 0%;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .45s cubic-bezier(.65, 0, .35, 1), background-position .6s ease;
        }

        .field.active .underline {
            transform: scaleX(1);
        }

        .field.invalid.filled .underline {
            background: var(--bad);
            transform: scaleX(1);
        }

        /* ICON */
        .icon {
            position: absolute;
            right: 18px;
            top: 50%;
            translate: 0 -50%;
            width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            rotate: -35deg;
            scale: 0;
            transition: scale .4s cubic-bezier(.34, 1.56, .64, 1), rotate .3s ease;
        }

        .field.active .icon {
            scale: 1;
            rotate: 0deg;
        }

        .icon svg {
            width: 100%;
            height: 100%;
        }

        .icon path,
        .icon circle {
            fill: none;
            stroke: var(--text-dim);
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: stroke .3s ease;
        }

        .field.active .icon path,
        .field.active .icon circle {
            stroke: var(--accent-4);
        }

        /* CLEAR BUTTON */
        .clear {
            all: unset;
            position: absolute;
            right: 16px;
            top: 50%;
            translate: 0 -50%;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            scale: 0;
            opacity: 0;
            transition: scale .3s cubic-bezier(.34, 1.56, .64, 1), opacity .2s ease, background .2s ease;
        }

        .field.filled .clear {
            scale: 1;
            opacity: 1;
        }

        .field.filled .icon {
            scale: 0;
        }

        .field.has-toggle.filled .clear {
            right: 58px;
        }

        .clear:hover {
            background: #232633;
        }

        .clear svg {
            width: 15px;
            height: 15px;
        }

        .clear path {
            stroke: var(--text-dim);
            stroke-width: 2;
            stroke-linecap: round;
        }

        .clear:hover path {
            stroke: var(--text);
        }

        /* PASSWORD TOGGLE EYE */
        .toggle {
            all: unset;
            position: absolute;
            right: 16px;
            top: 50%;
            translate: 0 -50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 50%;
            transition: background .2s ease;
        }

        .toggle:hover {
            background: #232633;
        }

        .toggle svg {
            width: 22px;
            height: 22px;
        }

        .toggle path,
        .toggle circle,
        .toggle line {
            fill: none;
            stroke: var(--text-dim);
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: stroke .3s ease;
        }

        .field.active .toggle path,
        .field.active .toggle circle {
            stroke: var(--accent-4);
        }

        .toggle .slash {
            stroke-dasharray: 26;
            stroke-dashoffset: 26;
            transition: stroke-dashoffset .3s ease;
        }

        .toggle.revealed .slash {
            stroke-dashoffset: 0;
        }

        .helper {
            margin-top: 6px;
            min-height: 18px;
            font-size: 14px;
            color: var(--text-dim);
            display: flex;
            justify-content: space-between;
        }

        .field.invalid.filled~.helper .msg {
            color: var(--bad);
        }

        .field.filled:not(.invalid)~.helper .msg {
            color: var(--accent-3);
        }

        /* SUBMIT BUTTON & OCEAN STYLES */
        .submit {
            all: unset;
            margin-top: 10px;
            height: 58px;
            border-radius: 16px;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            font-size: 18px;
            text-align: center;
            cursor: pointer;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform .2s cubic-bezier(.34, 1.56, .64, 1), box-shadow .3s ease;
        }

        .submit.ocean-btn,
        .ocean-btn {
            position: relative !important;
            overflow: hidden !important;
            isolation: isolate;
        }

        .ocean-btn-emerald {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff !important;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.35);
        }

        .ocean-btn-emerald:hover {
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
            box-shadow: 0 14px 32px rgba(16, 185, 129, 0.5);
            transform: translateY(-2px);
        }

        .ocean-btn-emerald:active {
            transform: translateY(0) scale(0.98);
        }

        .ocean-ripple {
            position: absolute;
            border-radius: 50%;
            transform: scale(0);
            animation: wave-expand 0.65s cubic-bezier(0.25, 1, 0.5, 1) forwards;
            background: rgba(255, 255, 255, 0.45);
            pointer-events: none;
            z-index: 1;
        }

        @keyframes wave-expand {
            0% {
                transform: scale(0);
                opacity: 0.8;
            }

            100% {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* FOOTER ACTION LINKS */
        .form-actions {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            margin-top: 10px;
        }

        .form-link {
            font-size: 1.3rem;
            color: var(--text-dim);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .form-link:hover {
            color: var(--accent-4);
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
            }

            .card-form {
                padding: 32px 24px;
            }
        }

        .brand-logo-wrapper {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .brand-logo {
            height: 100px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.25));
            transition: .5s ease-in-out;
        }

        .brand-logo:hover {
            transform: scale(1.03);
        }
    </style>
</head>

<body>

    <div class="login-card">

        <!-- LEFT VISUAL PANEL -->
        <div class="card-visual">
            <div style="height: 1px;"></div>

            <!-- STEP-BY-STEP IMG WITH FALLBACK -->
            <img src="{{ asset('images/login-illustration.png') }}"
                data-fallback="https://illustrations.popsy.co/purple/surfer.svg"
                alt="Palfa Platform Illustration"
                onerror="this.onerror=null; this.src=this.dataset.fallback;">

            <!-- PROJECT-RELATED CAPTION -->
            <div class='text-wrapper'>
                <p class="visual-caption text" id='typing'>
                </p>
                <span class='cursor'>|</span>
            </div>
        </div>

        <!-- RIGHT FORM PANEL -->
        <div class="card-form">
            <div>
                <div class="brand-logo-wrapper">
                    <img src="{{ asset('images/company_logo_FILL.png') }}"
                        data-fallback="https://illustrations.popsy.co/purple/surfer.svg"
                        alt="Palfa Platform Illustration"
                        onerror="this.onerror=null; this.src=this.dataset.fallback;" class="brand-logo">
                </div>
                <span class="welcome-pill">Welcome back</span>
                <h2 class="form-header-title">Login your account</h2>

                <!-- Session Status Message -->
                @if (session('status'))
                <div style="color: var(--good); font-size: 0.85rem; margin-bottom: 15px;">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- 1. EMAIL / USERNAME INPUT (EXACT CUSTOM FORMAT) -->
                    <div class="field" data-label="Email Address" data-type="email">
                        <div class="box">
                            <input type="email"
                                name="email"
                                value="{{ old('email') }}"
                                autocomplete="off"
                                spellcheck="false"
                                maxlength="60"
                                required
                                autofocus />
                            <span class="label"></span>
                            <span class="underline"></span>
                            <span class="icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M3 6h18v12H3z" />
                                    <path d="M3 7l9 6 9-6" />
                                </svg>
                            </span>
                            <button type="button" class="clear" aria-label="Clear"><svg viewBox="0 0 24 24">
                                    <path d="M5 5l14 14M19 5L5 19" />
                                </svg></button>
                        </div>
                        <div class="helper">
                            <span class="msg">name@example.com</span>
                            @error('email')
                            <span style="color: var(--bad);">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- 2. PASSWORD INPUT (EXACT CUSTOM FORMAT WITH TOGGLE EYE) -->
                    <div class="field has-toggle" data-label="Password" data-type="password">
                        <div class="box">
                            <input type="password"
                                name="password"
                                autocomplete="off"
                                maxlength="64"
                                required />
                            <span class="label"></span>
                            <span class="underline"></span>
                            <button type="button" class="clear" aria-label="Clear"><svg viewBox="0 0 24 24">
                                    <path d="M5 5l14 14M19 5L5 19" />
                                </svg></button>
                            <button type="button" class="toggle" aria-label="Toggle Password">
                                <svg viewBox="0 0 24 24">
                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                                    <circle cx="12" cy="12" r="3" />
                                    <line class="slash" x1="3" y1="3" x2="21" y2="21" />
                                </svg>
                            </button>
                        </div>
                        <div class="helper">
                            <span class="msg">Enter password</span>
                            @error('password')
                            <span style="color: var(--bad);">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON WITH OCEAN RIPPLE -->
                    <button type="submit" class="submit ocean-btn ocean-btn-emerald">
                        Login
                    </button>

                    <!-- FOOTER LINKS -->
                    <div class="form-actions">
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="form-link">Create Account</a>
                        @endif

                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="form-link">Forgot Password?</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

    </div>


    <!-- ================= FULL INTERACTIVE JAVASCRIPT ================= -->
    <script defer>
        // text animation typing
        const cursor_wlc = document.querySelector('.cursor');
        const text_wlc = "Welcome to My Application Support Activity Tracker - Efficiently log daily support tasks, manage shift handovers, monitor system reconciliations, and generate real-time operaational reports. ";
        let i_wlc = 0;
        const el_wlc = document.getElementById('typing');



        function type_welc() {
            if (i_wlc < text_wlc.length) {
                el_wlc.innerHTML = text_wlc.slice(0, i_wlc);
                i_wlc++;

                setTimeout(type_welc, 15); // speed control
            } else {
                cursor_wlc.style.display = 'none';

            }
        }

        //  type_welc();
        setTimeout(type_welc, 1000)

        let filterCounter = 0;

        function createButtonFilter(btnId) {
            const filterId = `liquid-filter-${btnId}`;
            const dispId = `disp-${btnId}`;

            let svgContainer = document.getElementById('ocean-svg-filters');
            if (!svgContainer) {
                svgContainer = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                svgContainer.id = 'ocean-svg-filters';
                svgContainer.setAttribute('width', '0');
                svgContainer.setAttribute('height', '0');
                svgContainer.style.position = 'absolute';
                svgContainer.style.pointerEvents = 'none';
                document.body.appendChild(svgContainer);
            }

            const filterMarkup = `
    <filter id="${filterId}" x="-30%" y="-30%" width="160%" height="160%">
      <feTurbulence type="fractalNoise" baseFrequency="0.012 0.045" numOctaves="2" seed="7" result="turb"/>
      <feDisplacementMap id="${dispId}" in="SourceGraphic" in2="turb" scale="0" xChannelSelector="R" yChannelSelector="G"/>
    </filter>
  `;
            svgContainer.insertAdjacentHTML('beforeend', filterMarkup);

            return {
                filterId,
                dispId
            };
        }

        function initOceanButtons() {
            const buttons = document.querySelectorAll('.ocean-btn:not([data-ocean-ready])');

            buttons.forEach((btn) => {
                btn.setAttribute('data-ocean-ready', 'true');
                const uniqueId = ++filterCounter;

                // 1. Generate unique liquid filter
                const {
                    filterId,
                    dispId
                } = createButtonFilter(uniqueId);

                // 2. Clear text and inject canvas + label
                const originalText = btn.textContent.trim();
                btn.textContent = '';

                const canvas = document.createElement('canvas');
                canvas.className = 'wave-canvas';

                const label = document.createElement('span');
                label.className = 'label2';
                label.textContent = originalText;
                label.style.filter = `url(#${filterId})`;

                btn.appendChild(canvas);
                btn.appendChild(label);

                const ctx = canvas.getContext('2d');
                const dispEl = document.getElementById(dispId);

                let dpr = Math.min(window.devicePixelRatio || 1, 2);
                let W = 0,
                    H = 0;

                function resizeCanvas() {
                    const rect = btn.getBoundingClientRect();
                    W = rect.width || 120;
                    H = rect.height || 44;
                    canvas.width = W * dpr;
                    canvas.height = H * dpr;
                    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
                }
                resizeCanvas();
                window.addEventListener('resize', resizeCanvas);

                let hovered = false;
                btn.addEventListener('mouseenter', () => hovered = true);
                btn.addEventListener('mouseleave', () => hovered = false);
                btn.addEventListener('focus', () => hovered = true);
                btn.addEventListener('blur', () => hovered = false);

                // Dynamic water state variables
                let waterLevel = 6;
                let amplitude = 2;
                let turbScale = 0;
                let sparkles = [];

                function spawnSparkle(nearSurface) {
                    sparkles.push({
                        x: Math.random() * W,
                        y: nearSurface ? H - waterLevel + (Math.random() * 6 - 3) : H - Math.random() * waterLevel,
                        r: 0.6 + Math.random() * 1.2,
                        vy: 0.15 + Math.random() * 0.3,
                        alpha: 0.6 + Math.random() * 0.4,
                        life: 0,
                        maxLife: 40 + Math.random() * 40
                    });
                }

                let t = 0;
                let spawnAcc = 0;

                function renderFrame() {
                    t += 0.02;

                    const targetLevel = hovered ? H * 1.35 : Math.max(6, H * 0.16);
                    const targetAmp = hovered ? 6 : 2;
                    const targetTurb = hovered ? 5 : 0;

                    waterLevel += (targetLevel - waterLevel) * 0.07;
                    amplitude += (targetAmp - amplitude) * 0.07;
                    turbScale += (targetTurb - turbScale) * 0.12;

                    if (dispEl) {
                        dispEl.setAttribute('scale', turbScale.toFixed(2));
                    }

                    ctx.clearRect(0, 0, W, H);

                    const surfaceY = H - waterLevel;

                    // Read current button theme colors dynamically from CSS variables
                    const style = getComputedStyle(btn);
                    const waveTopHover = style.getPropertyValue('--wave-top-hover').trim() || '#1fb8c9';
                    const waveMidHover = style.getPropertyValue('--wave-mid-hover').trim() || '#0e6e86';
                    const waveBotHover = style.getPropertyValue('--wave-bot-hover').trim() || '#062634';
                    const waveTopIdle = style.getPropertyValue('--wave-top-idle').trim() || 'rgba(14,148,136,0.55)';
                    const waveMidIdle = style.getPropertyValue('--wave-mid-idle').trim() || 'rgba(9,80,95,0.5)';
                    const waveBotIdle = style.getPropertyValue('--wave-bot-idle').trim() || 'rgba(4,30,40,0.45)';

                    const strokeHover = style.getPropertyValue('--crest-stroke-hover').trim() || 'rgba(232,255,251,0.9)';
                    const strokeIdle = style.getPropertyValue('--crest-stroke-idle').trim() || 'rgba(127,216,224,0.45)';
                    const shadowHover = style.getPropertyValue('--crest-shadow-hover').trim() || '#7c6ce8';
                    const shadowIdle = style.getPropertyValue('--crest-shadow-idle').trim() || '#22d3ee';

                    // 1. Draw sine wave water body
                    ctx.beginPath();
                    ctx.moveTo(0, H + 4);
                    const step = 4;
                    for (let x = 0; x <= W; x += step) {
                        const y = surfaceY +
                            amplitude * Math.sin(x * 0.045 + t * 1.6) +
                            amplitude * 0.6 * Math.sin(x * 0.09 - t * 2.3 + 1.4) +
                            amplitude * 0.35 * Math.sin(x * 0.16 + t * 3.1 + 2.6);
                        ctx.lineTo(x, y);
                    }
                    ctx.lineTo(W + 4, H + 4);
                    ctx.closePath();

                    const grad = ctx.createLinearGradient(0, surfaceY - amplitude, 0, H);
                    grad.addColorStop(0, hovered ? waveTopHover : waveTopIdle);
                    grad.addColorStop(0.5, hovered ? waveMidHover : waveMidIdle);
                    grad.addColorStop(1, hovered ? waveBotHover : waveBotIdle);
                    ctx.fillStyle = grad;
                    ctx.fill();

                    // 2. Draw glowing crest stroke
                    ctx.beginPath();
                    for (let x = 0; x <= W; x += step) {
                        const y = surfaceY +
                            amplitude * Math.sin(x * 0.045 + t * 1.6) +
                            amplitude * 0.6 * Math.sin(x * 0.09 - t * 2.3 + 1.4) +
                            amplitude * 0.35 * Math.sin(x * 0.16 + t * 3.1 + 2.6);
                        if (x === 0) ctx.moveTo(x, y);
                        else ctx.lineTo(x, y);
                    }
                    ctx.strokeStyle = hovered ? strokeHover : strokeIdle;
                    ctx.lineWidth = 1.4;
                    ctx.shadowColor = hovered ? shadowHover : shadowIdle;
                    ctx.shadowBlur = hovered ? 12 : 5;
                    ctx.stroke();
                    ctx.shadowBlur = 0;

                    // 3. Render bioluminescent plankton sparkles
                    spawnAcc += hovered ? 0.8 : 0.12;
                    while (spawnAcc >= 1) {
                        spawnSparkle(Math.random() < 0.5);
                        spawnAcc -= 1;
                    }

                    sparkles.forEach(s => {
                        s.life += 1;
                        s.y -= s.vy;
                        const fade = 1 - s.life / s.maxLife;
                        if (fade <= 0) return;
                        const r = s.r * (0.6 + 0.4 * Math.sin(s.life * 0.2));
                        const g = ctx.createRadialGradient(s.x, s.y, 0, s.x, s.y, r * 3);
                        g.addColorStop(0, `rgba(232,255,251,${(s.alpha * fade).toFixed(2)})`);
                        g.addColorStop(1, 'rgba(232,255,251,0)');
                        ctx.fillStyle = g;
                        ctx.beginPath();
                        ctx.arc(s.x, s.y, r * 3, 0, Math.PI * 2);
                        ctx.fill();
                    });
                    sparkles = sparkles.filter(s => s.life < s.maxLife && s.y > -10);

                    requestAnimationFrame(renderFrame);
                }

                requestAnimationFrame(renderFrame);
            });
        }

        document.addEventListener('DOMContentLoaded', initOceanButtons);


        document.addEventListener('DOMContentLoaded', () => {
            // 1. INPUT FIELD ANIMATIONS & VALIDATION LOGIC
            const fields = [...document.querySelectorAll('.field')];
            let groupDelay = 0;

            fields.forEach((field) => {
                const labelText = field.dataset.label;
                const labelEl = field.querySelector('.label');
                const input = field.querySelector('input');
                const clearBtn = field.querySelector('.clear');
                const toggleBtn = field.querySelector('.toggle');

                // Build letter spans for character animation
                [...labelText].forEach((ch, i) => {
                    const span = document.createElement('span');
                    span.className = 'ch';
                    if (ch === ' ') span.innerHTML = '&nbsp;';
                    else span.textContent = ch;
                    span.style.setProperty('--i', i);
                    span.style.setProperty('--group-delay', groupDelay + 's');
                    labelEl.appendChild(span);
                });
                groupDelay += 0.06;

                function validate() {
                    const val = input.value;
                    const filled = val.trim().length > 0;
                    field.classList.toggle('filled', filled);

                    let invalid = false;
                    if (field.dataset.type === 'email' && filled) {
                        invalid = !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
                    }
                    if (field.dataset.type === 'password' && filled) {
                        invalid = val.length < 6;
                    }
                    field.classList.toggle('invalid', invalid);

                    const msg = field.querySelector('.helper .msg');
                    if (msg) {
                        if (field.dataset.type === 'email') {
                            msg.textContent = filled ? (invalid ? 'Enter a valid email' : 'Valid email format') : 'name@example.com';
                        } else if (field.dataset.type === 'password') {
                            msg.textContent = filled ? (invalid ? 'Minimum 6 characters' : 'Password entered') : 'Enter password';
                        }
                    }
                }

                input.addEventListener('focus', () => field.classList.add('active'));
                input.addEventListener('blur', () => field.classList.remove('active'));
                input.addEventListener('input', validate);

                if (clearBtn) {
                    clearBtn.addEventListener('click', () => {
                        input.value = '';
                        input.focus();
                        validate();
                    });
                }

                if (toggleBtn) {
                    toggleBtn.addEventListener('click', () => {
                        const revealed = toggleBtn.classList.toggle('revealed');
                        input.type = revealed ? 'text' : 'password';
                    });
                }

                validate();
            });

            // 2. OCEAN BUTTON RIPPLE EFFECT (EVENT DELEGATION)
            document.addEventListener('click', (e) => {
                const btn = e.target.closest('.ocean-btn');
                if (!btn) return;

                const oldRipple = btn.querySelector('.ocean-ripple');
                if (oldRipple) oldRipple.remove();

                const rect = btn.getBoundingClientRect();
                const diameter = Math.max(btn.clientWidth, btn.clientHeight);
                const radius = diameter / 2;

                const circle = document.createElement('span');
                circle.className = 'ocean-ripple';
                circle.style.width = circle.style.height = `${diameter}px`;
                circle.style.left = `${e.clientX - rect.left - radius}px`;
                circle.style.top = `${e.clientY - rect.top - radius}px`;

                btn.appendChild(circle);

                setTimeout(() => circle.remove(), 650);
            });
        });
    </script>
</body>

</html>