function openWhatsApp(msg){
  const phone = "5522981412411"; // Seu número WhatsApp
  const text = encodeURIComponent(msg || "Olá! Tenho interesse em uma conta de RuneScape.");
  window.open(`https://wa.me/${phone}?text=${text}`, "_blank");
}
function searchItems() {
  const text = document.getElementById("searchInput").value.toLowerCase();
  const cards = document.querySelectorAll(".card");

  cards.forEach(card => {
    const title = card.querySelector("h3").innerText.toLowerCase();
    const desc = card.querySelector("p").innerText.toLowerCase();

    if (title.includes(text) || desc.includes(text)) {
      card.style.display = "block";
    } else {
      card.style.display = "none";
    }
  });
}
function searchItems() {
  const text = document.getElementById("searchInput").value.toLowerCase();
  const cards = document.querySelectorAll(".card");

  cards.forEach(card => {
    const title = card.querySelector("h3").innerText.toLowerCase();
    const desc = card.querySelector("p").innerText.toLowerCase();

    if (title.includes(text) || desc.includes(text)) {
      card.style.display = "block";
    } else {
      card.style.display = "none";
    }
  });
}
