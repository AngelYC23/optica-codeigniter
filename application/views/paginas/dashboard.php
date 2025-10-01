<style>
  
  body {
    padding-top: 80px;
    min-height: 100vh;
  }

  .card {
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px 0 rgba(0, 64, 128, 0.15);
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 
      0 0 15px rgba(31, 21, 170, 0.8),
      0 0 30px rgba(0, 191, 255, 0.6),  
      0 0 45px rgba(0, 191, 255, 0.4);
    background: rgba(255, 255, 255, 0.15);
  }

  .card-header {
    font-weight: bold;
    text-align: center;
    font-size: 1.1rem;
    padding: 1rem;
  }

  .bg-azul-oscuro {
    background: linear-gradient(135deg, #004080, #007bff);
    color: white;
  }
</style>

<div class="container my-4">
  <div class="card">
    <div class="card-header bg-azul-oscuro">Filtros</div>
    <div class="card-body">
      <form method="get" action="<?= site_url('dashboard') ?>" class="row g-3 align-items-end">
        <div class="col-md-4">
          <label for="fecha_inicio" class="form-label">Fecha inicio</label>
          <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="<?= $fecha_inicio ?>">
        </div>
        <div class="col-md-4">
          <label for="fecha_fin" class="form-label">Fecha fin</label>
          <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="<?= $fecha_fin ?>">
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <h1 class="hero-title text-center"><?= $titulo ?></h1>
  <div class="row g-4">

    <!-- Ventas por mes -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-azul-oscuro">
          Ventas por Mes
        </div>
        <div class="card-body">
          <canvas id="ventasMes"></canvas>
        </div>
      </div>
    </div>

    <!-- Productos más vendidos -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-azul-oscuro">
          Top 5 Productos más Vendidos
        </div>
        <div class="card-body">
          <canvas id="productosVendidos"></canvas>
        </div>
      </div>
    </div>

    <!-- Stock por categoría -->
    <div class="col-6">
      <div class="card">
        <div class="card-header bg-azul-oscuro">
          Stock por Categoría
        </div>
        <div class="card-body">
          <canvas id="stockCategoria"></canvas>
        </div>
      </div>
    </div>

    <!-- Pedidos por estado -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-azul-oscuro">
          Pedidos por Estado
        </div>
        <div class="card-body">
          <canvas id="pedidosEstado"></canvas>
        </div>
      </div>
    </div>

    <!-- Usuarios por rol -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-azul-oscuro">
          Usuarios por Rol
        </div>
        <div class="card-body">
          <canvas id="usuariosRol"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script de Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Datos PHP -> JS
  const ventasMes = <?= json_encode($ventas) ?>;
  const pedidosEstado = <?= json_encode($estados) ?>;
  const productosVendidos = <?= json_encode($top_productos) ?>;
  const usuariosRol = <?= json_encode($roles) ?>;
  const stockCategoria = <?= json_encode($stock) ?>;

  // ==================== Ventas por Mes ====================
  const ctxVentas = document.getElementById('ventasMes').getContext('2d');
  const gradientVentas = ctxVentas.createLinearGradient(0, 0, 0, 400);
  gradientVentas.addColorStop(0, 'rgba(0, 191, 255, 0.8)');
  gradientVentas.addColorStop(1, 'rgba(0, 123, 255, 0.2)');

  new Chart(ctxVentas, {
    type: 'line',
    data: {
      labels: ventasMes.map(v => v.mes),
      datasets: [{
        label: 'Ventas (Q)',
        data: ventasMes.map(v => v.ventas),
        borderColor: '#00bfff',
        backgroundColor: gradientVentas,
        fill: true,
        tension: 0.4,
        pointRadius: 6,
        pointBackgroundColor: '#00bfff',
        pointBorderColor: '#fff',
        pointBorderWidth: 2
      }]
    },
    options: { responsive: true }
  });

  // ==================== Pedidos por Estado ====================
  new Chart(document.getElementById('pedidosEstado'), {
    type: 'doughnut',
    data: {
      labels: pedidosEstado.map(p => p.estado),
      datasets: [{
        data: pedidosEstado.map(p => p.cantidad),
        backgroundColor: ['#28a745', '#007bff', '#dc3545']
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } }
    }
  });

  // ==================== Productos más Vendidos ====================
  const ctxProductos = document.getElementById('productosVendidos').getContext('2d');
  const gradientProductos = ctxProductos.createLinearGradient(0, 0, 500, 0);
  gradientProductos.addColorStop(0, '#667eea');
  gradientProductos.addColorStop(0.5, '#764ba2');
  gradientProductos.addColorStop(1, '#f093fb');

  new Chart(ctxProductos, {
    type: 'bar',
    data: {
      labels: productosVendidos.map(p => p.nombre),
      datasets: [{
        label: 'Vendidos',
        data: productosVendidos.map(p => p.vendidos),
        backgroundColor: gradientProductos,
        borderRadius: 10
      }]
    },
    options: {
      responsive: true,
      indexAxis: 'y',
      plugins: { legend: { display: false } }
    }
  });

  // ==================== Usuarios por Rol ====================
  new Chart(document.getElementById('usuariosRol'), {
    type: 'pie',
    data: {
      labels: usuariosRol.map(r => r.nombre_rol),
      datasets: [{
        data: usuariosRol.map(r => r.cantidad),
        backgroundColor: ['#ffc107', '#007bff', '#6c757d']
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } }
    }
  });

  // ==================== Stock por Categoría ====================
  const ctxStock = document.getElementById('stockCategoria').getContext('2d');
  const gradientStock = ctxStock.createLinearGradient(0, 0, 0, 400);
  gradientStock.addColorStop(0, '#4facfe');
  gradientStock.addColorStop(1, '#00f2fe');

  new Chart(ctxStock, {
    type: 'bar',
    data: {
      labels: stockCategoria.map(s => s.categoria),
      datasets: [{
        label: 'Stock Total',
        data: stockCategoria.map(s => s.stock_total),
        backgroundColor: gradientStock,
        borderRadius: 10
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } }
    }
  });
</script>