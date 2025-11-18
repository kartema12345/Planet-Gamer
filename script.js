// site scripts

function openWhatsApp(msg){
  const phone = '5522981412411'; // seu número
  const text = encodeURIComponent(msg || 'Olá! Tenho interesse.');
  window.open(`https://wa.me/${phone}?text=${text}`, '_blank');
}

// ------------ Search page logic ------------
// sample product data (could be fetched from server)
const PRODUCTS = [
  {
    id: 'acct-001',
    title: 'RS3 – Main 2600+',
    desc: 'Attack 99 / Strength 99 / Magic 92 — ótima para PvM.',
    price: 350,
    img: 'https://i.imgur.com/FvK5BCE.png',
    tags: ['rs3','main','2600','pvm']
  },
  {
    id: 'acct-002',
    title: 'RS3 – Skiller Farming 120',
    desc: 'Farming 120 / Herblore 99 / Agility 99 — ideal para money-making.',
    price: 450,
    img: 'https://i.imgur.com/17K4p7P.png',
    tags: ['rs3','skiller','farming','120']
  },
  {
    id: 'acct-003',
    title: 'RS3 – Ironman Endgame',
    desc: 'Ironman com prifddinas desbloqueada e quests completas.',
    price: 600,
    img: 'https://i.imgur.com/cps5Fvu.png',
    tags: ['rs3','ironman','endgame','prifddinas']
  }
];

// render search results into #results
function runSearch(q){
  const out = document.getElementById('results');
  if(!out) return;
  const term = (q || '').toLowerCase().trim();
  out.innerHTML = '';
  const filtered = PRODUCTS.filter(p => {
    if(!term) return true;
    if(p.title.toLowerCase().includes(term)) return true;
    if(p.desc.toLowerCase().includes(term)) return true;
    if(p.tags.join(' ').includes(term)) return true;
    return false;
  });
  if(filtered.length === 0){
    out.innerHTML = '<p class="muted">Nenhum resultado encontrado para <strong>'+escapeHtml(term)+'</strong>.</p>';
    return;
  }
  filtered.forEach(p => {
    const card = document.createElement('div');
    card.className = 'card';
    card.innerHTML = `
      <img src="${p.img}" alt="${escapeHtml(p.title)}">
      <h3>${escapeHtml(p.title)}</h3>
      <p>${escapeHtml(p.desc)}</p>
      <div class="meta">
        <span class="price">R$ ${p.price}</span>
        <button class="btn" onclick="openWhatsApp('Tenho interesse: ${escapeJs(p.title)}')">Comprar</button>
      </div>
    `;
    out.appendChild(card);
  });
}

// small helpers
function escapeHtml(s){ return String(s).replace(/[&<>'"]/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','\'':'&#39;','"':'&quot;'})[c] ); }
function escapeJs(s){ return String(s).replace(/"/g, '\"').replace(/'/g, "\'"); }

// also support client-side quick filter on index page cards
document.addEventListener('DOMContentLoaded', ()=>{
  const idxInput = document.getElementById('searchInput');
  if(idxInput && window.location.pathname.endsWith('index.html') || (idxInput && window.location.pathname === '/')){
    idxInput.addEventListener('input', e=>{
      const q = e.target.value.toLowerCase().trim();
      document.querySelectorAll('.card-grid .card').forEach(card=>{
        const title = card.querySelector('h3').innerText.toLowerCase();
        const desc = card.querySelector('p').innerText.toLowerCase();
        const tags = card.dataset.tags || '';
        const match = !q || title.includes(q) || desc.includes(q) || tags.includes(q);
        card.style.display = match ? 'flex' : 'none';
      });
    });
  }

  // if on search page and there's a q parameter, run runSearch
  const params = new URLSearchParams(window.location.search);
  const q = params.get('q');
  if(q && typeof runSearch === 'function'){
    // ensure results container exists after DOM ready
    setTimeout(()=> runSearch(q), 50);
  }
});
