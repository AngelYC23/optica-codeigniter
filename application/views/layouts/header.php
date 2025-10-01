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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
          <li><a href="<?= base_url('index.php/productos') ?>">Productos</a></li>
          <li><a href="<?= base_url('index.php/promociones') ?>">Promociones y Asociaciones</a></li>
          <li>
            <li class="usuario-menu">
              <?php if ($this->session->userdata('logged_in')): ?>
                <a href="#" class="usuario-toggle" title="Usuario">
                  <img src="<?= base_url('assets/img/imagenes_promociones/usuario.png') ?>" alt="Usuario">
                </a>
                <ul class="submenu">
                  <li class="submenu-header">
                    <i class="fas fa-user-circle"></i>
                    <?= html_escape($this->session->userdata('usuario_nombre')) ?>
                  </li>

                  <?php if ($this->session->userdata('id_rol') == 1): ?>
                    <li><a href="<?= base_url('index.php/gestion_articulos') ?>"><i class="fas fa-box"></i> Gestionar Artículos</a></li>
                    <li><a href="<?= base_url('index.php/usuarios') ?>"><i class="fas fa-users"></i> Usuarios</a></li>
                    <li><a href="<?= base_url('index.php/dashboard') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                  <?php endif; ?>

                  <li><a href="<?= base_url('index.php/compras') ?>"><i class="fas fa-shopping-bag"></i> Mis Compras</a></li>
                  <li class="logout"><a href="<?= base_url('index.php/login/logout') ?>"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
                </ul>
              <?php else: ?>
                <a href="<?= base_url('index.php/login') ?>" title="Iniciar sesión">
                  <img src="<?= base_url('assets/img/imagenes_promociones/usuario.png') ?>" alt="Iniciar sesión">
                </a>
              <?php endif; ?>
            </li>

            <style>
              .usuario-menu {
                position: relative;
                list-style: none;
              }

              .usuario-menu .usuario-toggle img {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                cursor: pointer;
                transition: transform 0.2s ease;
              }

              .usuario-menu .usuario-toggle img:hover {
                transform: scale(1.1);
              }

              .usuario-menu .submenu {
                display: none;
                position: absolute;
                right: 0;
                top: 120%;
                background: #fff;
                border: 1px solid #ddd;
                border-radius: 8px;
                min-width: 240px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                z-index: 1000;
                padding: 8px 0;
              }

              .submenu-header {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 12px 25px;
                font-weight: bold;
                color: #444;
                border-bottom: 1px solid #eee;
                white-space: nowrap;
              }

              .submenu-header i {
                color: #6c63ff;
                font-size: 18px;
              }

              .usuario-menu .submenu li a {
                display: flex;
                align-items: center;
                justify-content: flex-start;
                gap: 8px;
                padding: 12px 25px;
                font-weight: bold;
                color: #444;
                border-bottom: 1px solid #eee;
                white-space: nowrap;
                text-decoration: none;
                transition: background 0.2s;
              }

              .usuario-menu .submenu li a:hover {
                background: #f5f5f5;
                color: #007bff;
              }

              .usuario-menu.active .submenu {
                display: block;
              }

              .usuario-menu .submenu .submenu-header {
                text-align: center !important;
              }
            </style>

            <script>
              document.addEventListener("DOMContentLoaded", function() {
                const userMenu = document.querySelector(".usuario-menu");
                const toggleBtn = userMenu.querySelector(".usuario-toggle");

                toggleBtn.addEventListener("click", function(e) {
                  e.preventDefault();
                  userMenu.classList.toggle("active");
                });

                // Cerrar si haces click fuera
                document.addEventListener("click", function(e) {
                  if (!userMenu.contains(e.target)) {
                    userMenu.classList.remove("active");
                  }
                });
              });
            </script>
          </li>

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