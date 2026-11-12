<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Cine CBTis — Demo</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<style>
  :root{
    --bg:#0b0b0d;
    --card:#0f1720;
    --accent:#d72631; /* rojo cine */
    --muted:#98a0a8;
    --glass: rgba(255,255,255,0.03);
    --radius:12px;
  }
  *{box-sizing:border-box}
  body{
    margin:0; font-family:Poppins,system-ui,Arial; background:
    radial-gradient(1200px 400px at 10% 10%, rgba(215,38,49,0.06), transparent 10%),
    linear-gradient(180deg,#071019 0%, #071219 100%);
    color:#eef2f3; min-height:100vh;
    -webkit-font-smoothing:antialiased;
  }

  header{
    display:flex;align-items:center;justify-content:space-between;
    padding:18px 24px;background:linear-gradient(90deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01));
    border-bottom:1px solid rgba(255,255,255,0.03);
    position:sticky;top:0;z-index:50;
  }
  .brand {display:flex;gap:12px;align-items:center}
  .logo{
    width:48px;height:48px;border-radius:10px;
    background:linear-gradient(135deg,var(--accent),#ff5f6d);
    display:flex;align-items:center;justify-content:center;font-weight:700;color:#111;
    box-shadow:0 6px 18px rgba(215,38,49,0.14);
  }
  .brand h1{font-size:1.1rem;margin:0;font-weight:700}
  .nav-actions{display:flex;gap:10px;align-items:center}

  .btn {
    background:var(--accent);color:#fff;border:none;padding:10px 14px;border-radius:10px;
    cursor:pointer;font-weight:600;box-shadow:0 6px 18px rgba(215,38,49,0.12);
  }
  .btn.ghost{background:transparent;border:1px solid rgba(255,255,255,0.06);color:var(--muted);box-shadow:none}
  .btn.secondary{background:#222;border:1px solid rgba(255,255,255,0.03)}

  main{max-width:1100px;margin:28px auto;padding:0 18px}
  .card{background:var(--card);border-radius:14px;padding:20px;margin-bottom:18px;box-shadow:0 8px 30px rgba(0,0,0,0.6)}
  h2{margin:0 0 12px 0;color:#fff}

  /* Steps bar */
  .steps{display:flex;gap:8px;align-items:center;margin-bottom:18px;flex-wrap:wrap}
  .step{padding:8px 12px;border-radius:999px;background:var(--glass);color:var(--muted);font-weight:600}
  .step.active{background:linear-gradient(90deg,var(--accent),#ff7b7b);color:#111}

  /* peliculas */
  .movies{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px}
  .movie{background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);padding:12px;border-radius:12px;cursor:pointer;border:1px solid rgba(255,255,255,0.02)}
  .movie.selected{box-shadow:0 10px 30px rgba(215,38,49,0.14);border-color:rgba(255,255,255,0.06)}
  .movie h3{margin:8px 0;font-size:1rem}
  .times{display:flex;gap:8px;flex-wrap:wrap}

  /* tickets selection */
  .ticket-row{display:flex;gap:12px;flex-wrap:wrap}
  .ticket-input{display:flex;flex-direction:column;gap:6px;background:rgba(255,255,255,0.02);padding:10px;border-radius:10px;width:160px}
  .ticket-input input{width:100%;padding:8px;border-radius:8px;border:none;background:transparent;color:var(--muted);outline:1px solid rgba(255,255,255,0.02)}

  /* asiento grid */
  #seatsGrid{display:grid;grid-template-columns:repeat(10,36px);gap:6px;justify-content:center;padding:12px;background:linear-gradient(180deg,rgba(255,255,255,0.01),transparent);border-radius:10px}
  .seat{width:36px;height:36px;border-radius:6px;border:none;background:#1a2428;cursor:pointer;color:#9aa6ab;font-weight:700;display:flex;align-items:center;justify-content:center}
  .seat.occupied{background:#3b3b3b;color:#777;cursor:not-allowed}
  .seat.selected{background:var(--accent);box-shadow:0 6px 16px rgba(215,38,49,0.18);color:#111}

  .info-line{display:flex;justify-content:space-between;align-items:center;margin-top:10px;color:var(--muted)}

  /* payment */
  .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
  .form-grid .full{grid-column:1/-1}

  /* ticket */
  .ticket-preview{background:linear-gradient(180deg,#0e1112,#071014);padding:18px;border-radius:12px;color:var(--muted)}
  .ticket-preview h3{color:#fff;margin:0 0 8px 0}

  /* responsive */
  @media (max-width:720px){
    #seatsGrid{grid-template-columns:repeat(10,28px)}
    .seat{width:28px;height:28px}
    .form-grid{grid-template-columns:1fr}
  }
</style>
</head>
<body>
<header>
  <div class="brand">
    <div class="logo">CB</div>
    <div>
      <h1>Cine CBTis</h1>
      <div style="font-size:12px;color:var(--muted)">Demo — integración futura con BD</div>
    </div>
  </div>

  <div class="nav-actions">
    <!-- Login buttons (solo botones, el profe los conectará a BD luego) -->
    <button id="btnLogin" class="btn">Iniciar sesión</button>
    <button id="btnLogout" class="btn ghost">Cerrar sesión</button>
  </div>
</header>

<main>
  <!-- Steps -->
  <div id="stepsBar" class="card">
    <div class="steps">
      <div class="step active" data-step="1">1. Película</div>
      <div class="step" data-step="2">2. Horario</div>
      <div class="step" data-step="3">3. Boletos</div>
      <div class="step" data-step="4">4. Asientos</div>
      <div class="step" data-step="5">5. Pago</div>
      <div class="step" data-step="6">6. Ticket</div>
    </div>
  </div>

  <!-- Section: peliculas -->
  <section id="page-movies" class="card">
    <h2>Elige la película</h2>
    <div class="movies" id="moviesList">
      <!-- JS render -->
    </div>
    <div style="margin-top:14px;display:flex;gap:10px;justify-content:flex-end">
      <button class="btn secondary" id="toTimesBtn">Siguiente →</button>
    </div>
  </section>

  <!-- Section: horarios -->
  <section id="page-times" class="card" style="display:none">
    <h2>Selecciona el horario</h2>
    <div id="timesArea" class="card" style="padding:12px"></div>
    <div style="margin-top:14px;display:flex;gap:10px;justify-content:space-between">
      <button class="btn ghost" id="backToMovies">← Películas</button>
      <button class="btn" id="toTicketsBtn">Siguiente →</button>
    </div>
  </section>

  <!-- Section: boletos -->
  <section id="page-tickets" class="card" style="display:none">
    <h2>Selecciona tus boletos</h2>
    <div class="ticket-row">
      <div class="ticket-input">
        <label style="font-weight:700">Niños</label>
        <input id="kids" type="number" min="0" value="0">
      </div>
      <div class="ticket-input">
        <label style="font-weight:700">Adultos</label>
        <input id="adults" type="number" min="0" value="1">
      </div>
      <div class="ticket-input">
        <label style="font-weight:700">Mayores</label>
        <input id="seniors" type="number" min="0" value="0">
      </div>
      <div style="display:flex;flex-direction:column;justify-content:center">
        <div style="font-weight:700">Total</div>
        <div id="totalTickets" style="font-size:20px;color:var(--accent)">1</div>
      </div>
    </div>

    <div class="info-line">
      <small class="muted">* Ajusta la cantidad total de boletos antes de seleccionar asientos.</small>
      <div>
        <button class="btn ghost" id="backToTimes">← Horarios</button>
        <button class="btn" id="toSeatsBtn">Ir a seleccionar asientos →</button>
      </div>
    </div>
  </section>

  <!-- Section: asientos -->
  <section id="page-seats" class="card" style="display:none">
    <h2>Elige tus asientos (10 x 10)</h2>
    <div style="display:flex;justify-content:center;margin-bottom:10px;gap:10px">
      <div><span style="display:inline-block;width:14px;height:14px;background:#1a2428;border-radius:3px;margin-right:6px"></span> Libre</div>
      <div><span style="display:inline-block;width:14px;height:14px;background:var(--accent);border-radius:3px;margin-right:6px"></span> Seleccionado</div>
      <div><span style="display:inline-block;width:14px;height:14px;background:#3b3b3b;border-radius:3px;margin-right:6px"></span> Ocupado</div>
    </div>

    <div id="seatsGrid"></div>
    <div class="info-line">
      <div id="seatInfo">Asientos seleccionados 0 / 0</div>
      <div>
        <button class="btn ghost" id="backToTickets">← Boletos</button>
        <button class="btn" id="toPaymentBtn">Continuar a Pago →</button>
      </div>
    </div>
  </section>

  <!-- Section: pago -->
  <section id="page-payment" class="card" style="display:none">
    <h2>Pago (simulado)</h2>
    <div class="ticket-preview">
      <h3>Resumen</h3>
      <div id="summaryText" style="color:var(--muted)"></div>
    </div>

    <div style="height:12px"></div>
    <form id="paymentForm" onsubmit="return false;">
      <div class="form-grid">
        <div class="full">
          <label style="font-weight:700;color:var(--muted)">Nombre en la tarjeta</label>
          <input id="cardName" placeholder="Nombre completo">
        </div>
        <div>
          <label style="font-weight:700;color:var(--muted)">Número de tarjeta</label>
          <input id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" >
        </div>
        <div>
          <label style="font-weight:700;color:var(--muted)">Fecha (MM/AA)</label>
          <input id="cardDate" placeholder="MM/AA" maxlength="5">
        </div>
        <div>
          <label style="font-weight:700;color:var(--muted)">CVV</label>
          <input id="cardCVV" placeholder="123" maxlength="4">
        </div>
        <div class="full" style="display:flex;gap:10px;justify-content:flex-end">
          <button class="btn ghost" id="backToSeats">← Asientos</button>
          <button class="btn" id="payBtn">Pagar</button>
        </div>
      </div>
    </form>
    <div id="paymentMsg" style="margin-top:12px;color:var(--muted)"></div>
  </section>

  <!-- Section: ticket -->
  <section id="page-ticket" class="card" style="display:none">
    <h2>Tu ticket</h2>
    <div class="ticket-preview" id="ticketArea">
      <!-- JS genera ticket -->
    </div>
    <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:12px">
      <button class="btn ghost" id="startOver">Nueva compra</button>
      <button class="btn" id="printTicket">Imprimir / Guardar</button>
    </div>
  </section>

</main>

<script>
/* ===== Datos de ejemplo (películas + horarios) ===== */
const moviesData = [
  { id: 'sw', title: 'Star Wars: Rise', duration: '2h 15m', img: '', times: ['16:00', '19:00'] },
  { id: 'av', title: 'Avengers: Unity', duration: '2h 30m', img: '', times: ['15:30', '20:00'] },
  { id: 'to', title: 'Toy Story: Return', duration: '1h 35m', img: '', times: ['13:00', '17:00'] },
  { id: 'du', title: 'Dune: Sands', duration: '2h 10m', img: '', times: ['18:00', '21:00'] }
];

/* ===== Estado en sessionStorage (para simular navegación) ===== */
const state = {
  movie: null,
  time: null,
  tickets: { kids:0, adults:1, seniors:0 },
  selectedSeats: [],
  user: { logged: false }
};

function saveState(){ sessionStorage.setItem('cinestate', JSON.stringify(state)); }
function loadState(){ 
  const s = sessionStorage.getItem('cinestate');
  if(s){ Object.assign(state, JSON.parse(s)); }
}

/* ===== UI elementos ===== */
const steps = document.querySelectorAll('.step');
function setStep(n){
  steps.forEach(s=> s.classList.toggle('active', +s.dataset.step === n));
}

/* ===== Login buttons ===== */
const btnLogin = document.getElementById('btnLogin');
const btnLogout = document.getElementById('btnLogout');
btnLogin.addEventListener('click', ()=>{
  state.user.logged = true;
  saveState();
  alert('Sesión iniciada (simulación). El profe conectará a BD más adelante.');
  btnLogin.style.display='none'; btnLogout.style.display='inline-block';
});
btnLogout.addEventListener('click', ()=>{
  state.user.logged = false;
  saveState();
  alert('Sesión cerrada (simulación).');
  btnLogin.style.display='inline-block'; btnLogout.style.display='none';
});
/* init login btns */
loadState();
if(state.user.logged){ btnLogin.style.display='none'; btnLogout.style.display='inline-block'; } else { btnLogout.style.display='none'; }

/* ===== Render peliculas ===== */
const moviesList = document.getElementById('moviesList');
moviesData.forEach(m=>{
  const div = document.createElement('div');
  div.className = 'movie';
  div.dataset.movie = m.id;
  div.innerHTML = `<h3>${m.title}</h3><div style="color:var(--muted)">Duración: ${m.duration}</div>
                   <div style="margin-top:8px" class="times">${m.times.map(t=>`<button class="btn ghost time-btn" data-m="${m.id}" data-time="${t}">${t}</button>`).join('')}</div>`;
  div.addEventListener('click', ()=>{
    // seleccionar movie visual y guardar
    document.querySelectorAll('.movie').forEach(x=>x.classList.remove('selected'));
    div.classList.add('selected');
    state.movie = m.id;
    saveState();
  });
  moviesList.appendChild(div);
});

/* Buttons navigation */
document.getElementById('toTimesBtn').addEventListener('click', ()=>{
  if(!state.movie){ alert('Selecciona primero una película.'); return; }
  showPage('page-times'); setStep(2); renderTimes();
});
document.getElementById('backToMovies').addEventListener('click', ()=>{ showPage('page-movies'); setStep(1); });

/* Render horarios */
const timesArea = document.getElementById('timesArea');
function renderTimes(){
  timesArea.innerHTML = '';
  const m = moviesData.find(x=>x.id === state.movie);
  m.times.forEach(t=>{
    const b = document.createElement('button');
    b.className='btn ghost'; b.textContent = t; b.style.marginRight='10px';
    b.addEventListener('click', ()=>{
      state.time = t; saveState();
      alert(`Horario ${t} seleccionado para ${m.title}`);
      showPage('page-tickets'); setStep(3); renderTickets();
    });
    timesArea.appendChild(b);
  });
}
document.getElementById('toTicketsBtn').addEventListener('click', ()=>{
  if(!state.time){ alert('Selecciona un horario (usa los botones).'); return; }
  showPage('page-tickets'); setStep(3); renderTickets();
});

/* Tickets page */
const kidsInput = document.getElementById('kids');
const adultsInput = document.getElementById('adults');
const seniorsInput = document.getElementById('seniors');
const totalTicketsEl = document.getElementById('totalTickets');

function renderTickets(){
  // cargar desde state
  kidsInput.value = state.tickets.kids || 0;
  adultsInput.value = state.tickets.adults || 1;
  seniorsInput.value = state.tickets.seniors || 0;
  updateTotal();
}
function updateTotal(){
  const k = Math.max(0, parseInt(kidsInput.value)||0);
  const a = Math.max(0, parseInt(adultsInput.value)||0);
  const s = Math.max(0, parseInt(seniorsInput.value)||0);
  state.tickets = { kids:k, adults:a, seniors:s };
  const total = k+a+s;
  totalTicketsEl.textContent = total;
  saveState();
}
kidsInput.addEventListener('input', updateTotal);
adultsInput.addEventListener('input', updateTotal);
seniorsInput.addEventListener('input', updateTotal);

document.getElementById('backToTimes').addEventListener('click', ()=>{ showPage('page-times'); setStep(2); });
document.getElementById('toSeatsBtn').addEventListener('click', ()=>{
  const total = state.tickets.kids + state.tickets.adults + state.tickets.seniors;
  if(total <= 0){ alert('Selecciona al menos un boleto.'); return; }
  state.selectedSeats = []; saveState();
  showPage('page-seats'); setStep(4); renderSeats();
});

/* Seats grid */
const seatsGrid = document.getElementById('seatsGrid');
const seatInfo = document.getElementById('seatInfo');
let seatCountLimit = 0;

function renderSeats(){
  seatsGrid.innerHTML = '';
  const total = state.tickets.kids + state.tickets.adults + state.tickets.seniors;
  seatCountLimit = total;
  seatInfo.textContent = `Asientos seleccionados 0 / ${seatCountLimit}`;
  // Simular ocupados aleatorios (para demo)
  const occupiedSet = new Set();
  // create a few occupied seats randomly
  while(occupiedSet.size < 12){ occupiedSet.add(Math.floor(Math.random()*100)+1); }
  for(let i=1;i<=100;i++){
    const btn = document.createElement('button');
    btn.className = 'seat';
    btn.textContent = i;
    if(occupiedSet.has(i)){ btn.classList.add('occupied'); }
    btn.addEventListener('click', ()=>{
      if(btn.classList.contains('occupied')) return;
      const already = btn.classList.contains('selected');
      const selectedNow = document.querySelectorAll('.seat.selected').length;
      if(!already && selectedNow >= seatCountLimit){
        alert(`Solo puedes seleccionar ${seatCountLimit} asientos (la cantidad de boletos).`);
        return;
      }
      btn.classList.toggle('selected');
      updateSelectedSeats();
    });
    seatsGrid.appendChild(btn);
  }
  // if state has saved selections (same session) re-select them
  if(state.selectedSeats && state.selectedSeats.length){
    document.querySelectorAll('.seat').forEach(button=>{
      const num = parseInt(button.textContent);
      if(state.selectedSeats.includes(num) && !button.classList.contains('occupied')){
        button.classList.add('selected');
      }
    });
    updateSelectedSeats();
  }
}
function updateSelectedSeats(){
  const sel = Array.from(document.querySelectorAll('.seat.selected')).map(b=>parseInt(b.textContent));
  state.selectedSeats = sel;
  saveState();
  seatInfo.textContent = `Asientos seleccionados ${sel.length} / ${seatCountLimit}`;
}
document.getElementById('backToTickets').addEventListener('click', ()=>{ showPage('page-tickets'); setStep(3); });

document.getElementById('toPaymentBtn').addEventListener('click', ()=>{
  if(state.selectedSeats.length !== seatCountLimit){
    alert(`Debes seleccionar exactamente ${seatCountLimit} asientos. Actualmente: ${state.selectedSeats.length}`);
    return;
  }
  showPage('page-payment'); setStep(5); renderSummary();
});

/* Payment */
const summaryText = document.getElementById('summaryText');
function renderSummary(){
  const movieName = moviesData.find(m=>m.id===state.movie).title;
  summaryText.innerHTML = `
    <div style="color:var(--muted)">Película: <strong style="color:#fff">${movieName}</strong></div>
    <div style="color:var(--muted)">Horario: <strong style="color:#fff">${state.time}</strong></div>
    <div style="color:var(--muted)">Boletos: <strong style="color:#fff">${state.tickets.kids} niños, ${state.tickets.adults} adultos, ${state.tickets.seniors} mayores</strong></div>
    <div style="color:var(--muted)">Asientos: <strong style="color:#fff">${state.selectedSeats.join(', ')}</strong></div>
  `;
}
document.getElementById('backToSeats').addEventListener('click', ()=>{ showPage('page-seats'); setStep(4); });

document.getElementById('payBtn').addEventListener('click', ()=>{
  // Validación mínima
  const name = document.getElementById('cardName').value.trim();
  const num = (document.getElementById('cardNumber').value || '').replace(/\s/g,'');
  const date = document.getElementById('cardDate').value.trim();
  const cvv = document.getElementById('cardCVV').value.trim();

  if(!name || num.length < 12 || !/^\d{2}\/\d{2}$/.test(date) || (cvv.length<3)){
    document.getElementById('paymentMsg').textContent = 'Datos de tarjeta inválidos. Verifica y vuelve a intentar.';
    return;
  }
  // Simular procesamiento...
  document.getElementById('paymentMsg').textContent = 'Procesando pago...';
  document.getElementById('payBtn').disabled = true;
  setTimeout(()=>{
    document.getElementById('paymentMsg').textContent = 'Pago aprobado ✅';
    // proceder a ticket
    showTicket();
    document.getElementById('payBtn').disabled = false;
  },1200);
});

/* Generar ticket */
function showTicket(){
  saveState();
  const tArea = document.getElementById('ticketArea');
  const movie = moviesData.find(m=>m.id===state.movie);
  const totalCount = state.tickets.kids + state.tickets.adults + state.tickets.seniors;
  const priceKid = 50, priceAdult = 80, priceSenior = 60; // ejemplo
  const subtotal = state.tickets.kids*priceKid + state.tickets.adults*priceAdult + state.tickets.seniors*priceSenior;
  const tax = Math.round(subtotal * 0.16);
  const total = subtotal + tax;

  const now = new Date();
  const ticketHTML = `
    <div style="display:flex;justify-content:space-between;align-items:center">
      <div>
        <h3>CINE CBTIS — TICKET</h3>
        <div style="color:var(--muted)">Folio: <strong>${Math.floor(Math.random()*900000+100000)}</strong></div>
      </div>
      <div style="text-align:right;color:var(--muted)">${now.toLocaleString()}</div>
    </div>
    <hr style="border:none;border-top:1px dashed rgba(255,255,255,0.06);margin:12px 0">
    <div style="color:var(--muted)">Pelicula: <strong style="color:#fff">${movie.title}</strong></div>
    <div style="color:var(--muted)">Horario: <strong style="color:#fff">${state.time}</strong></div>
    <div style="color:var(--muted)">Boletos: <strong style="color:#fff">${totalCount} (N:${state.tickets.kids} A:${state.tickets.adults} M:${state.tickets.seniors})</strong></div>
    <div style="color:var(--muted)">Asientos: <strong style="color:#fff">${state.selectedSeats.join(', ')}</strong></div>
    <hr style="border:none;border-top:1px dashed rgba(255,255,255,0.06);margin:12px 0">
    <div style="display:flex;justify-content:space-between;color:var(--muted)"><div>Subtotal</div><div>$ ${subtotal}</div></div>
    <div style="display:flex;justify-content:space-between;color:var(--muted)"><div>IVA (16%)</div><div>$ ${tax}</div></div>
    <div style="display:flex;justify-content:space-between;color:#fff;font-weight:700;font-size:1.1rem;margin-top:8px"><div>Total</div><div>$ ${total}</div></div>
    <div style="margin-top:12px;color:var(--muted)">Gracias por tu compra. Presenta este ticket en taquilla.</div>
  `;
  tArea.innerHTML = ticketHTML;
  showPage('page-ticket'); setStep(6);
}

/* Print */
document.getElementById('printTicket').addEventListener('click', ()=>{
  window.print();
});

/* Start new */
document.getElementById('startOver').addEventListener('click', ()=>{
  sessionStorage.removeItem('cinestate');
  location.reload();
});

/* Helper: show/hide sections */
function showPage(id){
  document.querySelectorAll('main section').forEach(s=> s.style.display='none');
  document.getElementById(id).style.display='block';
  window.scrollTo({top:0,behavior:'smooth'});
}

/* init */
loadState();
// If returning with state, go to appropriate step
if(state.movie && state.time && state.selectedSeats && state.selectedSeats.length){
  renderSummary();
  renderSeats();
  showPage('page-payment'); setStep(5);
} else if(state.movie && state.time){
  showPage('page-tickets'); setStep(3); renderTickets();
} else if(state.movie){
  showPage('page-times'); setStep(2); renderTimes();
} else {
  showPage('page-movies'); setStep(1);
}

/* small UX: format card number input */
document.getElementById('cardNumber').addEventListener('input',(e)=>{
  e.target.value = e.target.value.replace(/\D/g,'').replace(/(.{4})/g,'$1 ').trim();
});
document.getElementById('cardDate').addEventListener('input',(e)=>{
  e.target.value = e.target.value.replace(/\D/g,'').replace(/(.{2})/g,'$1/').slice(0,5);
});

</script>
</body>
</html>
