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

export function initOceanButtons() {
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
