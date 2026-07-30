<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}?v=2" type="image/png">
    <title>Forgot Password - My Support Tracker</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Quicksand:wght@500;600;700&family=Baloo+2:wght@700&display=swap');

        :root {
            --bg:        #0e0f13;
            --card:      #16181f;
            --border:    #2a2d38;
            --border-on: #f2f4f8;
            --text:      #f2f4f8;
            --text-dim:  #6b7080;
            --accent-1:  #fb7185;
            --accent-2:  #fbbf24;
            --accent-3:  #34d399;
            --accent-4:  #60a5fa;
            --bad:       #fb7185;
            --good:      #34d399;
            --purple:    #7c3aed;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

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
        .register-card {
            width: 100%;
            max-width: 960px;
            display: flex;
            background: var(--card);
            border-radius: 32px;
            border: 1px solid var(--border);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6), 0 0 35px rgba(124, 58, 237, 0.25);
            overflow: hidden;
            min-height: 620px;
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

        .text-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 320px;
        }

        .visual-caption {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.6;
            display: inline;
        }

        .cursor {
            font-size: 1.3rem;
            color: var(--accent-4);
            font-weight: 700;
            margin-left: 2px;
            animation: blink 0.8s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        /* RIGHT FORM PANEL */
        .card-form {
            flex: 1.1;
            padding: 36px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: var(--card);
        }

        .brand-logo-wrapper {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
        }

        .brand-logo {
            height: 100px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.25));
        }

        .welcome-pill {
            display: inline-block;
            background: var(--purple);
            color: #ffffff;
            padding: 5px 16px;
            border-radius: 20px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .form-header-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text);
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .status-alert {
            background: rgba(52, 211, 153, 0.12);
            border: 1px solid var(--accent-3);
            color: var(--accent-3);
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.9rem;
            margin-bottom: 16px;
            font-family: 'Space Grotesk', sans-serif;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* ================= CUSTOM INTERACTIVE INPUT FORMAT ================= */
        .field { position: relative; }

        .label {
            position: absolute;
            left: 20px;
            top: 20px;
            display: inline-flex;
            pointer-events: none;
            transform-origin: left top;
            transition: transform .32s cubic-bezier(.34,1.56,.64,1), top .32s ease;
        }

        .label .ch {
            display: inline-block;
            color: var(--text-dim);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 16px;
            opacity: 0;
            translate: 0 10px;
            animation: chIn .5s cubic-bezier(.34,1.56,.64,1) forwards;
            animation-delay: calc(var(--i) * 0.04s + var(--group-delay, 0s));
        }
        @keyframes chIn { to { opacity: 1; translate: 0 0; } }

        .field.active .label,
        .field.filled .label {
            top: 10px;
            transform: scale(.72);
        }
        .field.active .label .ch,
        .field.filled .label .ch { color: var(--accent-4); }
        .field.invalid.filled .label .ch { color: var(--bad); }

        .box {
            position: relative;
            height: 60px;
            border-radius: 14px;
            border: 1.5px solid var(--border);
            background: #101218;
            overflow: hidden;
            transition: height .35s cubic-bezier(.65,0,.35,1), border-color .3s ease;
        }
        .field.active .box {
            height: 76px;
            border-color: var(--border-on);
        }
        .field.invalid.filled .box { border-color: var(--bad); }

        input {
            all: unset;
            position: absolute;
            left: 20px;
            right: 54px;
            bottom: 10px;
            color: var(--text);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 22px;
            transition: bottom .3s ease;
        }
        .field.active input,
        .field.filled input { bottom: 10px; }

        .underline {
            position: absolute;
            left: 0; bottom: 0;
            height: 3px;
            width: 100%;
            background: linear-gradient(90deg, var(--accent-1), var(--accent-2), var(--accent-3), var(--accent-4));
            background-size: 300% 100%;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .45s cubic-bezier(.65,0,.35,1);
        }
        .field.active .underline { transform: scaleX(1); }
        .field.invalid.filled .underline { background: var(--bad); transform: scaleX(1); }

        /* CLEAR BUTTON */
        .clear {
            all: unset;
            position: absolute;
            right: 14px;
            top: 50%;
            translate: 0 -50%;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            scale: 0;
            opacity: 0;
            transition: scale .3s cubic-bezier(.34,1.56,.64,1), opacity .2s ease, background .2s ease;
        }
        .field.filled .clear { scale: 1; opacity: 1; }
        .clear:hover { background: #232633; }
        .clear svg { width: 16px; height: 16px; }
        .clear path { stroke: var(--text-dim); stroke-width: 2; stroke-linecap: round; }

        .helper {
            margin-top: 4px;
            min-height: 16px;
            font-size: 13px;
            color: var(--text-dim);
            display: flex;
            justify-content: space-between;
        }
        .field.invalid.filled ~ .helper .msg { color: var(--bad); }
        .field.filled:not(.invalid) ~ .helper .msg { color: var(--accent-3); }

        /* ================= BIOLUMINESCENT TIDE BUTTON BASE ================= */
        .ocean-btn {
            --bg-deep: #061821;
            --border-color: rgba(34, 211, 238, 0.35);
            --border-hover: rgba(124, 108, 232, 0.65);
            --glow-color: rgba(34, 211, 238, 0.45);
            --glow-secondary: rgba(124, 108, 232, 0.5);
            --foam: #e8fffb;
            --text-idle: #7fd8e0;

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
            min-height: 52px;
            border-radius: 16px;
            border: 1.5px solid var(--border-color);
            background: var(--bg-deep);
            cursor: pointer;
            overflow: hidden;
            outline-offset: 4px;
            transition: transform .4s cubic-bezier(.34,1.56,.64,1), border-color .4s ease, box-shadow .4s ease;
            box-shadow: 0 0 0 0 rgba(0,0,0,0), inset 0 0 20px rgba(0,0,0,.4);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            margin-top: 6px;
        }

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

        .ocean-btn:hover, .ocean-btn:focus-visible {
            transform: translateY(-3px) scale(1.02);
            border-color: var(--border-hover);
            box-shadow: 0 12px 28px -8px var(--glow-color), 0 0 20px -4px var(--glow-secondary), inset 0 0 20px rgba(0,0,0,.3);
        }

        .ocean-btn:active {
            transform: translateY(-1px) scale(1.01);
        }

        .ocean-btn .wave-canvas {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            display: block;
            z-index: 1;
            pointer-events: none;
        }

        .ocean-btn .label2 {
            position: relative;
            z-index: 3;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 18px;
            letter-spacing: 0.03em;
            color: var(--text-idle);
            transition: color .5s ease, text-shadow .5s ease, letter-spacing .5s ease;
            pointer-events: none;
        }

        .ocean-btn:hover .label2, .ocean-btn:focus-visible .label2 {
            color: var(--foam);
            letter-spacing: 0.05em;
            text-shadow: 0 0 10px var(--border-hover), 0 0 20px var(--glow-secondary);
        }

        .ocean-ripple {
            position: absolute;
            border-radius: 50%;
            transform: scale(0);
            animation: wave-expand 0.65s cubic-bezier(0.25, 1, 0.5, 1) forwards;
            background: rgba(255, 255, 255, 0.45);
            pointer-events: none;
            z-index: 4;
        }

        @keyframes wave-expand {
            0% { transform: scale(0); opacity: 0.8; }
            100% { transform: scale(4); opacity: 0; }
        }

        /* FOOTER LINK */
        .form-actions {
            display: flex;
            justify-content: center;
            margin-top: 12px;
        }

        .form-link {
            font-size: 1.1rem;
            color: var(--text-dim);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .form-link:hover { color: var(--accent-4); }

        @media (max-width: 768px) {
            .register-card { flex-direction: column; }
            .card-form { padding: 28px 20px; }
        }
    </style>
</head>
<body>

    <div class="register-card">
        
        <!-- LEFT VISUAL PANEL -->
        <div class="card-visual">
            <div style="height: 1px;"></div>

            <img src="{{ asset('images/login-illustration.png') }}" 
                 data-fallback="https://illustrations.popsy.co/purple/surfer.svg"
                 alt="Npontu Tracker Illustration"
                 onerror="this.onerror=null; this.src=this.dataset.fallback;">

            <div class='text-wrapper'>
                <p class="visual-caption text" id='typing'></p>
                <span class='cursor'>|</span>
            </div>
        </div>

        <!-- RIGHT FORM PANEL -->
        <div class="card-form">
            <div>
                <!-- BRAND LOGO -->
                <div class="brand-logo-wrapper">
                    <img src="{{ asset('images/company_logo_FILL.png') }}" 
                         data-fallback="https://ui-avatars.com/api/?name=Npontu&background=7c3aed&color=fff&size=128" 
                         alt="Npontu Logo" 
                         class="brand-logo"
                         onerror="this.onerror=null; this.src=this.dataset.fallback;">
                </div>

                <span class="welcome-pill">Account Recovery</span>
                <h2 class="form-header-title">Reset your password</h2>

                <!-- LARAVEL SESSION STATUS ALERT -->
                @if (session('status'))
                    <div class="status-alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- EMAIL ADDRESS -->
                    <div class="field" data-label="Email Address" data-type="email">
                        <div class="box">
                            <input type="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   autocomplete="off" 
                                   required 
                                   autofocus />
                            <span class="label"></span>
                            <span class="underline"></span>
                            <button type="button" class="clear" aria-label="Clear"><svg viewBox="0 0 24 24"><path d="M5 5l14 14M19 5L5 19"/></svg></button>
                        </div>
                        <div class="helper">
                            <span class="msg">name@example.com</span>
                            @error('email')
                                <span style="color: var(--bad);">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON WITH OCEAN CANVAS EFFECT -->
                    <button type="submit" class="ocean-btn ocean-btn-indigo">
                        Email Password Reset Link
                    </button>

                    <!-- FOOTER LINK -->
                    <div class="form-actions">
                        <a href="{{ route('login') }}" class="form-link">Remembered your password? Log in</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- ================= FULL INTERACTIVE JAVASCRIPT ================= -->
    <script>
        // TEXT ANIMATION TYPING
        const cursor_wlc = document.querySelector('.cursor');
        const text_wlc = "Forgot your password? No problem. Just enter your account email address and we will email you a password reset link to restore your access.";
        let i_wlc = 0;
        const el_wlc = document.getElementById('typing');

        function type_welc() {
            if (i_wlc < text_wlc.length) {
                el_wlc.innerHTML = text_wlc.slice(0, i_wlc);
                i_wlc++;
                setTimeout(type_welc, 15);
            } else {
                cursor_wlc.style.display = 'none';
            }
        }

        setTimeout(type_welc, 1000);

        // OCEAN BUTTON ENGINE
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

            return { filterId, dispId };
        }

        function initOceanButtons() {
            const buttons = document.querySelectorAll('.ocean-btn:not([data-ocean-ready])');

            buttons.forEach((btn) => {
                btn.setAttribute('data-ocean-ready', 'true');
                const uniqueId = ++filterCounter;

                const { filterId, dispId } = createButtonFilter(uniqueId);

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
                let W = 0, H = 0;

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
                    const style = getComputedStyle(btn);
                    
                    const waveTopHover = style.getPropertyValue('--wave-top-hover').trim() || '#6366f1';
                    const waveMidHover = style.getPropertyValue('--wave-mid-hover').trim() || '#4f46e5';
                    const waveBotHover = style.getPropertyValue('--wave-bot-hover').trim() || '#1e1b4b';
                    const waveTopIdle = style.getPropertyValue('--wave-top-idle').trim() || 'rgba(79,70,229,0.55)';
                    const waveMidIdle = style.getPropertyValue('--wave-mid-idle').trim() || 'rgba(49,46,129,0.5)';
                    const waveBotIdle = style.getPropertyValue('--wave-bot-idle').trim() || 'rgba(15,23,42,0.45)';

                    const strokeHover = style.getPropertyValue('--crest-stroke-hover').trim() || '#e0e7ff';
                    const strokeIdle = style.getPropertyValue('--crest-stroke-idle').trim() || 'rgba(199,210,254,0.6)';
                    const shadowHover = style.getPropertyValue('--crest-shadow-hover').trim() || '#818cf8';
                    const shadowIdle = style.getPropertyValue('--crest-shadow-idle').trim() || '#6366f1';

                    // Draw Wave
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

                    // Crest Stroke
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

                    // Plankton Sparkles
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

        document.addEventListener('DOMContentLoaded', () => {
            initOceanButtons();

            const fields = [...document.querySelectorAll('.field')];
            let groupDelay = 0;

            fields.forEach((field) => {
                const labelText = field.dataset.label;
                const labelEl = field.querySelector('.label');
                const input = field.querySelector('input');
                const clearBtn = field.querySelector('.clear');

                [...labelText].forEach((ch, i) => {
                    const span = document.createElement('span');
                    span.className = 'ch';
                    if (ch === ' ') span.innerHTML = '&nbsp;';
                    else span.textContent = ch;
                    span.style.setProperty('--i', i);
                    span.style.setProperty('--group-delay', groupDelay + 's');
                    labelEl.appendChild(span);
                });
                groupDelay += 0.05;

                function validate() {
                    const val = input.value;
                    const filled = val.trim().length > 0;
                    field.classList.toggle('filled', filled);

                    let invalid = false;
                    const msg = field.querySelector('.helper .msg');

                    if (field.dataset.type === 'email' && filled) {
                        invalid = !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
                        if (msg) msg.textContent = filled ? (invalid ? 'Enter a valid email' : 'Valid email format') : 'name@example.com';
                    }

                    field.classList.toggle('invalid', invalid);
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

                validate();
            });

            // RIPPLE EFFECT
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
