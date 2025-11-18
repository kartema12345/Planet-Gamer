// mobile nav toggle
document.getElementById('navToggle')?.addEventListener('click', ()=>{
  const nav = document.querySelector('.nav');
  if(!nav) return;
  nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
});

// open whatsapp with prefilled message
function openWhatsApp(msg){
  const phone = '5522981412411'; // seu número atualizado
  const text = encodeURIComponent(msg || 'Olá, quero mais informações');
  window.open(`https://wa.me/${phone}?text=${text}`, '_blank');
}
