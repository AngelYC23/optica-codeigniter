<section class="category-products">
    <h2>Gafas Deportivas</h2>
    <a href="javascript:history.back()" class="back-btn">← Regresar</a>
    <div class="products-grid">

        <?php if (empty($productos)): ?>
            <p>No hay productos en esta categoría.</p>
        <?php else: ?>
            <?php foreach ($productos as $producto): ?>
                <article class="card">
                    <img src="<?= base_url('assets/img/imagnecate/' . $producto['imagen']) ?>"
                        alt="<?= $producto['nombre'] ?>" />
                    <h3><?= $producto['nombre'] ?></h3>
                    <p class="price">Q<?= number_format($producto['precio'], 2) ?></p>
                    <p><?= $producto['descripcion'] ?></p>

                    <!-- Botón que agrega al carrito vía AJAX -->
                    <a href="<?= base_url('index.php/carrito/agregar/' . $producto['id_producto']) ?>"
                        class="btn comprar-btn">
                        🛒 Agregar al carrito
                    </a>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</section>

<script>
    // Función para agregar productos sin recargar
    function agregarAlCarrito(id_producto) {
        fetch('<?= base_url('index.php/carrito/agregar') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id_producto: id_producto,
                    cantidad: 1
                })
            })
            .then(res => res.json())
            .then(data => {
                // Actualizar contador del carrito (si lo tienes en header)
                const contador = document.querySelector('.carrito-cantidad');
                if (contador) contador.innerText = data.cantidad_total;

                // Mensaje opcional
                alert('Producto agregado al carrito');
            })
            .catch(err => console.error(err));
    }
</script>
