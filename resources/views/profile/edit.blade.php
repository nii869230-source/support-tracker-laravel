<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}?v=2" type="image/png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Quicksand:wght@500;600;700&display=swap');

        :root {
            --bg:        #0e0f13;
            --card:      #16181f;
            --border:    #2a2d38;
            --border-on: #f2f4f8;
            --text:      #f2f4f8;
            --text-dim:  #6b7080;
            --accent-1:  #fb7185;
            --accent-2:  #fbbf24; /* Yellow accent from design */
            --accent-3:  #34d399;
            --accent-4:  #60a5fa;
            --bad:       #fb7185;
            --mid:       #fbbf24;
            --good:      #34d399;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            background: var(--bg);
            font-family: 'Quicksand', sans-serif;
            padding: 40px 24px 60px;
            color: var(--text);
        }

        .profile-container {
            width: min(100%, 760px);
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        /* BACK LINK */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--text-dim);
            text-decoration: none;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 16px;
            transition: color 0.2s ease;
        }
        .back-link:hover { color: var(--text); }

        /* ==================== HERO PROFILE CARD ==================== */
        .hero-card {
            position: relative;
            border-radius: 28px;
            background: var(--card);
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(0,0,0,0.5);
        }

        /* 1. BIG COVER PICTURE */
        .cover-wrapper {
            position: relative;
            height: 240px;
            width: 100%;
            background: linear-gradient(135deg, #1e1b4b, #312e81, #4338ca);
            overflow: hidden;
        }
        .cover-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .cover-edit-btn {
            position: absolute;
            top: 18px;
            right: 18px;
            background: rgba(14, 15, 19, 0.65);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #fff;
            padding: 10px 16px;
            border-radius: 12px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }
        .cover-edit-btn:hover {
            background: rgba(14, 15, 19, 0.9);
            transform: translateY(-2px);
        }

        /* 2. SMALL CIRCLE AVATAR PICTURE */
        .hero-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: -65px;
            padding: 0 36px 36px;
            text-align: center;
            position: relative;
        }

        .avatar-container {
            position: relative;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 5px solid var(--card);
            background: #101218;
            box-shadow: 0 10px 30px rgba(0,0,0,0.6);
            margin-bottom: 16px;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Yellow Plus Icon Button */
        .avatar-upload-btn {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--accent-2);
            color: #0e0f13;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
            border: 3px solid var(--card);
            transition: transform 0.25s cubic-bezier(.34,1.56,.64,1), background 0.2s ease;
        }
        .avatar-upload-btn:hover {
            transform: scale(1.12);
            background: #fcd34d;
        }

        .user-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 6px;
        }
        .user-email-text {
            color: var(--text-dim);
            font-size: 16px;
            margin: 0;
        }

        /* Hidden file inputs */
        input[type="file"] { display: none; }

        /* ==================== ANIMATED TABS ==================== */
        .tabs-nav {
            display: flex;
            background: #101218;
            padding: 8px;
            border-radius: 18px;
            border: 1px solid var(--border);
            gap: 8px;
            position: relative;
        }

        .tab-btn {
            flex: 1;
            padding: 16px;
            border: none;
            background: transparent;
            color: var(--text-dim);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: color 0.3s ease, background 0.3s ease, transform 0.2s ease;
            text-align: center;
        }

        .tab-btn:hover {
            color: var(--text);
            background: rgba(255, 255, 255, 0.03);
        }

        .tab-btn.active {
            color: var(--text);
            background: var(--card);
            box-shadow: 0 6px 20px rgba(0,0,0,0.35);
            border: 1px solid var(--border);
        }

        /* TAB PANELS WITH ANIMATION */
        .tab-content {
            position: relative;
        }

        .tab-panel {
            display: none;
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.35s ease, transform 0.35s ease;
        }

        .tab-panel.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        /* CARD FOR TAB CONTENT */
        .tab-card {
            padding: 44px 40px;
            border-radius: 24px;
            background: var(--card);
            border: 1px solid var(--border);
            box-shadow: 0 16px 40px rgba(0,0,0,0.45);
        }

        .tab-card h2 {
            margin: 0 0 10px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 28px;
            font-weight: 600;
        }

        .tab-card > p {
            margin: 0 0 32px;
            color: var(--text-dim);
            font-size: 16px;
            line-height: 1.5;
        }

        form { display: flex; flex-direction: column; gap: 28px; }

        /* ============ FIELD (PRESERVED INPUT STYLING) ============ */
        .field { position: relative; }

        .label {
            position: absolute;
            left: 22px;
            top: 24px;
            display: inline-flex;
            pointer-events: none;
            transform-origin: left top;
            transition: transform .32s cubic-bezier(.34,1.56,.64,1), top .32s ease;
        }
        .label .ch {
            display: inline-block;
            color: var(--text-dim);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 20px;
            opacity: 0;
            translate: 0 10px;
            animation: chIn .5s cubic-bezier(.34,1.56,.64,1) forwards;
            animation-delay: calc(var(--i) * 0.045s + var(--group-delay, 0s));
        }
        @keyframes chIn { to { opacity: 1; translate: 0 0; } }

        .field.active .label,
        .field.filled .label {
            top: 14px;
            transform: scale(.72);
        }
        .field.active .label .ch,
        .field.filled .label .ch { color: var(--accent-4); }
        .field.invalid.filled .label .ch { color: var(--bad); }

        .box {
            position: relative;
            height: 70px;
            border-radius: 16px;
            border: 1.5px solid var(--border);
            background: #101218;
            overflow: hidden;
            transition: height .4s cubic-bezier(.65,0,.35,1), border-color .3s ease;
        }
        .field.active .box {
            height: 96px;
            border-color: var(--border-on);
        }
        .field.invalid.filled .box { border-color: var(--bad); }

        input {
            all: unset;
            position: absolute;
            left: 22px;
            right: 58px;
            bottom: 14px;
            color: var(--text);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 22px;
            transition: bottom .3s ease;
        }
        .field.active input,
        .field.filled input { bottom: 16px; }
        .field.has-toggle input { right: 98px; }

        .underline {
            position: absolute;
            left: 0; bottom: 0;
            height: 4px;
            width: 100%;
            background: linear-gradient(90deg, var(--accent-1), var(--accent-2), var(--accent-3), var(--accent-4));
            background-size: 300% 100%;
            background-position: 0% 0%;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .45s cubic-bezier(.65,0,.35,1), background-position .6s ease;
        }
        .field.active .underline { transform: scaleX(1); }
        .field.invalid.filled .underline { background: var(--bad); transform: scaleX(1); }

        /* STATUS ICON */
        .icon {
            position: absolute;
            right: 18px;
            top: 50%;
            translate: 0 -50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            rotate: -35deg;
            scale: 0;
            transition: scale .4s cubic-bezier(.34,1.56,.64,1), rotate .3s ease;
        }
        .field.active .icon { scale: 1; rotate: 0deg; }
        .icon svg { width: 100%; height: 100%; }
        .icon path, .icon circle { fill: none; stroke: var(--text-dim); stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; transition: stroke .3s ease; }
        .field.active .icon path,
        .field.active .icon circle { stroke: var(--accent-4); }

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
            transition: scale .3s cubic-bezier(.34,1.56,.64,1), opacity .2s ease, background .2s ease;
        }
        .field.filled .clear { scale: 1; opacity: 1; }
        .field.filled .icon { scale: 0; }
        .field.has-toggle.filled .clear { right: 58px; }
        .clear:hover { background: #232633; }
        .clear svg { width: 15px; height: 15px; }
        .clear path { stroke: var(--text-dim); stroke-width: 2; stroke-linecap: round; }
        .clear:hover path { stroke: var(--text); }

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
        .toggle:hover { background: #232633; }
        .toggle svg { width: 22px; height: 22px; }
        .toggle path, .toggle circle, .toggle line {
            fill: none; stroke: var(--text-dim); stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
            transition: stroke .3s ease;
        }
        .field.active .toggle path,
        .field.active .toggle circle { stroke: var(--accent-4); }
        .toggle .slash {
            stroke-dasharray: 26;
            stroke-dashoffset: 26;
            transition: stroke-dashoffset .3s ease;
        }
        .toggle.revealed .slash { stroke-dashoffset: 0; }

        /* STRENGTH METER */
        .strength {
            position: absolute;
            left: 0; bottom: -1px;
            height: 4px;
            display: flex;
            gap: 4px;
            width: 100%;
            opacity: 0;
            transition: opacity .25s ease;
        }
        .field.filled .strength { opacity: 1; }
        .strength i {
            flex: 1;
            background: var(--border);
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .35s cubic-bezier(.65,0,.35,1), background .3s ease .05s;
        }
        .strength.on-1 i:nth-child(1){ transform: scaleX(1); background: var(--bad); }
        .strength.on-2 i:nth-child(1),
        .strength.on-2 i:nth-child(2){ transform: scaleX(1); background: var(--mid); }
        .strength.on-3 i:nth-child(1),
        .strength.on-3 i:nth-child(2),
        .strength.on-3 i:nth-child(3){ transform: scaleX(1); background: var(--good); }

        /* HELPER ROW */
        .helper {
            margin-top: 10px;
            min-height: 20px;
            font-size: 15px;
            color: var(--text-dim);
            display: flex;
            justify-content: space-between;
        }
        .field.invalid.filled ~ .helper .msg { color: var(--bad); }
        .field.filled:not(.invalid) ~ .helper .msg { color: var(--accent-3); }

        /* SUBMIT BUTTON */
        /* OCEAN BUTTON BASE */
.submit {
    all: unset;
    margin-top: 14px;
    height: 60px;
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
    transition: transform .2s cubic-bezier(.34,1.56,.64,1), box-shadow .3s ease, background .3s ease;
}

.submit:active { 
    transform: scale(.98); 
}


/* ================= OCEAN EMERALD BUTTON ================= */



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
  transition: transform .4s cubic-bezier(.34,1.56,.64,1),
              border-color .4s ease,
              box-shadow .4s ease;
  box-shadow: 0 0 0 0 rgba(0,0,0,0), inset 0 0 20px rgba(0,0,0,.4);
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
    inset 0 0 20px rgba(0,0,0,.3);
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




    </style>
</head>
<body>

<div class="profile-container">

    <!-- BACK TO DASHBOARD -->
    <a href="{{ route('dashboard') }}" class="back-link">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Back to Dashboard
    </a>

    <!-- ==================== HERO PROFILE CARD ==================== -->
    <div class="hero-card">
        <!-- Big Cover Photo -->
        <div class="cover-wrapper">
        <img id="coverPreview" 
     src="{{ auth()->user()->cover_photo ? asset('storage/' . auth()->user()->cover_photo) : asset('images/cover-bg.jpg') }}" 
     alt="Cover Banner" 
     class="cover-photo">
            <label for="coverInput" class="cover-edit-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                Change Cover
            </label>
            <!-- Hidden Cover File Input -->
            <input type="file" id="coverInput" accept="image/*" form="profileForm" name="cover_photo">
        </div>

        <!-- Small Circular Avatar Photo -->
        <div class="hero-body">
            <div class="avatar-container">
            <img id="avatarPreview" 
     src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : asset('images/default-avatar.jpg') }}" 
     data-fallback="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=312e81&color=fff"
     alt="User Avatar" 
     class="avatar-img"
     onerror="this.onerror=null; this.src=this.dataset.fallback;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </label>
                <!-- Hidden Avatar File Input -->
                <input type="file" id="avatarInput" accept="image/*" form="profileForm" name="avatar">
            </div>

            <h1 class="user-title">{{ auth()->user()->name ?? 'User Name' }}</h1>
            <p class="user-email-text">{{ auth()->user()->email ?? 'user@example.com' }}</p>
        </div>
    </div>

    <!-- ==================== ANIMATED TAB BUTTONS ==================== -->
    <div class="tabs-nav">
        <button type="button" class="tab-btn active" data-tab="profile-tab">Profile Details</button>
        <button type="button" class="tab-btn" data-tab="password-tab">Update Password</button>
        <button type="button" class="tab-btn" data-tab="delete-tab">Delete Account</button>
    </div>

    <!-- ==================== TAB PANELS CONTAINER ==================== -->
    <div class="tab-content">

        <!-- TAB 1: PROFILE DETAILS (DEFAULT) -->
        <div class="tab-panel active" id="profile-tab">
            <div class="tab-card">
                <h2>Profile Details</h2>
                <p>Update your account's profile information and primary email address.</p>

                <form id="profileForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- FULL NAME -->
                    <div class="field" data-label="Full Name" data-type="text">
                        <div class="box">
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" autocomplete="off" spellcheck="false" maxlength="40" required />
                            <span class="label"></span>
                            <span class="underline"></span>
                            <span class="icon">
                                <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </span>
                            <button type="button" class="clear" aria-label="Clear"><svg viewBox="0 0 24 24"><path d="M5 5l14 14M19 5L5 19"/></svg></button>
                        </div>
                        <div class="helper"><span class="msg">Enter your full name</span></div>
                    </div>

                    <!-- EMAIL ADDRESS -->
                    <div class="field" data-label="Email Address" data-type="email">
                        <div class="box">
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" autocomplete="off" spellcheck="false" maxlength="60" required />
                            <span class="label"></span>
                            <span class="underline"></span>
                            <span class="icon">
                                <svg viewBox="0 0 24 24"><path d="M3 6h18v12H3z"/><path d="M3 7l9 6 9-6"/></svg>
                            </span>
                            <button type="button" class="clear" aria-label="Clear"><svg viewBox="0 0 24 24"><path d="M5 5l14 14M19 5L5 19"/></svg></button>
                        </div>
                        <div class="helper"><span class="msg">name@example.com</span></div>
                    </div>

                    <button type="submit" class="submit ocean-btn ocean-btn-emerald">Save Changes</button>
                </form>
            </div>
        </div>

        <!-- TAB 2: UPDATE PASSWORD -->
        <div class="tab-panel" id="password-tab">
            <div class="tab-card">
                <h2>Update Password</h2>
                <p>Ensure your account is using a long, random password to stay secure.</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- CURRENT PASSWORD -->
                    <div class="field has-toggle" data-label="Current Password" data-type="password-simple">
                        <div class="box">
                            <input type="password" name="current_password" autocomplete="off" maxlength="64" required />
                            <span class="label"></span>
                            <span class="underline"></span>
                            <button type="button" class="clear"><svg viewBox="0 0 24 24"><path d="M5 5l14 14M19 5L5 19"/></svg></button>
                            <button type="button" class="toggle">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/><line class="slash" x1="3" y1="3" x2="21" y2="21"/></svg>
                            </button>
                        </div>
                        <div class="helper"><span class="msg">Enter current password</span></div>
                    </div>

                    <!-- NEW PASSWORD -->
                    <div class="field has-toggle" data-label="New Password" data-type="password">
                        <div class="box">
                            <input type="password" name="password" autocomplete="off" maxlength="64" required />
                            <span class="label"></span>
                            <span class="underline"></span>
                            <span class="strength"><i></i><i></i><i></i></span>
                            <button type="button" class="clear"><svg viewBox="0 0 24 24"><path d="M5 5l14 14M19 5L5 19"/></svg></button>
                            <button type="button" class="toggle">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/><line class="slash" x1="3" y1="3" x2="21" y2="21"/></svg>
                            </button>
                        </div>
                        <div class="helper"><span class="msg">Must be 8+ characters</span></div>
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="field has-toggle" data-label="Confirm Password" data-type="password-simple">
                        <div class="box">
                            <input type="password" name="password_confirmation" autocomplete="off" maxlength="64" required />
                            <span class="label"></span>
                            <span class="underline"></span>
                            <button type="button" class="clear"><svg viewBox="0 0 24 24"><path d="M5 5l14 14M19 5L5 19"/></svg></button>
                            <button type="button" class="toggle">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/><line class="slash" x1="3" y1="3" x2="21" y2="21"/></svg>
                            </button>
                        </div>
                        <div class="helper"><span class="msg">Re-enter new password</span></div>
                    </div>

                    <button type="submit" class="submit ocean-btn ocean-btn-emerald">Update Password</button>
                </form>
            </div>
        </div>

        <!-- TAB 3: DELETE ACCOUNT -->
        <div class="tab-panel" id="delete-tab">
            <div class="tab-card" style="border-color: rgba(251, 113, 133, 0.35);">
                <h2 style="color: var(--bad);">Delete Account</h2>
                <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>

                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <!-- CONFIRM PASSWORD TO DELETE -->
                    <div class="field has-toggle" data-label="Confirm Password" data-type="password-simple">
                        <div class="box">
                            <input type="password" name="password" autocomplete="off" maxlength="64" required />
                            <span class="label"></span>
                            <span class="underline"></span>
                            <button type="button" class="clear"><svg viewBox="0 0 24 24"><path d="M5 5l14 14M19 5L5 19"/></svg></button>
                            <button type="button" class="toggle">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/><line class="slash" x1="3" y1="3" x2="21" y2="21"/></svg>
                            </button>
                        </div>
                        <div class="helper"><span class="msg">Enter password to confirm deletion</span></div>
                    </div>

                    <button type="submit" class="submit ocean-btn ocean-btn-amber" style="background: var(--bad); color: #fff;" onclick="return confirm('Are you sure you want to permanently delete your account?')">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>

