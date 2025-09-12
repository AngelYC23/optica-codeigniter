<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title><?= $titulo ?? 'Óptica Visión Clara' ?></title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />

  <!-- Font Awesome (iconos) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

  <!-- Estilos principales -->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

  <!-- Estilos extra dinámicos -->
  <?php if (!empty($extra_css)): ?>
    <?php foreach ($extra_css as $css): ?>
      <link rel="stylesheet" href="<?= base_url($css) ?>">
    <?php endforeach; ?>
  <?php endif; ?>

  <!-- Favicon -->
  <link rel="icon" href="<?= base_url('assets/img/ico.ico') ?>" type="image/x-icon">

  <meta name="description" content="Óptica Visión Clara - Tu mejor opción en gafas, lentes y cuidado visual.">
  <meta name="keywords" content="óptica, gafas, lentes, visión, Guatemala">
  <meta name="author" content="Óptica Visión Clara">

  <!-- Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-621HJ183BL"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-621HJ183BL');
  </script>
</head>

<body>
  <div class="loader">
    <div class="spinner"></div>
  </div>

  <header class="site-header">
    <div class="container header-inner">
      <div class="brand">
         <a href="<?= base_url('index.php/home') ?>">
      <img alt="Logo de Óptica Visión Clara" class="logo"
        src="<?= base_url('assets/img/imagenes_promociones/logo.jpeg') ?>" />
    </a>
        <h1 class="site-title">OVC</h1>
      </div>

      <nav class="main-nav" aria-label="Navegación principal">
        <ul class="nav-links" id="nav-links">
          <li><a href="<?= base_url('index.php/home') ?>">Inicio</a></li>
          <li><a href="#ubicacion">Ubicación</a></li>
          <li><a href="<?= base_url('index.php/productos') ?>">Productos</a></li>
          <li><a href="<?= base_url('index.php/promociones') ?>">Promociones y Asociaciones</a></li>
          <li>
  <a href="<?= base_url('index.php/login') ?>" title="Iniciar sesión"> 
    <img src="<?= base_url('assets/img/imagenes_promociones/usuario.png') ?>" alt="Iniciar sesión">
  </a>
</li>


          <!-- Icono de carrito -->
          <li class="carrito">
  <a href="<?= base_url('index.php/carrito') ?>" title="Ver carrito">
    <i class="fas fa-shopping-cart fa-lg"></i>
    <?php if (!empty($carrito)): ?>
      <span class="carrito-cantidad"><?= count($carrito) ?></span>
    <?php endif; ?>
  </a>
</li>



        </ul>

        <button class="menu-btn" id="menu-btn" aria-label="Abrir menú">
          <i class="fas fa-bars fa-2x"></i>
        </button>
      </nav>
    </div>

<!-- Menú móvil -->
<div class="mobile-menu hidden" id="mobile-menu">
  <ul>
    <li><a href="<?= base_url('index.php/home') ?>">Inicio</a></li>
    <li><a href="<?= base_url('index.php/productos') ?>">Productos</a></li>
    <li><a href="<?= base_url('index.php/promociones') ?>">Promociones y Asociaciones</a></li>
    <li>
      <a href="<?= base_url('index.php/promociones') ?>" title="Iniciar sesión">
        <img src="<?= base_url('assets/img/imagenes_promociones/usuario.png') ?>" alt="Iniciar sesión" style="width:24px; vertical-align:middle;">
        Usuario
      </a>
    </li>
    <li>
      <a href="<?= base_url('index.php/carrito') ?>" title="Ver carrito">
        🛒 Carrito (<?= $cantidad_carrito ?>)
      </a>
    </li>
  </ul>
</div>

  </header>