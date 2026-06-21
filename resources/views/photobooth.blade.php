<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Studio Booth — Photobooth Estetik</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,300;1,400;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#0B0914;
  --s1:#130F28;
  --s2:#1B1738;
  --s3:#231E48;
  --gold:#C8963E;
  --gold-lt:#E4B870;
  --gold-dim:rgba(200,150,62,.22);
  --rose:#C98B7C;
  --cream:#F0E5D3;
  --text:#EDE5D5;
  --muted:#9080AC;
  --border:rgba(200,150,62,.2);
  --border2:rgba(200,200,255,.08);
  --r:12px;
  --rl:20px;
}
body{background:var(--bg);color:var(--text);font-family:'Plus Jakarta Sans',system-ui,sans-serif;min-height:100vh;overflow-x:hidden}
button,input{font-family:inherit}

/* grain overlay */
body::after{content:'';position:fixed;inset:0;pointer-events:none;z-index:999;opacity:.025;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E")}

/* page system */
.page{display:none;min-height:100vh;flex-direction:column}
.page.active{display:flex}

/* nav */
.nav{height:66px;display:flex;align-items:center;justify-content:space-between;padding:0 32px;border-bottom:1px solid var(--border);background:rgba(11,9,20,.88);backdrop-filter:blur(14px);position:sticky;top:0;z-index:50}
.logo{font-family:'Cormorant Garamond',Georgia,serif;font-size:26px;font-style:italic;color:var(--cream);letter-spacing:-.5px;user-select:none}
.logo em{color:var(--gold);font-style:italic}
.nav-links{display:flex;gap:28px}
.nav-links a{color:var(--muted);text-decoration:none;font-size:13px;font-weight:500;transition:color .2s}
.nav-links a:hover{color:var(--text)}

/* content */
.wrap{flex:1;padding:32px;max-width:1200px;width:100%;margin:0 auto}

/* buttons */
.btn{display:inline-flex;align-items:center;gap:8px;border:none;border-radius:var(--r);padding:13px 26px;font-size:13px;font-weight:600;cursor:pointer;transition:all .2s;letter-spacing:.02em;white-space:nowrap}
.btn-primary{background:var(--gold);color:#0B0914}
.btn-primary:hover{background:var(--gold-lt);transform:translateY(-2px);box-shadow:0 8px 24px rgba(200,150,62,.3)}
.btn-outline{background:transparent;color:var(--text);border:1px solid var(--border)}
.btn-outline:hover{border-color:var(--gold);color:var(--gold)}
.btn-ghost{background:var(--s2);color:var(--text);border:1px solid var(--border2)}
.btn-ghost:hover{background:var(--s3)}
.btn-danger{background:#8C3A3A;color:#fff}
.btn-danger:hover{background:#A44545;transform:translateY(-2px)}
.btn-lg{padding:15px 34px;font-size:15px}
.btn-full{width:100%;justify-content:center}

/* shutter button */
.shutter{width:68px;height:68px;border-radius:50%;padding:0;border:6px solid rgba(255,255,255,.35);background:white;cursor:pointer;position:relative;transition:all .2s;display:grid;place-items:center}
.shutter::after{content:'';width:28px;height:28px;border-radius:50%;background:var(--gold);display:block}
.shutter:hover{transform:scale(1.06);box-shadow:0 0 0 8px rgba(200,150,62,.18)}

/* icon button */
.iconbtn{width:38px;height:38px;border-radius:50%;padding:0;display:grid;place-items:center;background:var(--s2);border:1px solid var(--border);font-size:14px;color:var(--muted);cursor:pointer;transition:background .2s,opacity .2s,color .2s;opacity:.6}
.iconbtn:hover{background:var(--s3);opacity:1;color:var(--text)}

/* back button */
.back{display:inline-flex;align-items:center;gap:5px;background:none;border:none;color:var(--muted);font-size:12px;font-weight:500;cursor:pointer;padding:6px 0;transition:color .2s}
.back:hover{color:var(--text)}

/* stepper */
.stepper{display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:30px}
.step{display:flex;align-items:center;gap:7px;font-size:12px;color:var(--muted);font-weight:500}
.step.active{color:var(--gold)}
.step.done{color:var(--muted);opacity:.7}
.sdot{width:7px;height:7px;border-radius:50%;background:var(--s3)}
.step.active .sdot{background:var(--gold);box-shadow:0 0 8px rgba(200,150,62,.5)}
.step.done .sdot{background:var(--gold-lt);opacity:.6}
.sline{width:52px;height:1px;background:var(--border)}

/* section titles */
.stitle{font-family:'Cormorant Garamond',Georgia,serif;font-style:italic;font-size:22px;color:var(--cream);margin-bottom:6px}
.sdesc{font-size:13px;color:var(--muted);line-height:1.6}

/* divider */
.divider{height:1px;background:var(--border)}

/* form */
.flabel{font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:7px;display:block}
.finput{background:var(--bg);border:1px solid var(--border);border-radius:var(--r);padding:11px 14px;font-size:14px;color:var(--text);outline:none;transition:border-color .2s;width:100%}
.finput:focus{border-color:var(--gold)}

/* color dots */
.cdots{display:flex;gap:9px;flex-wrap:wrap}
.cdot{width:26px;height:26px;border-radius:50%;border:2px solid transparent;cursor:pointer;transition:all .2s}
.cdot.active{border-color:white;box-shadow:0 0 0 2px var(--gold);transform:scale(1.12)}

/* canvas card */
.ccard{background:var(--s1);border:1px solid var(--border);border-radius:var(--rl);padding:22px;text-align:center}
.ccard-label{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:16px;color:var(--cream);margin-bottom:14px}
canvas{width:100%;max-width:310px;border-radius:8px;box-shadow:0 16px 48px rgba(0,0,0,.7)}

/* side card */
.scard{background:var(--s1);border:1px solid var(--border);border-radius:var(--rl);padding:24px}

/* template mini */
.tmini{width:100%;aspect-ratio:3/4;border-radius:9px;position:relative;overflow:hidden;display:flex;align-items:flex-end;justify-content:center}
.tmini-frame{position:absolute;inset:7px;border-radius:5px;border:1.5px solid rgba(255,255,255,.2)}
.tmini-label{position:absolute;bottom:7px;font-family:'Cormorant Garamond',serif;font-style:italic;font-size:9px;opacity:.7;color:white}
.topt{border:2px solid transparent;background:transparent;padding:0;cursor:pointer;border-radius:var(--r);width:100%;transition:all .2s}
.topt.active{border-color:var(--gold)}
.topt:hover:not(.active){border-color:rgba(200,150,62,.4);transform:translateY(-2px)}
.tname{display:block;font-size:11px;color:var(--muted);text-align:center;margin-top:5px}
.topt.active .tname{color:var(--gold)}
.tgrid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
.twrap{position:relative}
.tdel{position:absolute;top:4px;right:4px;width:18px;height:18px;border:none;border-radius:50%;background:rgba(100,30,30,.9);color:white;cursor:pointer;display:grid;place-items:center;font-size:10px;z-index:2;transition:background .2s}
.tdel:hover{background:rgba(146,45,45,.9)}

/* template note */
.tnote{font-size:12px;color:var(--muted);line-height:1.6;padding:11px 14px;background:var(--s2);border-radius:var(--r);border:1px solid var(--border2)}

.tips{display:flex;flex-direction:column;gap:12px}
.tip{display:flex;gap:11px;align-items:flex-start}
.tipn{width:28px;height:28px;border-radius:8px;background:var(--gold-dim);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.tipn svg{width:14px;height:14px;stroke:var(--gold);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.tipt{font-size:12px;color:var(--muted);line-height:1.5}
.tipt strong{color:var(--text);font-weight:600;display:block;margin-bottom:2px}

/* camera */
.camwrap{background:var(--s1);border:1px solid var(--border);border-radius:var(--rl);overflow:hidden}
.vwrap{position:relative;background:#000;min-height:460px}
video{width:100%;height:460px;object-fit:cover;display:block;transform:scaleX(-1)}
.fcorner{position:absolute;width:24px;height:24px;border-color:var(--gold);border-style:solid;border-width:0;opacity:.75}
.fcorner.tl{top:14px;left:14px;border-top-width:2px;border-left-width:2px}
.fcorner.tr{top:14px;right:14px;border-top-width:2px;border-right-width:2px}
.fcorner.bl{bottom:14px;left:14px;border-bottom-width:2px;border-left-width:2px}
.fcorner.br{bottom:14px;right:14px;border-bottom-width:2px;border-right-width:2px}
.flash{position:absolute;inset:0;background:#fff;opacity:0;pointer-events:none;z-index:20;transition:opacity .25s ease-out}
.liveDot{width:6px;height:6px;border-radius:50%;background:#4ade80;animation:pls 2s ease-in-out infinite}
@keyframes pls{0%,100%{opacity:1}50%{opacity:.2}}
.cdlayer{position:absolute;inset:0;display:none;align-items:center;justify-content:center;background:rgba(0,0,0,.62);backdrop-filter:blur(4px)}
.cdnum{font-family:'Plus Jakarta Sans',system-ui,sans-serif;font-size:120px;font-weight:700;color:white;text-shadow:0 4px 20px rgba(200,150,62,.5);line-height:1}
.camctrl{display:flex;align-items:center;justify-content:center;gap:40px;padding:16px 20px;border-top:1px solid var(--border);background:var(--s1)}
.camhint{font-size:11px;color:var(--muted);text-align:center;padding:0 20px 12px}

/* hero */
.hero{min-height:calc(100vh - 66px);display:grid;grid-template-columns:1fr 480px;gap:40px;align-items:center}
.htitle{font-family:'Cormorant Garamond',Georgia,serif;font-size:clamp(50px,6vw,86px);font-style:italic;font-weight:600;line-height:.96;letter-spacing:-2px;color:var(--cream);margin-bottom:22px}
.htitle span{color:var(--gold)}
.htitle .eyebrow{display:block;font-size:.38em;font-style:normal;font-weight:400;letter-spacing:.12em;color:var(--muted);text-transform:uppercase;margin-bottom:14px}
.hdesc{color:var(--muted);font-size:14px;line-height:1.85;margin-bottom:34px;max-width:400px}
.hfeats{display:flex;gap:20px;flex-wrap:wrap;margin-bottom:38px}
.hfeat{display:flex;align-items:center;gap:8px;font-size:12px;color:var(--text);opacity:.7}
.fdot{width:5px;height:5px;border-radius:50%;background:var(--gold)}

/* film strip */
.filmvis{position:relative;display:flex;justify-content:center;align-items:center;padding:30px 0}
.filmstrip{display:flex;position:relative}
.frail{width:20px;background:var(--s2);background-image:radial-gradient(circle,var(--bg) 4px,transparent 4px);background-size:20px 20px;background-repeat:repeat-y;background-position:center 6px}
.fframes{display:flex;flex-direction:column;gap:3px;background:var(--s2)}
.fframe{width:200px;height:155px;background:var(--s3);position:relative;overflow:hidden}
.fframe::after{content:'';position:absolute;inset:0;background:linear-gradient(135deg,transparent 50%,rgba(200,150,62,.07) 100%)}
.fframe-inner{position:absolute;inset:0;display:flex;align-items:center;justify-content:center}
.fframe-inner span{font-family:'Cormorant Garamond',serif;font-style:italic;color:var(--muted);font-size:12px}
.fdeco{position:absolute;font-size:22px;opacity:.35}
.fd1{top:20px;right:20px;color:var(--gold);animation:f1 4s ease-in-out infinite}
.fd2{bottom:70px;left:15px;color:var(--rose);animation:f2 5s ease-in-out infinite}
.fd3{top:42%;left:8px;color:var(--gold-lt);animation:f1 6s ease-in-out infinite reverse}
@keyframes f1{0%,100%{transform:translateY(0) rotate(0deg)}50%{transform:translateY(-10px) rotate(12deg)}}
@keyframes f2{0%,100%{transform:translateY(0) rotate(0deg)}50%{transform:translateY(9px) rotate(-10deg)}}

/* grids */
.cgrid{display:grid;grid-template-columns:1.65fr .75fr;gap:22px;align-items:start}
.tgridlay{display:grid;grid-template-columns:370px 1fr;gap:26px;align-items:start}
.egridlay{display:grid;grid-template-columns:370px 1fr;gap:26px;align-items:start}
.editpanel{background:var(--s1);border:1px solid var(--border);border-radius:var(--rl);padding:26px;display:flex;flex-direction:column;gap:18px;position:sticky;top:90px}

/* flow bar */
#flowbar{display:none!important}
.cambadge{display:none}
.shotbadge{position:absolute;top:14px;left:50%;transform:translateX(-50%);background:rgba(11,9,20,.75);border:1px solid var(--border);backdrop-filter:blur(8px);border-radius:999px;padding:5px 13px;font-size:11px;color:var(--text);display:flex;align-items:center;gap:6px;z-index:5}
.hidden{display:none!important}

/* custom modal (replaces alert/confirm/prompt) */
.modal-overlay{position:fixed;inset:0;background:rgba(5,4,10,.72);backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;z-index:300;padding:20px}
.modal-overlay.hidden{display:none!important}
.modal-box{background:var(--s1);border:1px solid var(--border);border-radius:var(--rl);padding:26px;max-width:360px;width:100%;box-shadow:0 24px 64px rgba(0,0,0,.6);animation:modalIn .18s ease-out}
@keyframes modalIn{from{opacity:0;transform:translateY(6px) scale(.98)}to{opacity:1;transform:translateY(0) scale(1)}}
.modal-icon{width:38px;height:38px;border-radius:11px;background:var(--gold-dim);display:flex;align-items:center;justify-content:center;margin-bottom:16px}
.modal-icon svg{width:19px;height:19px;stroke:var(--gold);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.modal-icon.danger{background:rgba(140,58,58,.22)}
.modal-icon.danger svg{stroke:#E08585}
.modal-msg{font-size:14px;color:var(--text);line-height:1.65;margin-bottom:18px}
#modalInput{margin-bottom:18px}
.modal-actions{display:flex;gap:10px;justify-content:flex-end}
.modal-actions .btn{padding:10px 20px;font-size:13px}



/* hero poster image */
.hero-poster{
  width:100%;
  max-width:480px;
  border:1px solid var(--border);
  border-radius:28px;
  background:linear-gradient(135deg,rgba(240,229,211,.08),rgba(200,150,62,.08));
  padding:18px;
  position:relative;
  overflow:hidden;
  box-shadow:0 24px 80px rgba(0,0,0,.45);
}
.hero-poster::before{
  content:'';
  position:absolute;
  width:220px;
  height:220px;
  top:-90px;
  right:-80px;
  background:radial-gradient(circle,rgba(200,150,62,.35),transparent 65%);
  filter:blur(8px);
}
.hero-poster img{
  width:100%;
  display:block;
  border-radius:20px;
  object-fit:cover;
  position:relative;
  z-index:1;
}

/* responsive */
@media(max-width:900px){
  .hero,.cgrid,.tgridlay,.egridlay{grid-template-columns:1fr}
  .filmvis{display:none}
  .ccard{position:static!important}
  .editpanel{position:static!important}
  .wrap{padding:20px 16px}
  .nav-links{display:none}
  .htitle{font-size:48px}
}
</style>
</head>
<body>

<!-- ============ LANDING ============ -->
<section id="landingPage" class="page active">
  <nav class="nav">
    <div class="logo">Studio<em>Booth</em></div>
  </nav>
  <div class="wrap">
    <div class="hero">
      <div>
        <h1 class="htitle">
          Abadikan<br><span>Momen</span><br>Terbaikmu
        </h1>
        <p class="hdesc">Foto keren, frame estetik, tambah template sendiri, dan hasilnya langsung diunduh dalam sekejap.</p>
        <div class="hfeats">
          <div class="hfeat"><div class="fdot"></div> Timer otomatis</div>
          <div class="hfeat"><div class="fdot"></div> 9 template eksklusif</div>
          <div class="hfeat"><div class="fdot"></div> Upload template sendiri</div>
          <div class="hfeat"><div class="fdot"></div> Download langsung</div>
        </div>
        <button class="btn btn-primary btn-lg" onclick="startSession()">
          Mulai Foto
          <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </div>

      <div class="hero-poster">
        <img src="{{ asset('images/kamera.jpg') }}" alt="Studio Booth Camera">
      </div>
    </div>
  </div>
</section>

<!-- ============ CAMERA ============ -->
<section id="cameraPage" class="page">
  <nav class="nav"><div class="logo">Studio<em>Booth</em></div></nav>
  <div class="wrap">
    <button class="back" onclick="showPage('landingPage')">
      <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Kembali
    </button>
    <div class="stepper">
      <div class="step active"><div class="sdot"></div>Kamera</div>
      <div class="sline"></div>
      <div class="step"><div class="sdot"></div>Template</div>
      <div class="sline"></div>
      <div class="step"><div class="sdot"></div>Download</div>
    </div>
    <div class="cgrid">
      <div class="camwrap">
        <div class="vwrap">
          <video id="video" autoplay playsinline></video>
          <div class="fcorner tl"></div>
          <div class="fcorner tr"></div>
          <div class="fcorner bl"></div>
          <div class="fcorner br"></div>
          <div id="flashEl" class="flash"></div>
          <div id="shotBadge" class="shotbadge">
            <div class="liveDot"></div>
            <span id="shotText">Siap 3x Foto</span>
          </div>
          <div id="cdLayer" class="cdlayer">
            <div id="cdNum" class="cdnum">3</div>
          </div>
        </div>
        <div class="camctrl">
          <button class="iconbtn" onclick="startCamera()" title="Restart kamera">⟳</button>
          <button class="shutter" onclick="startCountdown()" title="Ambil foto"></button>
          <button class="iconbtn" onclick="stopCamera()" title="Matikan kamera">✕</button>
        </div>
        <p class="camhint">Tekan ● sekali — sistem otomatis ambil 3 foto.</p>
      </div>

      <div class="scard">
        <div class="stitle">Cara Pakai</div>
        <br>
        <div class="tips">
          <div class="tip">
            <div class="tipn"><svg viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M4 21v-2a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v2"/></svg></div>
            <div class="tipt"><strong>Posisikan wajah</strong>Pastikan dalam frame & cahaya cukup</div>
          </div>
          <div class="tip">
            <div class="tipn"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
            <div class="tipt"><strong>Tekan shutter</strong>Countdown 3 detik berjalan otomatis</div>
          </div>
          <div class="tip">
            <div class="tipn"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div>
            <div class="tipt"><strong>Pilih template</strong>9 frame estetik atau upload sendiri</div>
          </div>
          <div class="tip">
            <div class="tipn"><svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></div>
            <div class="tipt"><strong>Download</strong>Tambah caption & simpan hasilnya</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ TEMPLATE ============ -->
<section id="templatePage" class="page">
  <nav class="nav"><div class="logo">Studio<em>Booth</em></div></nav>
  <div class="wrap">
    <button class="back" onclick="showPage('cameraPage')">
      <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Kembali
    </button>
    <div class="stepper">
      <div class="step done"><div class="sdot"></div>Kamera</div>
      <div class="sline"></div>
      <div class="step active"><div class="sdot"></div>Template</div>
      <div class="sline"></div>
      <div class="step"><div class="sdot"></div>Download</div>
    </div>
    <div class="tgridlay">
      <div class="ccard" style="position:sticky;top:90px">
        <div class="ccard-label">Preview</div>
        <canvas id="resultCanvas" width="800" height="1050"></canvas>
      </div>
      <div style="display:flex;flex-direction:column;gap:18px">
        <div>
          <div class="stitle">Pilih Template</div>
          <div class="sdesc">Pilih frame yang tersedia atau tambahkan template milikmu sendiri.</div>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap">
          <button class="btn btn-ghost" onclick="openTplUpload()">+ Tambah Template</button>
          <button class="btn btn-outline" onclick="resetCustom()">Reset Custom</button>
          <input id="tplUpload" class="hidden" type="file" accept="image/png,image/jpeg,image/webp" onchange="addCustom(event)">
        </div>
        <div class="tnote">Gunakan file <strong>PNG transparan ukuran 800 × 1050px</strong> agar foto tetap terlihat dan frame menempel rapi di atas foto.</div>
        <div id="tplGrid" class="tgrid"></div>
        <button class="btn btn-primary btn-lg btn-full" onclick="showEdit()">
          Edit &amp; Download
          <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- ============ EDIT / DOWNLOAD ============ -->
<section id="editPage" class="page">
  <nav class="nav"><div class="logo">Studio<em>Booth</em></div></nav>
  <div class="wrap">
    <button class="back" onclick="showPage('templatePage')">
      <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      Kembali
    </button>
    <div class="stepper">
      <div class="step done"><div class="sdot"></div>Kamera</div>
      <div class="sline"></div>
      <div class="step done"><div class="sdot"></div>Template</div>
      <div class="sline"></div>
      <div class="step active"><div class="sdot"></div>Download</div>
    </div>
    <div class="egridlay">
      <div class="ccard" style="position:sticky;top:90px">
        <div class="ccard-label">Hasil Akhir</div>
        <canvas id="finalCanvas" width="800" height="1050"></canvas>
      </div>
      <div class="editpanel">
        <div>
          <div class="stitle">Edit Foto</div>
          <div class="sdesc">Tambahkan sentuhan personal pada fotomu.</div>
        </div>
        <div>
          <label class="flabel" for="capInput">Caption</label>
          <input id="capInput" class="finput" type="text" value="best moment" maxlength="24" oninput="updateCaption()">
        </div>
        <div>
          <div class="flabel">Warna Teks</div>
          <div class="cdots">
            <button class="cdot active" style="background:#F0E5D3" onclick="pickColor('#F0E5D3',this)"></button>
            <button class="cdot" style="background:#C8963E" onclick="pickColor('#C8963E',this)"></button>
            <button class="cdot" style="background:#C98B7C" onclick="pickColor('#C98B7C',this)"></button>
            <button class="cdot" style="background:#6B9E7A" onclick="pickColor('#6B9E7A',this)"></button>
            <button class="cdot" style="background:#9B72CF" onclick="pickColor('#9B72CF',this)"></button>
            <button class="cdot" style="background:#111111" onclick="pickColor('#111111',this)"></button>
          </div>
        </div>
        <div class="divider"></div>
        <button class="btn btn-primary btn-full btn-lg" onclick="downloadPhoto()">
          Download Foto
          <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M8 3v8M4 9l4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <button class="btn btn-outline btn-full" onclick="retakePhoto()">
          Ambil Ulang
          <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M2 8a6 6 0 016-6 6 6 0 014.5 2M2 8l2-2 2 2M14 8a6 6 0 01-6 6 6 6 0 01-4.5-2M14 8l-2 2-2-2" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- custom themed modal (replaces alert/confirm/prompt) -->
<div id="modalOverlay" class="modal-overlay hidden">
  <div class="modal-box">
    <div id="modalIcon" class="modal-icon"></div>
    <div id="modalMsg" class="modal-msg"></div>
    <input id="modalInput" class="finput hidden" type="text">
    <div class="modal-actions">
      <button id="modalCancelBtn" class="btn btn-outline hidden">Batal</button>
      <button id="modalOkBtn" class="btn btn-primary">OK</button>
    </div>
  </div>
</div>

<!-- hidden canvas for capture -->
<canvas id="capCanvas" class="hidden"></canvas>

<!-- flow bar -->
<div id="flowbar">
  <span class="fstep cur" id="fl1">⌂ Landing</span>
  <span class="fsep">→</span>
  <span class="fstep" id="fl2">📷 Kamera</span>
  <span class="fsep">→</span>
  <span class="fstep" id="fl3">🖼 Template</span>
  <span class="fsep">→</span>
  <span class="fstep" id="fl4">⬇ Download</span>
</div>

<script>
const pages = document.querySelectorAll('.page');
const videoEl = document.getElementById('video');
const capCanvas = document.getElementById('capCanvas');
const rCanvas = document.getElementById('resultCanvas');
const fCanvas = document.getElementById('finalCanvas');
const rCtx = rCanvas.getContext('2d');
const fCtx = fCanvas.getContext('2d');
const cdLayer = document.getElementById('cdLayer');
const cdNum = document.getElementById('cdNum');
const capInput = document.getElementById('capInput');
const tplGrid = document.getElementById('tplGrid');
const shotBadge = document.getElementById('shotBadge');
const shotText  = document.getElementById('shotText');

const PHOTO_TOTAL = 3;
let currentShot = 0;
let isShooting = false;

const BUILT_IN = [
  { id:'noir',     name:'Noir Elegant',  bg:['#0E0E12','#18151F'], fg:'light', frame:'#C8963E', deco:'#C8963E', chars:['✦','✦','◈','◈','✧','✧'] },
  { id:'cream',    name:'Cream Film',    bg:['#EAD8C3','#FFF5E6'], fg:'dark',  frame:'#D4B896', deco:'#8B6F4E', chars:['✿','✿','❀','❀','❁','❁'] },
  { id:'rose',     name:'Rose Dust',     bg:['#3D1E1C','#6B2E28'], fg:'light', frame:'#C98B7C', deco:'#F4B8AE', chars:['♡','♡','✿','✿','♡','♡'] },
  { id:'midnight', name:'Midnight',      bg:['#060D2E','#0D1F55'], fg:'light', frame:'#3A4E8C', deco:'#9B72CF', chars:['✦','✦','☾','★','◎','◎'] },
  { id:'lavender', name:'Lavender',      bg:['#1A1030','#2E1960'], fg:'light', frame:'#A08ED0', deco:'#C8B4F8', chars:['✧','✧','☆','☆','✦','✦'] },
  { id:'retro',    name:'Retro Sun',     bg:['#FFF0D0','#FFE3B3'], fg:'dark',  frame:'#C4924A', deco:'#C4924A', chars:['✺','✺','◉','◉','✸','✸'] },
  { id:'white',    name:'Minimal White', bg:['#FFFFFF','#F5F0EC'], fg:'dark',  frame:'#D8D3CB', deco:'#9ca3af', chars:['·','·','◇','◇','·','·'] },
  { id:'forest',   name:'Forest',        bg:['#0D2214','#1B3D25'], fg:'light', frame:'#3D6B4E', deco:'#6B9E7A', chars:['❧','❧','☘','☘','✿','✿'] },
  { id:'polaroid', name:'Polaroid',      bg:['#FFFFFF','#FAFAFA'], fg:'dark',  frame:'#E8E4DE', deco:'#374151', chars:['◇','◇','◈','◈','◇','◇'] }
];

const MINI_COLORS = {
  noir:'linear-gradient(135deg,#0E0E12,#1a1820)',
  cream:'linear-gradient(135deg,#EAD8C3,#FFF5E6)',
  rose:'linear-gradient(135deg,#3D1E1C,#6B2E28)',
  midnight:'linear-gradient(135deg,#060D2E,#162050)',
  lavender:'linear-gradient(135deg,#1A1030,#2E1960)',
  retro:'linear-gradient(135deg,#FFF0D0,#FFE3B3)',
  white:'linear-gradient(135deg,#FFFFFF,#F5F0EC)',
  forest:'linear-gradient(135deg,#0D2214,#1B3D25)',
  polaroid:'#FFFFFF'
};

let camStream = null;
let capturedImgs = [];
let capturedImg = null;
let selTpl = 'noir';
let txtColor = '#F0E5D3';
let capTxt = 'best moment';
let customs = loadCustoms();

/* ===== Image cache (avoid reloading/flicker on every render) ===== */
const imgCache = {};
function loadCached(src, cb){
  if(!src){ cb(null); return; }
  if(imgCache[src]){ cb(imgCache[src]); return; }

  const im = new Image();
  im.onload = () => { imgCache[src] = im; cb(im); };
  im.onerror = () => cb(null);
  im.src = src;
}

/* ===== Custom themed modal (replaces alert/confirm/prompt) ===== */
const modalOverlay = document.getElementById('modalOverlay');
const modalIcon = document.getElementById('modalIcon');
const modalMsg = document.getElementById('modalMsg');
const modalInput = document.getElementById('modalInput');
const modalOkBtn = document.getElementById('modalOkBtn');
const modalCancelBtn = document.getElementById('modalCancelBtn');
let modalResolver = null;

const MODAL_ICONS = {
  info: '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><line x1="12" y1="11" x2="12" y2="16"/><circle cx="12" cy="7.5" r=".6" fill="currentColor" stroke="none"/></svg>',
  warn: '<svg viewBox="0 0 24 24"><path d="M12 3l9 16H3z"/><line x1="12" y1="9" x2="12" y2="13"/><circle cx="12" cy="16.3" r=".6" fill="currentColor" stroke="none"/></svg>',
  danger: '<svg viewBox="0 0 24 24"><path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0-1 14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2L4 6"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>'
};

function openModal({message, showInput=false, inputValue='', showCancel=false, okText='Mengerti', cancelText='Batal', danger=false, icon='info'}){
  modalMsg.textContent = message;
  modalIcon.innerHTML = MODAL_ICONS[icon] || MODAL_ICONS.info;
  modalIcon.classList.toggle('danger', icon === 'danger');
  modalInput.classList.toggle('hidden', !showInput);
  modalInput.value = inputValue;
  modalCancelBtn.classList.toggle('hidden', !showCancel);
  modalOkBtn.textContent = okText;
  modalCancelBtn.textContent = cancelText;
  modalOkBtn.classList.toggle('btn-primary', !danger);
  modalOkBtn.classList.toggle('btn-danger', danger);
  modalOverlay.classList.remove('hidden');
  if(showInput) setTimeout(() => modalInput.focus(), 50);
}

function closeModal(){
  modalOverlay.classList.add('hidden');
  modalResolver = null;
}

function showAlert(message, opts={}){
  return new Promise(resolve => {
    openModal({message, showInput:false, showCancel:false, okText:opts.okText || 'Mengerti', icon:opts.icon || 'info'});
    modalResolver = () => { closeModal(); resolve(true); };
  });
}

function showConfirm(message, opts={}){
  return new Promise(resolve => {
    openModal({message, showInput:false, showCancel:true, okText:opts.okText || 'Ya, lanjutkan', cancelText:opts.cancelText || 'Batal', danger:opts.danger, icon:opts.icon || 'warn'});
    modalResolver = (val) => { closeModal(); resolve(val); };
  });
}

function showPrompt(message, defVal='', opts={}){
  return new Promise(resolve => {
    openModal({message, showInput:true, inputValue:defVal, showCancel:true, okText:opts.okText || 'Simpan', cancelText:opts.cancelText || 'Batal', icon:opts.icon || 'info'});
    modalResolver = (val) => { closeModal(); resolve(val); };
  });
}

modalOkBtn.onclick = () => {
  if(!modalResolver) return;
  const isPrompt = !modalInput.classList.contains('hidden');
  modalResolver(isPrompt ? modalInput.value : true);
};

modalCancelBtn.onclick = () => {
  if(!modalResolver) return;
  const isPrompt = !modalInput.classList.contains('hidden');
  modalResolver(isPrompt ? null : false);
};

document.addEventListener('keydown', e => {
  if(modalOverlay.classList.contains('hidden')) return;
  if(e.key === 'Enter'){ e.preventDefault(); modalOkBtn.click(); }
  if(e.key === 'Escape' && !modalCancelBtn.classList.contains('hidden')) modalCancelBtn.click();
});

/* ===== Capture flash effect ===== */
function triggerFlash(){
  const el = document.getElementById('flashEl');
  el.style.transition = 'none';
  el.style.opacity = '.85';
  requestAnimationFrame(() => {
    el.style.transition = 'opacity .25s ease-out';
    el.style.opacity = '0';
  });
}

const PAGEMAP = { landingPage:1, cameraPage:2, templatePage:3, editPage:4 };

function showPage(id) {
  pages.forEach(p => p.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  window.scrollTo({top:0,behavior:'smooth'});

  const n = PAGEMAP[id];
  for(let i=1;i<=4;i++) {
    document.getElementById('fl'+i)?.classList.toggle('cur', i===n);
  }
}

function startSession() {
  capturedImgs = [];
  capturedImg = null;
  currentShot = 0;
  isShooting = false;
  updateShotBadge();
  showPage('cameraPage');
  startCamera();
}

async function startCamera() {
  try {
    if(camStream) return;

    camStream = await navigator.mediaDevices.getUserMedia({
      video:{facingMode:'user'},
      audio:false
    });

    videoEl.srcObject = camStream;
  } catch(e) {
    showAlert('Kamera tidak bisa dibuka. Pastikan izin kamera di browser sudah aktif.', {icon:'warn'});
  }
}

function stopCamera() {
  if(!camStream) return;

  camStream.getTracks().forEach(t=>t.stop());
  camStream = null;
  videoEl.srcObject = null;
}

function updateShotBadge(){
  if(!shotText) return;

  const next = Math.min(currentShot + 1, PHOTO_TOTAL);
  shotText.textContent = isShooting ? `Foto ${next}/${PHOTO_TOTAL}` : `Siap 3x Foto`;
}

function startCountdown() {
  if(isShooting) return;

  if(!videoEl.srcObject) {
    startCamera();
    showAlert('Kamera sedang diaktifkan. Tekan foto lagi setelah kamera muncul.', {icon:'info'});
    return;
  }

  capturedImgs = [];
  capturedImg = null;
  currentShot = 0;
  isShooting = true;
  updateShotBadge();
  runCountdownThenCapture();
}

function runCountdownThenCapture() {
  let c = 3;

  cdLayer.style.display = 'flex';
  cdNum.textContent = c;
  updateShotBadge();

  const timer = setInterval(() => {
    c--;

    if(c > 0){
      cdNum.textContent = c;
    } else {
      clearInterval(timer);
      cdNum.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="#C8963E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="filter:drop-shadow(0 0 18px rgba(200,150,62,.7))"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>`;

      setTimeout(() => {
        cdLayer.style.display = 'none';
        capturePhoto();
      }, 320);
    }
  }, 1000);
}

function capturePhoto() {
  const w = videoEl.videoWidth;
  const h = videoEl.videoHeight;

  if(!w || !h){
    isShooting = false;
    showAlert('Kamera belum siap. Coba lagi.', {icon:'warn'});
    updateShotBadge();
    return;
  }

  triggerFlash();

  capCanvas.width = w;
  capCanvas.height = h;

  const ctx = capCanvas.getContext('2d');

  ctx.save();
  ctx.translate(w,0);
  ctx.scale(-1,1);
  ctx.drawImage(videoEl,0,0,w,h);
  ctx.restore();

  const img = new Image();

  img.onload = () => {
    capturedImgs.push(img);
    capturedImg = capturedImgs[0];
    currentShot = capturedImgs.length;
    updateShotBadge();

    if(capturedImgs.length < PHOTO_TOTAL){
      setTimeout(runCountdownThenCapture, 400);
    } else {
      isShooting = false;
      updateShotBadge();
      renderAll();
      showPage('templatePage');
    }
  };

  img.src = capCanvas.toDataURL('image/png');
}

function loadCustoms(){
  try{
    const d = localStorage.getItem('sb_ct');
    return d ? JSON.parse(d) : [];
  }catch{
    return [];
  }
}

function saveCustoms(){
  localStorage.setItem('sb_ct', JSON.stringify(customs));
}

function openTplUpload(){
  document.getElementById('tplUpload').click();
}

async function addCustom(e){
  const f = e.target.files[0];
  if(!f) return;

  if(!f.type.startsWith('image/')){
    showAlert('File harus berupa gambar PNG, JPG, atau WEBP.', {icon:'warn'});
    e.target.value = '';
    return;
  }

  const r = new FileReader();

  r.onload = ev => {
    const probe = new Image();

    probe.onload = async () => {
      const targetRatio = 800 / 1050;
      const ratio = probe.width / probe.height;
      const offBy = Math.abs(ratio - targetRatio) / targetRatio;

      if(offBy > 0.05){
        const proceed = await showConfirm(
          `Gambar ini berukuran ${probe.width}×${probe.height}px, rasionya beda dari 800×1050px. Supaya tidak gepeng, gambar akan otomatis dipotong (crop) menyesuaikan frame. Lanjutkan?`,
          {okText:'Lanjutkan', cancelText:'Batal', icon:'warn'}
        );
        if(!proceed){ e.target.value = ''; return; }
      }

      const nm = await showPrompt('Nama template:', f.name.replace(/\.[^/.]+$/,''), {okText:'Simpan'});
      if(nm === null){ e.target.value = ''; return; }

      // Render gambar yang diupload ke kanvas standar 800x1050 (cover-fit, tidak gepeng)
      // lalu scan pixel-nya untuk mendeteksi area gelap/kotak hitam sebagai slot foto.
      const W = rCanvas.width, H = rCanvas.height;
      const analysis = analyzeCustomTemplate(probe, W, H);

      const t = {
        id:'c-' + Date.now(),
        name: nm || 'Custom',
        src: analysis.canvas.toDataURL('image/png'),
        slots: analysis.slots,
        custom:true
      };

      customs.push(t);
      selTpl = t.id;
      saveCustoms();
      buildTplGrid();
      renderAll();
      e.target.value = '';

      if(t.slots){
        showAlert('Template berhasil dianalisis — 3 area gelap terdeteksi otomatis sebagai slot foto. Foto kamu sekarang akan ditempatkan tepat di posisi tersebut, dan sisa desain template (border, teks, dekorasi) tetap tampil di atasnya.', {icon:'info'});
      } else {
        showAlert('Slot foto tidak terdeteksi otomatis pada template ini, jadi dianggap PNG transparan biasa. Foto akan memakai posisi standar di belakang template — kalau template kamu solid/tidak transparan, foto bisa tertutup.', {icon:'warn'});
      }
    };

    probe.src = ev.target.result;
  };

  r.readAsDataURL(f);
}

async function deleteCustom(id){
  const ok = await showConfirm('Template ini akan dihapus permanen dari daftar kamu.', {okText:'Hapus', cancelText:'Batal', danger:true, icon:'danger'});
  if(!ok) return;

  customs = customs.filter(t => t.id !== id);

  if(selTpl === id) selTpl = 'noir';

  saveCustoms();
  buildTplGrid();
  renderAll();
}

async function resetCustom(){
  const ok = await showConfirm('Semua template custom yang sudah kamu tambahkan akan dihapus permanen.', {okText:'Hapus Semua', cancelText:'Batal', danger:true, icon:'danger'});
  if(!ok) return;

  customs = [];
  selTpl = 'noir';

  saveCustoms();
  buildTplGrid();
  renderAll();
}

function getCustTpl(){
  return customs.find(t => t.id === selTpl);
}

function getTplDef(){
  return BUILT_IN.find(t => t.id === selTpl) || BUILT_IN[0];
}

function buildTplGrid(){
  tplGrid.innerHTML = '';

  BUILT_IN.forEach(t => tplGrid.appendChild(mkTplBtn(t,false)));
  customs.forEach(t => tplGrid.appendChild(mkTplBtn(t,true)));
}

function mkTplBtn(t,isCustom){
  const wrap = document.createElement('div');
  wrap.className = 'twrap';

  const btn = document.createElement('button');
  btn.className = 'topt' + (selTpl === t.id ? ' active' : '');
  btn.type = 'button';
  btn.onclick = () => {
    selTpl = t.id;
    buildTplGrid();
    renderAll();
  };

  const mini = document.createElement('div');
  mini.className = 'tmini';
  mini.style.background = MINI_COLORS[t.id] || 'linear-gradient(135deg,#0E0E12,#18151F)';

  if(isCustom){
    const img = document.createElement('img');
    img.src = t.src;
    img.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:9px';
    mini.appendChild(img);
  } else {
    const fr = document.createElement('div');
    fr.className = 'tmini-frame';

    const lbl = document.createElement('div');
    lbl.className = 'tmini-label';
    lbl.textContent = '✦';
    lbl.style.color = (t.fg === 'dark') ? 'rgba(0,0,0,.45)' : 'rgba(255,255,255,.45)';

    mini.appendChild(fr);
    mini.appendChild(lbl);
  }

  const nm = document.createElement('span');
  nm.className = 'tname';
  nm.textContent = t.name;

  btn.appendChild(mini);
  btn.appendChild(nm);
  wrap.appendChild(btn);

  if(isCustom){
    const del = document.createElement('button');
    del.className = 'tdel';
    del.textContent = '×';
    del.onclick = ev => {
      ev.stopPropagation();
      deleteCustom(t.id);
    };
    wrap.appendChild(del);
  }

  return wrap;
}

function showEdit(){
  renderAll();
  showPage('editPage');
}

function updateCaption(){
  capTxt = capInput.value || 'best moment';
  renderAll();
}

function pickColor(c,btn){
  txtColor = c;

  document.querySelectorAll('.cdot').forEach(d => d.classList.remove('active'));
  btn.classList.add('active');

  renderAll();
}

function hasPhotos(){
  return capturedImgs.length > 0;
}

function renderAll(){
  render(rCtx, rCanvas);
  render(fCtx, fCanvas);
}

function render(ctx, canvas){
  const W = canvas.width;
  const H = canvas.height;

  ctx.clearRect(0,0,W,H);

  if(!hasPhotos()){
    drawPlaceholder(ctx,W,H);
    return;
  }

  const cust = getCustTpl();

  if(cust){
    if(cust.slots && cust.slots.length === 3){
      // Template custom dengan slot foto terdeteksi otomatis (area gelap = lubang foto)
      drawCustomWithSlots(ctx,W,H,cust);
    } else {
      // Template custom PNG transparan biasa: foto di posisi standar, overlay di atas
      drawBG(ctx,W,H);
      drawPhoto(ctx,W,H);
      drawOverlay(ctx,W,H,cust.src);
    }
  } else {
    // Built-in template: urutan normal
    drawBG(ctx,W,H);
    drawPhoto(ctx,W,H);
    drawFrame(ctx,W,H);
    drawDecor(ctx,W,H);
    drawCaption(ctx,W,H);
  }
}

function drawPlaceholder(ctx,W,H){
  ctx.fillStyle = '#130F28';
  ctx.fillRect(0,0,W,H);

  ctx.fillStyle = '#1B1738';
  ctx.fillRect(95,85,W-190,235);
  ctx.fillRect(95,355,W-190,235);
  ctx.fillRect(95,625,W-190,235);

  ctx.fillStyle = '#9080AC';
  ctx.font = 'italic 34px "Cormorant Garamond",serif';
  ctx.textAlign = 'center';
  ctx.fillText('hasil 3 foto akan muncul di sini',W/2,H/2);
}

function drawBG(ctx,W,H){
  const d = getTplDef();

  const g = ctx.createLinearGradient(0,0,W,H);
  g.addColorStop(0,d.bg[0]);
  g.addColorStop(1,d.bg[1]);

  ctx.fillStyle = g;
  ctx.fillRect(0,0,W,H);

  if(selTpl === 'retro') drawRetroSun(ctx,W,H);
  if(selTpl === 'midnight') drawStars(ctx,W,H);
  if(selTpl === 'forest') drawLeaves(ctx,W,H);
}

function getPhotoSlots(W,H){
  const mx = 105;
  const slotW = W - mx * 2;
  const slotH = 235;
  const gap = 28;
  const startY = 92;

  return [0,1,2].map(i => ({
    x: mx,
    y: startY + i * (slotH + gap),
    w: slotW,
    h: slotH
  }));
}

function drawPhoto(ctx,W,H){
  const slots = getPhotoSlots(W,H);

  slots.forEach((slot, i) => {
    const img = capturedImgs[i];

    ctx.save();
    ctx.fillStyle = 'rgba(0,0,0,.28)';
    roundRect(ctx, slot.x - 8, slot.y + 8, slot.w + 16, slot.h + 14, 8, true, false);
    ctx.restore();

    if(img){
      drawImageCover(ctx, img, slot.x, slot.y, slot.w, slot.h);
    } else {
      ctx.fillStyle = '#1B1738';
      ctx.fillRect(slot.x, slot.y, slot.w, slot.h);
    }

    ctx.save();
    ctx.strokeStyle = 'rgba(255,255,255,.18)';
    ctx.lineWidth = 2;
    ctx.strokeRect(slot.x, slot.y, slot.w, slot.h);
    ctx.restore();
  });
}

function drawImageCover(ctx,img,x,y,w,h){
  const ir = img.width / img.height;
  const fr = w / h;

  let sx, sy, sw, sh;

  if(ir > fr){
    sh = img.height;
    sw = sh * fr;
    sx = (img.width - sw) / 2;
    sy = 0;
  } else {
    sw = img.width;
    sh = sw / fr;
    sx = 0;
    sy = (img.height - sh) / 2;
  }

  ctx.drawImage(img, sx, sy, sw, sh, x, y, w, h);
}

function roundRect(ctx,x,y,w,h,r,fill,stroke){
  ctx.beginPath();
  ctx.moveTo(x+r,y);
  ctx.lineTo(x+w-r,y);
  ctx.quadraticCurveTo(x+w,y,x+w,y+r);
  ctx.lineTo(x+w,y+h-r);
  ctx.quadraticCurveTo(x+w,y+h,x+w-r,y+h);
  ctx.lineTo(x+r,y+h);
  ctx.quadraticCurveTo(x,y+h,x,y+h-r);
  ctx.lineTo(x,y+r);
  ctx.quadraticCurveTo(x,y,x+r,y);
  ctx.closePath();

  if(fill) ctx.fill();
  if(stroke) ctx.stroke();
}

function drawFrame(ctx,W,H){
  const d = getTplDef();

  ctx.lineWidth = 24;
  ctx.strokeStyle = d.frame;
  ctx.strokeRect(40,40,W-80,H-120);

  ctx.lineWidth = 1.5;
  ctx.strokeStyle = d.fg === 'dark' ? 'rgba(0,0,0,.15)' : 'rgba(255,255,255,.18)';
  ctx.strokeRect(58,58,W-116,H-156);

  if(['noir','midnight','lavender'].includes(selTpl)){
    drawCorners(ctx,40,40,W-80,H-120,d.deco);
  }
}

function drawCorners(ctx,fx,fy,fw,fh,color){
  ctx.font = '20px serif';
  ctx.fillStyle = color;

  const o = 13;

  ctx.textAlign = 'left';
  ctx.fillText('◈',fx+o,fy+o+18);

  ctx.textAlign = 'right';
  ctx.fillText('◈',fx+fw-o,fy+o+18);

  ctx.textAlign = 'left';
  ctx.fillText('◈',fx+o,fy+fh-o);

  ctx.textAlign = 'right';
  ctx.fillText('◈',fx+fw-o,fy+fh-o);
}

function drawCaption(ctx,W,H){
  const d = getTplDef();

  let color = txtColor;
  const lightBGs = ['cream','retro','white','polaroid'];

  if(lightBGs.includes(selTpl) && color === '#F0E5D3'){
    color = '#2C1F14';
  }

  ctx.save();
  ctx.textAlign = 'center';
  ctx.font = 'italic 52px "Cormorant Garamond",Georgia,serif';
  ctx.fillStyle = color;
  ctx.fillText(capTxt,W/2,H-70);

  const tw = ctx.measureText(capTxt).width;

  ctx.globalAlpha = .28;
  ctx.strokeStyle = color;
  ctx.lineWidth = 1.2;
  ctx.beginPath();
  ctx.moveTo(W/2-tw/2,H-52);
  ctx.lineTo(W/2+tw/2,H-52);
  ctx.stroke();

  ctx.restore();
}

function drawDecor(ctx,W,H){
  if(getCustTpl()) return;

  const d = getTplDef();

  ctx.textAlign = 'center';
  ctx.font = '22px serif';
  ctx.fillStyle = d.deco;

  const xs = [86,W-86,86,W-86,86,W-86];
  const ys = [72,72,360,360,648,648];

  d.chars.forEach((ch,i) => ctx.fillText(ch,xs[i],ys[i]));
}

function drawRetroSun(ctx,W,H){
  ctx.save();

  const cx = W/2;
  const cy = H+120;
  const rad = 400;

  const g = ctx.createRadialGradient(cx,cy,0,cx,cy,rad);
  g.addColorStop(0,'rgba(255,180,60,.3)');
  g.addColorStop(1,'rgba(255,180,60,0)');

  ctx.fillStyle = g;
  ctx.beginPath();
  ctx.arc(cx,cy,rad,Math.PI,0);
  ctx.fill();

  ctx.strokeStyle = 'rgba(200,130,40,.1)';
  ctx.lineWidth = 3;

  for(let i=0;i<14;i++){
    const y = H-40-i*30;
    ctx.beginPath();
    ctx.moveTo(0,y);
    ctx.lineTo(W,y);
    ctx.stroke();
  }

  ctx.restore();
}

function drawStars(ctx,W,H){
  ctx.save();

  const pts = [
    [100,80,2],[200,128,1.5],[155,58,2.5],
    [320,98,1],[420,72,2],[650,88,1.5],
    [710,128,2],[680,48,1],[560,112,1.5],
    [80,H-300,2],[150,H-348,1.5],[280,H-278,1],
    [700,H-318,2],[740,H-288,1.5]
  ];

  pts.forEach(([x,y,r]) => {
    ctx.fillStyle = 'rgba(155,114,207,.55)';
    ctx.beginPath();
    ctx.arc(x,y,r,0,Math.PI*2);
    ctx.fill();
  });

  ctx.restore();
}

function drawLeaves(ctx,W,H){
  ctx.save();

  ctx.fillStyle = 'rgba(107,158,122,.18)';
  ctx.font = '36px serif';

  ctx.textAlign = 'left';
  ctx.fillText('❧',24,190);
  ctx.fillText('☘',18,470);

  ctx.textAlign = 'right';
  ctx.fillText('❧',W-24,190);
  ctx.fillText('☘',W-18,470);

  ctx.restore();
}

function drawOverlay(ctx,W,H,src){
  // Gambar template custom sebagai overlay di ATAS foto (bukan menimpa)
  // Template harus PNG transparan — bagian transparan = area foto kelihatan
  loadCached(src, img => {
    if(img) ctx.drawImage(img, 0, 0, W, H);
    drawCaption(ctx,W,H);
  });
}

function drawCustomWithSlots(ctx,W,H,cust){
  // Taruh foto persis di kotak slot yang sudah dideteksi (cover-fit, tidak gepeng)
  cust.slots.forEach((slot,i) => {
    const img = capturedImgs[i];

    if(img){
      drawImageCover(ctx, img, slot.x, slot.y, slot.w, slot.h);
    } else {
      ctx.fillStyle = '#1B1738';
      ctx.fillRect(slot.x, slot.y, slot.w, slot.h);
    }
  });

  // Template (versi sudah dilubangi) ditimpa di atas — sisa desain (border/teks/dekor)
  // tetap utuh, sementara area slot tadi sudah transparan jadi foto kelihatan.
  drawOverlay(ctx,W,H,cust.src);
}

function analyzeCustomTemplate(probeImg, W, H){
  // 1) Render gambar upload ke kanvas standar WxH pakai cover-fit, supaya koordinat
  //    slot yang ditemukan langsung cocok dengan kanvas hasil akhir (tidak gepeng).
  const off = document.createElement('canvas');
  off.width = W; off.height = H;
  const octx = off.getContext('2d');
  drawImageCover(octx, probeImg, 0, 0, W, H);

  const imgData = octx.getImageData(0,0,W,H);
  const data = imgData.data;
  const total = W * H;

  const DARK_LUM = 42;        // ambang kecerahan untuk dianggap "kotak hitam" (slot foto)
  const ALPHA_OPAQUE = 200;
  const ALPHA_TRANSPARENT = 12;

  const isHoleMask = new Uint8Array(total);

  for(let p=0;p<total;p++){
    const idx = p*4;
    const r = data[idx], g = data[idx+1], b = data[idx+2], a = data[idx+3];
    const lum = 0.299*r + 0.587*g + 0.114*b;

    // sudah transparan (PNG asli) ATAU pixel gelap solid (kotak hitam penanda slot)
    if(a <= ALPHA_TRANSPARENT || (a >= ALPHA_OPAQUE && lum <= DARK_LUM)){
      isHoleMask[p] = 1;
    }
  }

  // 2) Connected-component labeling (flood fill) untuk mengelompokkan pixel gelap
  //    jadi blok-blok area, lalu ambil bounding box tiap blok.
  const visited = new Uint8Array(total);
  const qx = new Int32Array(total);
  const qy = new Int32Array(total);
  const clusters = [];

  for(let y=0;y<H;y++){
    for(let x=0;x<W;x++){
      const p = y*W+x;
      if(!isHoleMask[p] || visited[p]) continue;

      let qh = 0, qt = 0;
      qx[qt]=x; qy[qt]=y; qt++;
      visited[p]=1;

      let minX=x, maxX=x, minY=y, maxY=y, count=0;

      while(qh<qt){
        const cx=qx[qh], cy=qy[qh]; qh++;
        count++;
        if(cx<minX)minX=cx; if(cx>maxX)maxX=cx;
        if(cy<minY)minY=cy; if(cy>maxY)maxY=cy;

        if(cx+1<W){ const np=cy*W+(cx+1); if(isHoleMask[np] && !visited[np]){ visited[np]=1; qx[qt]=cx+1; qy[qt]=cy; qt++; } }
        if(cx-1>=0){ const np=cy*W+(cx-1); if(isHoleMask[np] && !visited[np]){ visited[np]=1; qx[qt]=cx-1; qy[qt]=cy; qt++; } }
        if(cy+1<H){ const np=(cy+1)*W+cx; if(isHoleMask[np] && !visited[np]){ visited[np]=1; qx[qt]=cx; qy[qt]=cy+1; qt++; } }
        if(cy-1>=0){ const np=(cy-1)*W+cx; if(isHoleMask[np] && !visited[np]){ visited[np]=1; qx[qt]=cx; qy[qt]=cy-1; qt++; } }
      }

      clusters.push({minX,maxX,minY,maxY,count});
    }
  }

  // 3) Filter: hanya area yang cukup besar (bukan noise/teks kecil) dan tidak
  //    menyentuh tepi gambar (border/bingkai desain biasanya nempel tepi, slot foto tidak).
  const minArea = total * 0.02;
  const edgeMargin = 3;

  let candidates = clusters.filter(c => {
    const touchesEdge = c.minX<=edgeMargin || c.minY<=edgeMargin || c.maxX>=W-1-edgeMargin || c.maxY>=H-1-edgeMargin;
    return c.count >= minArea && !touchesEdge;
  });

  candidates.sort((a,b) => b.count - a.count);
  candidates = candidates.slice(0,3);
  candidates.sort((a,b) => a.minY - b.minY); // urut atas ke bawah, sama urutan foto 1/2/3

  let slots = null;

  if(candidates.length === 3){
    slots = candidates.map(c => ({
      x: c.minX, y: c.minY,
      w: c.maxX - c.minX + 1,
      h: c.maxY - c.minY + 1
    }));

    // 4) Lubangi (transparan-kan) pixel-pixel gelap di dalam tiap slot supaya
    //    foto bisa "tembus" lewat area itu saat template digambar di atas foto.
    slots.forEach(s => {
      for(let yy=s.y; yy<s.y+s.h; yy++){
        for(let xx=s.x; xx<s.x+s.w; xx++){
          const p = yy*W+xx;
          if(isHoleMask[p]) data[p*4+3] = 0;
        }
      }
    });

    octx.putImageData(imgData,0,0);
  }

  return { canvas: off, slots };
}

function downloadPhoto(){
  render(fCtx,fCanvas);

  setTimeout(() => {
    const a = document.createElement('a');
    a.download = 'studiobooth-3foto-' + Date.now() + '.png';
    a.href = fCanvas.toDataURL('image/png');
    a.click();
  },250);
}

function retakePhoto(){
  capturedImgs = [];
  capturedImg = null;
  currentShot = 0;
  isShooting = false;

  updateShotBadge();
  showPage('cameraPage');
  startCamera();
}

buildTplGrid();
updateShotBadge();
render(rCtx,rCanvas);
render(fCtx,fCanvas);
</script>
</body>
</html>