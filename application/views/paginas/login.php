<?php if (!empty($error_msg)): ?>
  <div class="alert alert-error"><?= html_escape($error_msg) ?></div>
<?php endif; ?>

<?php if (!empty($success_msg)): ?>
  <div class="alert alert-success"><?= html_escape($success_msg) ?></div>
<?php endif; ?>

<div class="containerlog">
    <div class="form-container2">
      <div class="form-blob">
        <img src="<?= base_url('assets/img/ico.ico') ?>" alt="Blob" class="blob-image blob-image--1">
        <img src="<?= base_url('assets/img/ico.ico') ?>" alt="Blob" class="blob-image blob-image--2">
        <img src="<?= base_url('assets/img/ico.ico') ?>" alt="Blob" class="blob-image blob-image--3">
      </div>

      <div class="form-header2">
        <p>INICIO DE SESIÓN</p>
        <h1>BIENVENIDO</h1>
      </div>

      <!-- LOGIN -->
      <form class="form-box" method="post" action="<?= base_url('index.php/login/autenticar') ?>">
        <div class="input-group">
            <input type="email" id="email" name="email" class="input-field" placeholder="" required>
            <label for="email" class="floating-label">Correo electrónico</label>
        </div>
        <div class="input-group">
            <input type="password" id="password" name="password" class="input-field" placeholder="" required>
            <label for="password" class="floating-label">Contraseña</label>
            <div class="eye-icon" onclick="togglePassword()">
                <!-- ícono del ojo -->
            </div>
        </div>
        <div class="input-group checkbox-group">
            <div class="form-col remember-me">
                <input type="checkbox" id="remember-me-checkbox" class="checkbox-field" name="remember_me">
                <label for="remember-me-checkbox">Recordar contraseña</label>
            </div>
             <!-- 
            <div class="form-col">
                <a href="#" class="form-link">¿Olvidaste tu contraseña?</a>
            </div>
             -->
        </div>
        <button type="submit" class="form-btn form-btn--submit">Sign In</button>
      </form>

      <!-- SIGNUP (oculto al inicio) -->
      <form class="form-box" id="signupForm" method="post" action="<?= base_url('index.php/login/registrar') ?>" style="display:none;">
        <div class="input-group">
          <input type="email" id="signupEmail" name="email" class="input-field" placeholder="" required>
          <label for="signupEmail" class="floating-label">Correo electrónico</label>
        </div>

        <div class="input-group">
          <input type="password" id="signupPassword" name="password" class="input-field" placeholder="" required>
          <label for="signupPassword" class="floating-label">Contraseña</label>
          <div class="eye-icon" onclick="togglePassword('#signupPassword', this)">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye">
              <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
              <circle cx="12" cy="12" r="3"/>
            </svg>
          </div>
        </div>

        <button type="submit" class="form-btn form-btn--submit">Sign Up</button>
        <p>¿Ya tienes una cuenta? <a href="#" onclick="mostrarLogin()">Sign In</a></p>
      </form>

     <p>¿No tienes una cuenta? 
  <a href="<?= base_url('index.php/registro') ?>" class="form-link">Crear cuenta</a>

</p>

      </div>

    </div>
</div>
