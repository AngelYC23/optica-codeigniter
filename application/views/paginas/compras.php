<div class="container my-4 main-content">
  <h2 class="text-center mb-4">Mis Compras</h2>

  <div class="card shadow-sm">
    <div class="card-body">
      <?php if (!empty($pedidos)): ?>
        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
              <tr>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pedidos as $p): ?>
                <tr>
                  <td><?= $p->id_pedido ?></td>
                  <td><?= date('d/m/Y H:i', strtotime($p->fecha)) ?></td>
                  <td><span class="badge bg-primary">Q <?= number_format($p->total, 2) ?></span></td>
                  <td>
                    <?php if ($p->estado == 'pendiente'): ?>
                      <span class="badge bg-warning text-dark">Pendiente</span>
                    <?php elseif ($p->estado == 'pagado'): ?>
                      <span class="badge bg-success">Completado</span>
                    <?php else: ?>
                      <span class="badge bg-secondary"><?= ucfirst($p->estado) ?></span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p class="text-center text-muted">No tienes compras registradas.</p>
      <?php endif; ?>
    </div>
  </div>
</div>
