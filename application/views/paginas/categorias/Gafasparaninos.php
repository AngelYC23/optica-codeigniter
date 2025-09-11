<section class="category-products">
    <h2>Gafas para Niños</h2>
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
function agregarAlCarrito(id_producto) {
    const formData = new FormData();
    formData.append('id_producto', id_producto);
    formData.append('cantidad', 1);

    fetch('<?= base_url('index.php/carrito/agregar') ?>', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            const contador = document.querySelector('.carrito-cantidad');
            if (contador) contador.innerText = data.cantidad_total;
            alert('Producto agregado al carrito');
        })
        .catch(err => console.error('Error en carrito:', err));
}
</script>