<script defer>

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

    // 1. Generate unique liquid filter
    const { filterId, dispId } = createButtonFilter(uniqueId);

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
      amplitude  += (targetAmp - amplitude) * 0.07;
      turbScale  += (targetTurb - turbScale) * 0.12;

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
      const waveTopIdle  = style.getPropertyValue('--wave-top-idle').trim()  || 'rgba(14,148,136,0.55)';
      const waveMidIdle  = style.getPropertyValue('--wave-mid-idle').trim()  || 'rgba(9,80,95,0.5)';
      const waveBotIdle  = style.getPropertyValue('--wave-bot-idle').trim()  || 'rgba(4,30,40,0.45)';

      const strokeHover  = style.getPropertyValue('--crest-stroke-hover').trim() || 'rgba(232,255,251,0.9)';
      const strokeIdle   = style.getPropertyValue('--crest-stroke-idle').trim()  || 'rgba(127,216,224,0.45)';
      const shadowHover  = style.getPropertyValue('--crest-shadow-hover').trim() || '#7c6ce8';
      const shadowIdle   = style.getPropertyValue('--crest-shadow-idle').trim()  || '#22d3ee';

      // 1. Draw sine wave water body
      ctx.beginPath();
      ctx.moveTo(0, H + 4);
      const step = 4;
      for (let x = 0; x <= W; x += step) {
        const y = surfaceY
          + amplitude * Math.sin(x * 0.045 + t * 1.6)
          + amplitude * 0.6 * Math.sin(x * 0.09 - t * 2.3 + 1.4)
          + amplitude * 0.35 * Math.sin(x * 0.16 + t * 3.1 + 2.6);
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
        const y = surfaceY
          + amplitude * Math.sin(x * 0.045 + t * 1.6)
          + amplitude * 0.6 * Math.sin(x * 0.09 - t * 2.3 + 1.4)
          + amplitude * 0.35 * Math.sin(x * 0.16 + t * 3.1 + 2.6);
        if (x === 0) ctx.moveTo(x, y); else ctx.lineTo(x, y);
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

        
        
        // ================= TAB SWITCHING LOGIC =================
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabPanels = document.querySelectorAll('.tab-panel');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetTabId = btn.dataset.tab;

                tabBtns.forEach(b => b.classList.remove('active'));
                tabPanels.forEach(p => p.classList.remove('active'));

                btn.classList.add('active');
                const targetPanel = document.getElementById(targetTabId);
                targetPanel.classList.add('active');
            });
        });

        // ================= IMAGE INSTANT PREVIEWS =================
        function setupPreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            if (!input || !preview) return;

            input.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    preview.style.display = 'block';
                    preview.src = URL.createObjectURL(file);
                }
            });
        }
        setupPreview('avatarInput', 'avatarPreview');
        setupPreview('coverInput', 'coverPreview');

        // ================= INPUT FIELD ANIMATIONS & LOGIC =================
        const fields = [...document.querySelectorAll('.field')];
        let groupDelay = 0;

        fields.forEach((field) => {
            const labelText = field.dataset.label;
            const labelEl = field.querySelector('.label');
            const input = field.querySelector('input');
            const clearBtn = field.querySelector('.clear');
            const toggleBtn = field.querySelector('.toggle');

            // Animated character letters
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
                    invalid = val.length < 8;
                }
                field.classList.toggle('invalid', invalid);

                const msg = field.querySelector('.helper .msg');
                if (msg) {
                    if (field.dataset.type === 'email') {
                        msg.textContent = filled ? (invalid ? 'Enter a valid email' : 'Valid email address') : 'name@example.com';
                    } else if (field.dataset.type === 'password') {
                        msg.textContent = filled ? (invalid ? 'Needs 8+ characters' : 'Strong password!') : 'Must be 8+ characters';
                        updateStrength(val, field);
                    } else if (field.dataset.type === 'text') {
                        msg.textContent = filled ? 'Looks good!' : 'Required field';
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

        function updateStrength(val, field) {
            const bar = field.querySelector('.strength');
            if (!bar) return;
            bar.classList.remove('on-1', 'on-2', 'on-3');
            if (!val) return;

            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val) && /[0-9]/.test(val)) score++;
            if (val.length >= 12 && /[^A-Za-z0-9]/.test(val)) score++;

            if (score >= 1) bar.classList.add(score === 1 ? 'on-1' : score === 2 ? 'on-2' : 'on-3');
        }
    });
</script>

</body>
</html>