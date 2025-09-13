<div class="container my-3 main-content">
  <h2 class="mb-4 text-center"><?= $titulo ?></h2>

  <div class="card shadow-sm">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $u): ?>
            <tr>
              <td><?= $u->id_usuario ?></td>
              <td><?= $u->nombre ?></td>
              <td><?= $u->email ?></td>

              <!-- Selector de roles -->
              <td>
                <form action="<?= base_url('index.php/usuarios/cambiar_rol/'.$u->id_usuario) ?>" method="post">
                  <select name="id_rol" class="form-select form-select-sm" onchange="this.form.submit()">
                    <?php foreach ($roles as $rol): ?>
                      <option value="<?= $rol->id_rol ?>" <?= ($u->id_rol == $rol->id_rol) ? 'selected' : '' ?>>
                        <?= $rol->nombre_rol ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </form>
              </td>

              <!-- Estado -->
              <td>
                <?php if ($u->activo): ?>
                  <span class="badge bg-success">Activo</span>
                <?php else: ?>
                  <span class="badge bg-danger">Inactivo</span>
                <?php endif; ?>
              </td>

              <!-- Acciones -->
              <td class="d-flex gap-2">
                <a href="<?= base_url('index.php/usuarios/eliminar/'.$u->id_usuario) ?>" 
                  class="btn btn-sm btn-danger"
                  onclick="return confirm('¿Seguro de eliminar este usuario?')">
                  <i class="fas fa-trash"></i> Eliminar
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>