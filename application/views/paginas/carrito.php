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
                    <td>
                        <img src="<?= base_url('assets/img/imagnecate/' . $item['imagen']) ?>" alt="<?= $item['nombre'] ?>" class="carrito-img">
                        <?= $item['nombre'] ?>
                    </td>
                    <td>Q<?= number_format($item['precio'], 2) ?></td>
                    <td>
                        <form action="<?= base_url('index.php/carrito/actualizar') ?>" method="post">
                            <input type="hidden" name="index" value="<?= $index ?>">
                            <input type="number" name="cantidad" value="<?= $item['cantidad'] ?>" min="1">
                            <button type="submit" class="btn small">Actualizar</button>
                        </form>
                    </td>
                    <td>Q<?= number_format($subtotal, 2) ?></td>
                    <td>
                        <a href="<?= base_url('index.php/carrito/eliminar/' . $index) ?>" class="btn small red">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="carrito-total">
            <h3>Total: Q<?= number_format($total, 2) ?></h3>
            <a href="<?= base_url('index.php/productos') ?>" class="btn">Seguir Comprando</a>
            <a href="<?= base_url('index.php/carrito/finalizar') ?>" class="btn green">Finalizar Compra</a>
        </div>
    <?php endif; ?>
</main>
