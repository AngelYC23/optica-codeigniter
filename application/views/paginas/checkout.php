<?php $carrito = $this->session->userdata('carrito') ?? []; ?>
<?php if(empty($carrito)): ?>
    <p>Tu carrito está vacío. <a href="<?= base_url('index.php/productos') ?>">Ir a productos</a></p>
<?php else: ?>
    <div class="checkout-container">
        <h2>Finalizar Compra</h2>

        <table class="carrito-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach($carrito as $item): 
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?= $item['nombre'] ?></td>
                    <td>Q<?= number_format($item['precio'], 2) ?></td>
                    <td><?= $item['cantidad'] ?></td>
                    <td>Q<?= number_format($subtotal, 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Total a Pagar: Q<?= number_format($total, 2) ?></h3>

        <form action="<?= base_url('index.php/carrito/procesar') ?>" method="POST">
            <input type="hidden" name="total" value="<?= $total ?>"> 

            <label for="metodo_pago">Selecciona tu método de pago:</label>
            <select name="metodo_pago" id="metodo_pago" required>
                <option value="">-- Selecciona --</option>
                <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                <option value="efectivo">Efectivo</option>
                <option value="transferencia">Transferencia Bancaria</option>
            </select>

            <div class="btns">
                <a href="<?= base_url('index.php/carrito') ?>" class="btn">← Volver al Carrito</a>
                <button type="submit" class="btn green">Confirmar Compra</button>
            </div>
        </form>
    </div>
<?php endif; ?>
