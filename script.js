function openWhatsApp(msg){
  const phone = "5522981412411"; // Seu número WhatsApp
  const text = encodeURIComponent(msg || "Olá! Tenho interesse em uma conta de RuneScape.");
  window.open(`https://wa.me/${phone}?text=${text}`, "_blank");
}
