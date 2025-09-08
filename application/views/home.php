<!-- Inicio -->
<section class="section text-center" >
  <h2 class="hero-title"><span class="v2">ÓPTICA</span> VISIÓN CLARA</h2>
  <p class="hero-sub">Tu mejor opción para cuidar y mejorar tu visión con estilo y calidad.</p>

  <video class="hero-video" autoplay muted loop playsinline>
    <source src="<?= base_url('assets/videos/video.mp4') ?>" type="video/mp4">Tu navegador no soporta la etiqueta de video.
  </video>
</section>

<!-- Servicios -->
<section class="section services-section" id="servicios">
  <h2 class="section-title">Servicios que Ofrecemos</h2>
  <div class="services-grid">
    <div class="service-card">
      <i class="fas fa-eye fa-3x service-icon"></i>
      <h3>Exámenes de la Vista</h3>
      <p>Evaluaciones completas para detectar y corregir problemas visuales.</p>
    </div>

    <div class="service-card">
      <i class="fas fa-glasses fa-3x service-icon"></i>
      <h3>Adaptación de Gafas</h3>
      <p>Asesoría personalizada para elegir y ajustar tus gafas ideales.</p>
    </div>

    <div class="service-card">
      <i class="fas fa-tools fa-3x service-icon"></i>
      <h3>Reparación y Mantenimiento</h3>
      <p>Servicio rápido para mantener tus gafas en perfecto estado.</p>
    </div>
  </div>
</section>

<!-- Nosotros -->
<section class="section about-section" id="nosotros">
  <h2 class="section-title">Sobre Nosotros</h2>
  <div class="about-inner">
    <img alt="Equipo de ópticos profesionales sonrientes en óptica moderna con gafas y uniformes azules"
      class="about-img"
      src="<?= base_url('assets/img/ABOUT1.webp') ?>"  />
    <div class="about-text">
      <p >En Óptica Visión Clara contamos con más de 15 años de experiencia brindando atención personalizada y
        productos de alta calidad para cuidar la salud visual de toda la familia. Nuestro equipo de profesionales
        está comprometido con tu bienestar y estilo.</p>
      <p class="mt">Visítanos y descubre la diferencia de un servicio cercano, confiable y con las últimas
        tendencias en gafas y lentes de contacto.</p>
    </div>
  </div>
</section>

<!-- Ubicación -->
<section id="ubicacion" class="section">
  <div class="container mx-auto px-6 text-center">
    <h2 class="section-title">Nuestra Ubicación</h2>
    <p>Encuéntranos fácilmente en el mapa a continuación:</p>

    <div class="map-container">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3876.8784102145744!2d-90.51327!3d14.634915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8589a3f68c2c23d7%3A0x8e4dfb2d1f3cda8!2sGuatemala%20City!5e0!3m2!1ses-419!2sgt!4v1689281839232!5m2!1ses-419!2sgt" 
        width="100%" 
        height="400" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy">
      </iframe>
    </div>
  </div>
</section>

<!-- Contacto -->
<section class="section contact-section" id="contacto">
  <h2 class="section-title">Contáctanos</h2>

  <div class="contact-inner">
    <!-- FORM -->
    <form class="contact-form" onsubmit="return false;">
      <div class="form-group">
        <label for="nombre"><i class="fas fa-user"></i> Nombre</label>
        <input id="nombre" name="nombre" placeholder="Tu nombre completo" required type="text" />
      </div>

      <div class="form-group">
        <label for="email"><i class="fas fa-envelope"></i> Correo Electrónico</label>
        <input id="email" name="email" placeholder="tuemail@ejemplo.com" required type="email" />
      </div>

      <div class="form-group">
        <label for="mensaje"><i class="fas fa-comment-dots"></i> Mensaje</label>
        <textarea id="mensaje" class="textletter" name="mensaje" placeholder="Escribe tu mensaje aquí" required rows="4"></textarea>
      </div>

      <button class="btn-submit" type="submit">
        <i class="fas fa-paper-plane"></i> Enviar Mensaje
      </button>
    </form>

    <!-- INFO -->
    <div class="contact-info">
      <h3>Información de contacto</h3>
      <p><i class="fas fa-map-marker-alt mr"></i> Calle Principal, Ciudad de Guatemala</p>
      <p><i class="fas fa-phone mr"></i> +502 3455-5139</p>
      <p><i class="fas fa-envelope mr"></i> contacto@opticavisionclara.com</p>
    </div>
  </div>
</section>