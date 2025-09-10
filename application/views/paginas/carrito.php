<main class="main-content container">
    <h2>Tu Carrito de Compras</h2>

    <?php $carrito = $this->session->userdata('carrito') ?? []; ?>
    <?php if(empty($carrito)): ?>
        <p>Tu carrito está vacío. <a href="<?= base_url('index.php/productos') ?>">Ir a productos</a></p>
    <?php else: ?>
        <table class="carrito-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach($carrito as $index => $item): 
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td class="producto-info">
                        <img src="<?= base_url('assets/img/imagnecate/' . $item['imagen']) ?>" alt="<?= $item['nombre'] ?>" class="carrito-img">
                        <span><?= $item['nombre'] ?></span>
                    </td>
                    <td>Q<?= number_format($item['precio'], 2) ?></td>
                    <td>
                        <div class="cantidad-control">
                            <button type="button" class="btn qty-btn" data-index="<?= $index ?>" data-action="minus">−</button>
                            <input type="number" name="cantidad" value="<?= $item['cantidad'] ?>" min="1" data-index="<?= $index ?>" readonly>
                            <button type="button" class="btn qty-btn" data-index="<?= $index ?>" data-action="plus">+</button>
                        </div>
                    </td>
                    <td class="subtotal">Q<?= number_format($subtotal, 2) ?></td>
                    <td>
                        <a href="<?= base_url('index.php/carrito/eliminar/' . $index) ?>" class="btn small red">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="carrito-total">
            <h3>Total: Q<span id="total"><?= number_format($total, 2) ?></span></h3>
            <a href="<?= base_url('index.php/productos') ?>" class="btn">Seguir Comprando</a>
            <a href="<?= base_url('index.php/carrito/finalizar') ?>" class="btn green">Finalizar Compra</a>
        </div>
    <?php endif; ?>
</main>

<script>
document.querySelectorAll('.qty-btn').forEach(button => {
    button.addEventListener('click', function() {
        const index = this.dataset.index;
        const action = this.dataset.action;
        const input = document.querySelector('input[data-index="'+index+'"]');
        let cantidad = parseInt(input.value);

        // Ajustar cantidad
        if(action === 'plus') cantidad++;
        if(action === 'minus' && cantidad > 1) cantidad--;

        input.value = cantidad;

        // Enviar al servidor
        const formData = new FormData();
        formData.append('index', index);
        formData.append('cantidad', cantidad);

        fetch('<?= base_url('index.php/carrito/actualizar') ?>', {
            method: 'POST',
            body: formData
        })
        .then(() => location.reload()); // recarga para actualizar subtotal y total
    });
});
</script>
