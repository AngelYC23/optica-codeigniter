<div class="container my-3 main-content">
  <h1 class="mb-4 text-center">Mantenimiento de Productos</h1>

  <!-- FORMULARIO PARA CREAR/EDITAR -->
  <div class="card shadow-sm mb-5">
    <div class="card-body">
      <form action="<?= base_url('index.php/gestion_articulos/guardar') ?>" method="post" enctype="multipart/form-data">
        
        <?php if (isset($producto)): ?>
          <input type="hidden" name="id_producto" value="<?= $producto->id_producto ?>">
        <?php endif; ?>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control"
                   value="<?= isset($producto) ? $producto->nombre : '' ?>" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control"
                   value="<?= isset($producto) ? $producto->precio : '' ?>" required>
          </div>

          <div class="col-md-12">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3" required><?= isset($producto) ? $producto->descripcion : '' ?></textarea>
          </div>

          <div class="col-md-6">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control"
                   value="<?= isset($producto) ? $producto->stock : '' ?>" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Categoría</label>
            <select name="id_categoria" class="form-select" required>
              <option value="">Seleccione...</option>
              <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat->id_categoria ?>"
                  <?= isset($producto) && $producto->id_categoria == $cat->id_categoria ? 'selected' : '' ?>>
                  <?= $cat->nombre ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-12">
            <label class="form-label">Imagen</label>
            <input type="file" name="imagen" class="form-control">
            <?php if (isset($producto) && !empty($producto->imagen)): ?>
              <div class="mt-2">
                <p class="mb-1">Imagen actual:</p>
                <img src="<?= base_url('uploads/productos/' . $producto->imagen) ?>"
                     alt="Imagen actual" class="img-thumbnail" style="max-width:150px;">
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="mt-4 text-end">
          <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> <?= isset($producto) ? 'Actualizar' : 'Guardar' ?>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- LISTADO DE PRODUCTOS -->
  <div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">
      <h5 class="mb-0">Listado de Productos</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Stock</th>
              <th>Categoría</th>
              <th>Imagen</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($productos)): ?>
              <?php foreach ($productos as $p): ?>
                <tr>
                  <td><?= $p->id_producto ?></td>
                  <td><?= $p->nombre ?></td>
                  <td><?= $p->descripcion ?></td>
                  <td><span class="badge bg-primary">Q <?= number_format($p->precio, 2) ?></span></td>
                  <td><?= $p->stock ?></td>
                  <td><?= $p->id_categoria ?></td>
                  <td>
                    <?php if (!empty($p->imagen)): ?>
                      <img src="<?= base_url('uploads/productos/' . $p->imagen) ?>" 
                           alt="<?= $p->nombre ?>" class="img-thumbnail" style="max-width:80px;">
                    <?php else: ?>
                      <span class="text-muted">Sin imagen</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="<?= base_url('index.php/gestion_articulos/editar/' . $p->id_producto) ?>" 
                       class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                    <a href="<?= base_url('index.php/gestion_articulos/eliminar/' . $p->id_producto) ?>" 
                       class="btn btn-sm btn-danger" 
                       onclick="return confirm('¿Seguro de eliminar este producto?')">
                       <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="8" class="text-center">No hay productos registrados.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>