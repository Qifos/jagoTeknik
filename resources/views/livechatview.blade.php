<!--
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231231)
 * Desc   : Live Chat View
 * Date   : 2025-11-06
-->
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JagoTeknik — Chat</title>


  <meta name="csrf-token" content="{{ csrf_token() }}">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('css/livechat.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


  <!-- Tambahan CSS khusus clip menu / layering -->
  <style>
    /* pastikan composer dan menunya di atas elemen lain */
    .jt-composer{ overflow-y:visible; z-index:40; }
    .jt-composer-bar{ overflow:visible; }
    .jt-btn-clip{ position:relative; z-index:100; }


    /* menu paperclip */
    .jt-clip-menu{
      position:absolute; right:18px; bottom:72px;
      background:#1e1e26; border:1px solid #2A2740; border-radius:12px;
      padding:6px; box-shadow:0 12px 36px rgba(0,0,0,.45);
      min-width:190px; display:none; z-index:9999;
    }
    .jt-clip-menu.show{ display:block; }
    .jt-clip-item{
      display:flex; align-items:center; gap:10px;
      padding:8px 10px; border-radius:10px; color:#F5F1FA; text-decoration:none; width:100%;
    }
    .jt-clip-item:hover{ background:#2a223d; }
    .jt-clip-item i{ font-size:18px; opacity:.95; width:22px; text-align:center; }
    .jt-clip-sep{ height:1px; background:#2A2740; margin:4px 0; opacity:.7; }
    .jt-prevdoc{ font-size:12px; padding:6px 10px; border:1px solid var(--border); border-radius:10px; opacity:.9 }
  </style>
</head>
<body class="jt-body">


  <!-- TOPBAR -->
  <header class="jt-topbar d-none d-lg-flex">
    <div class="container-fluid px-4 d-flex align-items-center">
      <div class="d-flex align-items-center gap-2 me-4">
        <img src="/logojagoteknik.png" class="jt-logo" alt="JagoTeknik">
      </div>
      <nav class="jt-nav">
        <a href="#">Beranda</a>
        <a href="#">Kelas</a>
        <a href="#">Jadwal</a>
        <a href="#" class="active">Chat</a>
      </nav>
      <div class="ms-auto d-flex align-items-center gap-3">
        <div class="jt-search">
          <i class="bi bi-search"></i>
          <input type="text" placeholder="Cari di JagoTeknik">
        </div>
        <div class="jt-profile">
          <img src="https://i.pravatar.cc/100?img=68" alt="">
          <span>Profil</span>
        </div>
      </div>
    </div>
  </header>


  <div class="jt-app">
    <!-- LEFT RAIL -->
    <aside class="jt-rail">
      <a class="jt-rail-item" href="#" title="Back"><i class="bi bi-chevron-left"></i></a>
      <a class="jt-rail-item" href="#" title="Beranda"><i class="bi bi-house-door"></i></a>
      <a class="jt-rail-item" href="#" title="Komunitas"><i class="bi bi-people"></i></a>
      <a class="jt-rail-item" href="#" title="Kelas"><i class="bi bi-easel"></i></a>
      <div class="jt-rail-spacer"></div>
      <div class="jt-rail-avatar"></div>
    </aside>


    <!-- LIST PANEL -->
    <section class="jt-list">
      <div class="jt-list-head">
        <h3 class="m-0">Chat <span class="badge jt-badge">0</span></h3>
        <div class="ms-auto">
          <div class="dropdown">
            <button class="btn jt-filter-btn dropdown-toggle" data-bs-toggle="dropdown">
              <i class="bi bi-sliders2"></i> Filter
            </button>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item jt-filter active" data-filter="all" href="#">Semua</a></li>
              <li><a class="dropdown-item jt-filter" data-filter="unread" href="#">Belum dibaca</a></li>
            </ul>
          </div>
        </div>
      </div>


      <div class="jt-search-left">
        <div class="jt-search-pill">
          <i class="bi bi-search"></i>
          <input id="jtSearchInput" type="text" placeholder="Cari chat">
        </div>
      </div>


      <div id="jtChatList" class="jt-list-scroll"></div>
    </section>


    <!-- ROOM -->
    <section class="jt-room">
      <!-- HEADER UNGU -->
      <div class="jt-room-head">
        <div class="d-flex align-items-center gap-3">
          <img id="jtRoomAvatar" class="rounded-circle" width="44" height="44" src="https://i.pravatar.cc/100?img=12" alt="">
          <div class="d-flex flex-column">
            <div class="jt-room-name" id="jtRoomName">—</div>
            <div class="jt-room-status"><span class="jt-dot"></span> <small id="jtRoomOnline">Online</small></div>
          </div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <button class="btn jt-icon jt-btn-video"><i class="bi bi-camera-video"></i></button>
          <button class="btn jt-icon jt-btn-call"><i class="bi bi-telephone"></i></button>
          <button class="btn jt-icon jt-btn-menu"><i class="bi bi-grid-3x3-gap-fill"></i></button>
        </div>
      </div>


      <!-- BODY -->
      <div id="jtRoomBody" class="jt-room-body">
        <div class="jt-day-sep">Pilih chat di sebelah kiri</div>
      </div>


      <!-- COMPOSER -->
      <div class="jt-composer">
        <div class="jt-composer-bar">
          <!-- tombol kotak kiri (attach default) -->
          <label for="jtFile" class="jt-btn-attach">
            <i class="bi bi-grid-3x3-gap-fill"></i>
          </label>
          <input id="jtFile" type="file" accept="image/*" multiple hidden>


          <textarea id="jtInput" style="color:#6256AC" rows="1" placeholder="Tulis pesan anda"></textarea>


          <!-- PAPERCLIP -->
          <button class="btn jt-icon jt-btn-clip"><i class="bi bi-paperclip" style="color:#6256AC"></i></button>
          <button id="jtSend" class="btn jt-btn-send"><i class="bi bi-send-fill"></i></button>
        </div>


        <!-- MENU PAPERCLIP -->
        <div id="jtClipMenu" class="jt-clip-menu">
          <button type="button" class="jt-clip-item" data-action="gallery">
            <i class="bi bi-image"></i> <span>Photos & videos</span>
          </button>
          <button type="button" class="jt-clip-item" data-action="camera">
            <i class="bi bi-camera"></i> <span>Camera</span>
          </button>
          <div class="jt-clip-sep"></div>
          <button type="button" class="jt-clip-item" data-action="document">
            <i class="bi bi-file-earmark-text"></i> <span>Document</span>
          </button>
          <button type="button" class="jt-clip-item" data-action="contact">
            <i class="bi bi-person"></i> <span>Contact</span>
          </button>
        </div>


        <!-- input tersembunyi untuk menu -->
        <input id="jtPickGallery" type="file" accept="image/*,video/*" multiple hidden>
        <input id="jtPickCamera"  type="file" accept="image/*" capture="environment" hidden>
        <input id="jtPickDoc"     type="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt" hidden>
        <input id="jtPickVcf"     type="file" accept=".vcf" hidden>


        <div id="jtPreview" class="jt-preview"></div>
      </div>
    </section>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
/* ---------- State ---------- */
let ROOMS = [];
let CURRENT = null;
let ME = { is_mentor:false, user_id:null, mentor_id:null };
let SELECTED_FILE = null;


const $list   = document.getElementById('jtChatList');
const $body   = document.getElementById('jtRoomBody');
const $name   = document.getElementById('jtRoomName');
const $ava    = document.getElementById('jtRoomAvatar');
const $badge  = document.querySelector('.jt-badge');
const $search = document.getElementById('jtSearchInput');


const $input   = document.getElementById('jtInput');
const $send    = document.getElementById('jtSend');
const $file    = document.getElementById('jtFile');
const $preview = document.getElementById('jtPreview');


const $clipBtn  = document.querySelector('.jt-btn-clip');
const $clipMenu = document.getElementById('jtClipMenu');
const $pickGallery = document.getElementById('jtPickGallery');
const $pickCamera  = document.getElementById('jtPickCamera');
const $pickDoc     = document.getElementById('jtPickDoc');
const $pickVcf     = document.getElementById('jtPickVcf');


const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


/* ---------- Util ---------- */
const clock = () => new Date().toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'});
const esc   = s => s?.replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));


/* ---------- Fetch rooms & hydrate UI ---------- */
async function loadRooms(){
  try{
    const res  = await fetch(`{{ route('chat.rooms') }}`);
    const data = await res.json();
    ROOMS   = data.rooms || [];
    ME      = data.me || ME;
    CURRENT = null;                     // tidak auto-open
    $badge.textContent = data.unread_total || 0;
    renderList();
    renderCurrent();
  }catch(e){ console.error('loadRooms failed', e); }
}


function renderList(filter='all', q=''){
  $list.innerHTML = '';
  (ROOMS||[])
    .filter(r => filter==='all' ? true : filter==='unread' ? (r.unread||0)>0 : !!r.pinned)
    .filter(r => r.name.toLowerCase().includes((q||'').toLowerCase()))
    .forEach(r=>{
      const it = document.createElement('div');
      it.className = 'jt-item' + (CURRENT && r.id===CURRENT.id ? ' active' : '');
      it.dataset.id = r.id;
      it.innerHTML = `
        <div class="avatar"><img src="${r.avatar}" alt=""></div>
        <div class="meta">
          <div class="d-flex justify-content-between">
            <h6 class="name">${r.name}</h6>
            <small class="time">${r.time || ''}</small>
          </div>
          <div class="snippet">${esc(r.last || '')}</div>
        </div>
        <div class="flag">
          ${(r.unread||0)>0 ? '<span class="jt-dot-red"></span>' : '<i class="bi bi-check2-all jt-check"></i>'}
        </div>`;
      it.addEventListener('click', ()=>openRoom(r.id));
      $list.appendChild(it);
    });
}


function renderCurrent(){
  if (!CURRENT){
    $name.textContent = '—';
    $ava.src = 'https://i.pravatar.cc/100?img=12';
    $body.innerHTML = '<div class="jt-day-sep">Pilih chat di sebelah kiri</div>';
    return;
  }
  $name.textContent = CURRENT.name;
  $ava.src = CURRENT.avatar;
  renderMessages();
  markRead(CURRENT.id);
}


function renderMessages(){
  $body.innerHTML = '<div class="jt-day-sep">Hari ini</div>';
  (CURRENT.messages||[]).forEach(m=>appendMsg(m.side,m.type,m.text,m.src,m.time,false));
  $body.scrollTop = $body.scrollHeight;
}


function openRoom(roomId){
  const found = ROOMS.find(r=>r.id===roomId);
  if(!found) return;
  CURRENT = found;
  document.querySelectorAll('.jt-item').forEach(x=>x.classList.remove('active'));
  document.querySelector(`.jt-item[data-id="${roomId}"]`)?.classList.add('active');
  renderCurrent();
}


function appendMsg(side='right', type='text', text='', src='', time='', animate=true){
  const wrap = document.createElement('div');
  wrap.className = 'jt-msg ' + side;
  let html = '';
  if (type === 'image'){
    html = `<div class="jt-bubble"><div class="jt-img"><img src="${src}" alt=""></div><span class="jt-time">${time||clock()}</span></div>`;
  } else {
    html = `<div class="jt-bubble">${esc(text)}<span class="jt-time">${time||clock()}${side==='right'?' <i class="bi bi-check2-all jt-read"></i>':''}</span></div>`;
  }
  wrap.innerHTML = html;
  if (animate) wrap.style.opacity = 0;
  $body.appendChild(wrap);
  if (animate) setTimeout(()=>wrap.style.opacity=1,15);
  $body.scrollTop = $body.scrollHeight;
}


/* ---------- Send message ---------- */
$input?.addEventListener('input', ()=>{
  $input.style.height='auto';
  $input.style.height=Math.min($input.scrollHeight,120)+'px';
});
$input?.addEventListener('keydown', e=>{
  if(e.key==='Enter' && !e.shiftKey){ e.preventDefault(); sendMessage(); }
});
$send?.addEventListener('click', sendMessage);


async function sendMessage(){
  if (!CURRENT) return;
  const txt  = ($input.value || '').trim();
  const file = SELECTED_FILE; // dari menu paperclip/attach
  if (!txt && !file) return;


  const [toType, toIdStr] = CURRENT.id.split(':');


  const form = new FormData();
  form.append('to_type', toType);
  form.append('to_id', toIdStr);
  if (txt)  form.append('message', txt);
  if (file) form.append('media', file);


  try{
    const res  = await fetch(`{{ route('chat.send') }}`, { method:'POST', headers:{'X-CSRF-TOKEN': CSRF}, body:form });
    const data = await res.json();
    if (!data?.ok){ console.error('send failed', data); return; }
    CURRENT.messages = CURRENT.messages || [];
    CURRENT.messages.push(data.message);
    appendMsg(data.message.side, data.message.type, data.message.text, data.message.src, data.message.time);
    // reset input
    $input.value=''; $input.style.height='auto';
    [$file,$pickGallery,$pickCamera,$pickDoc,$pickVcf].forEach(i=>i.value='');
    $preview.innerHTML=''; SELECTED_FILE=null;
  }catch(e){ console.error('send error', e); }
}


/* ---------- Mark as read ---------- */
async function markRead(roomId){
  if (!roomId) return;
  try{
    await fetch(`{{ route('chat.markRead') }}`, {
      method: 'POST',
      headers: {'Content-Type':'application/json','X-CSRF-TOKEN': CSRF},
      body: JSON.stringify({ room_id: roomId })
    });
    loadRooms();
  }catch(e){ console.error('markRead error', e); }
}


/* ---------- Attach kiri (grid) ---------- */
document.querySelector('.jt-btn-attach')?.addEventListener('click', ()=> $file.click());
$file?.addEventListener('change', e=>{
  $preview.innerHTML='';
  const f = e.target.files?.[0]; if(!f) return;
  SELECTED_FILE = f;
  const r = new FileReader();
  r.onload = ()=>{
    const box = document.createElement('div');
    box.className='jt-previmg';
    box.innerHTML=`<img src="${r.result}">`;
    $preview.appendChild(box);
  };
  r.readAsDataURL(f);
});


// ---------- Clip menu (paperclip) ----------
function placeClipMenu() {
  // tampilkan sementara untuk dapatkan ukuran
  $clipMenu.style.visibility = 'hidden';
  $clipMenu.style.display = 'block';


  const br = $clipBtn.getBoundingClientRect();
  const mw = $clipMenu.offsetWidth;
  const mh = $clipMenu.offsetHeight;


  // posisi: di atas tombol, rata kanan tombol
  let left = Math.round(br.right - mw);
  let top  = Math.round(br.top  - mh - 10);


  // kalau kepentok kiri/atas, geser dikit
  left = Math.max(8, left);
  top  = Math.max(8, top);


  $clipMenu.style.left = left + 'px';
  $clipMenu.style.top  = top  + 'px';


  $clipMenu.style.visibility = 'visible';
}


function openClipMenu() {
  placeClipMenu();
  $clipMenu.classList.add('show');
}


function closeClipMenu() {
  $clipMenu.classList.remove('show');
  $clipMenu.style.display = 'none';
}


$clipBtn?.addEventListener('click', (e)=>{
  e.stopPropagation();
  if ($clipMenu.classList.contains('show')) {
    closeClipMenu();
  } else {
    openClipMenu();
  }
});


// tutup saat klik di luar / resize / scroll
document.addEventListener('click', (e)=>{
  if (!$clipMenu.classList.contains('show')) return;
  if (e.target.closest('.jt-clip-item') || e.target.closest('.jt-btn-clip')) return;
  closeClipMenu();
});
window.addEventListener('resize', ()=>{ if ($clipMenu.classList.contains('show')) openClipMenu(); });
window.addEventListener('scroll', ()=>{ if ($clipMenu.classList.contains('show')) openClipMenu(); });


// klik item menu
$clipMenu?.addEventListener('click', (e)=>{
  const btn = e.target.closest('.jt-clip-item');
  if(!btn) return;
  const act = btn.dataset.action;
  closeClipMenu();
  if(act === 'gallery') return $pickGallery.click();
  if(act === 'camera')  return $pickCamera.click();
  if(act === 'document')return $pickDoc.click();
  if(act === 'contact') return $pickVcf.click();
});


/* ---- Preview & pilih file dari menu ---- */
function addDocChip(name){
  const chip = document.createElement('div');
  chip.className = 'jt-prevdoc';
  chip.textContent = name;
  $preview.innerHTML='';
  $preview.appendChild(chip);
}
[$pickGallery, $pickCamera].forEach(inp=>{
  inp?.addEventListener('change', e=>{
    $preview.innerHTML='';
    const f = e.target.files?.[0]; if(!f) return;
    SELECTED_FILE = f;
    const r = new FileReader();
    r.onload = ()=>{
      const box = document.createElement('div');
      box.className='jt-previmg';
      box.innerHTML=`<img src="${r.result}">`;
      $preview.appendChild(box);
    };
    r.readAsDataURL(f);
  });
});
$pickDoc?.addEventListener('change', e=>{
  const f = e.target.files?.[0]; if(!f) return;
  SELECTED_FILE = f;
  addDocChip(f.name);
});
$pickVcf?.addEventListener('change', e=>{
  const f = e.target.files?.[0]; if(!f) return;
  SELECTED_FILE = f;
  addDocChip('Contact: ' + f.name);
});


/* ---------- Filter & search ---------- */
document.querySelectorAll('.jt-filter').forEach(a=>a.addEventListener('click',()=>{
  document.querySelectorAll('.jt-filter').forEach(x=>x.classList.remove('active'));
  a.classList.add('active');
  renderList(a.dataset.filter, $search.value||'');
}));
$search?.addEventListener('input', e=>{
  const act=document.querySelector('.jt-filter.active')?.dataset.filter||'all';
  renderList(act, e.target.value);
});


/* ---------- Init ---------- */
loadRooms();
</script>
</body>
</html>
