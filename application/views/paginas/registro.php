<?php if (!empty($error_msg)): ?>
  <div class="alert alert-error"><?= html_escape($error_msg) ?></div>
<?php endif; ?>

<?php if (!empty($success_msg)): ?>
  <div class="alert alert-success"><?= html_escape($success_msg) ?></div>
<?php endif; ?>

<div class="wave-background">
    <!-- Ondas principales -->
    <div class="wave-vector wave-1"></div>
    <div class="wave-vector wave-2"></div>
    <div class="wave-vector wave-3"></div>
    <div class="wave-vector wave-4"></div>
    <div class="wave-vector wave-5"></div>
    
    <!-- Ondas circulares -->
    <div class="circle-wave circle-1"></div>
    <div class="circle-wave circle-2"></div>
    <div class="circle-wave circle-3"></div>
    
    <!-- Ondas fluidas -->
    <div class="fluid-wave fluid-1"></div>
    <div class="fluid-wave fluid-2"></div>
    <div class="fluid-wave fluid-3"></div>
    
    <!-- Partículas ondulantes -->
    <div class="wave-particle particle-1"></div>
    <div class="wave-particle particle-2"></div>
    <div class="wave-particle particle-3"></div>
    <div class="wave-particle particle-4"></div>
</div>

<div class="containerlog">
  <div class="form-container2">
    
    <div class="form-blob">
      <img src="<?= base_url('assets/img/ico.ico') ?>" alt="Blob" class="blob-image blob-image--1">
      <img src="<?= base_url('assets/img/ico.ico') ?>" alt="Blob" class="blob-image blob-image--2">
      <img src="<?= base_url('assets/img/ico.ico') ?>" alt="Blob" class="blob-image blob-image--3">
    </div>

    <div class="form-header2">
      <p>CREAR CUENTA</p>
      <h1>REGÍSTRATE</h1>
    </div>

    <!-- FORMULARIO DE REGISTRO -->
    <form class="form-box" method="post" action="<?= base_url('index.php/registro/registrar') ?>">
      
      <div class="input-group">
        <input type="text" id="nombre" name="nombre" class="input-field" placeholder="" required>
        <label for="nombre" class="floating-label">Nombre completo</label>
      </div>

      <div class="input-group">
        <input type="email" id="email" name="email" class="input-field" placeholder="" required>
        <label for="email" class="floating-label">Correo electrónico</label>
      </div>

      <div class="input-group">
        <input type="password" id="password" name="password" class="input-field" placeholder="" required>
        <label for="password" class="floating-label">Contraseña</label>
        <div class="eye-icon" onclick="togglePassword('#password', this)">
          <!-- Ícono ojo -->
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
               viewBox="0 0 24 24" fill="none" stroke="currentColor" 
               stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" 
               class="lucide lucide-eye-icon lucide-eye">
            <path d="M2.062 12.348a1 1 0 0 1 0-.696 
                     10.75 10.75 0 0 1 19.876 0 
                     1 1 0 0 1 0 .696 
                     10.75 10.75 0 0 1-19.876 0"/>
            <circle cx="12" cy="12" r="3"/>
          </svg>
        </div>
      </div>

      <button type="submit" class="form-btn form-btn--submit">Crear cuenta</button>
    </form>

    <p>¿Ya tienes una cuenta? 
      <a href="<?= base_url('index.php/login') ?>" class="form-link">Inicia sesión</a>
    </p>

  </div>
</div>
