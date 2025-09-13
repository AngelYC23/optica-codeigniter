

// Mantengo los mismos IDs que tenías para que la funcionalidad sea idéntica
document.addEventListener('DOMContentLoaded', function() {
  const menuBtn = document.getElementById('menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  if (menuBtn && mobileMenu) {
    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }
});



document.addEventListener("DOMContentLoaded", () => {
  const whatsappBtn = document.querySelector(".whatsapp-btn");
  if (whatsappBtn) {
    whatsappBtn.addEventListener("click", (e) => {
      e.preventDefault(); // Evita que se abra la pestaña de inmediato
      console.log("Botón WhatsApp clickeado");

      // Registrar evento en Analytics
      gtag('event', 'click_whatsapp', {
        'event_category': 'engagement',
        'event_label': 'Botón WhatsApp'
      });

      // Abrir WhatsApp después de 100 ms (tiempo suficiente para que GA lo registre)
      setTimeout(() => {
        window.open("https://wa.me/50232394308", "_blank");
      }, 100);
    });
  }
});


// Evento: medir cuánto tiempo estuvo el usuario en la página (30s)
setTimeout(() => {
  gtag('event', '30_seconds', {
    'event_category': 'engagement',
    'event_label': 'Usuario estuvo 30s en la página'
  });
}, 30000); // 30 segundos


function toggleSidebar() {
  document.getElementById('sidebar').classList.toggle('open');
}


