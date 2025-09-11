<h2>Factura #<?= $pedido['id_pedido'] ?></h2>
<p>Estado: <?= ucfirst($pedido['estado']) ?></p>
<p>Fecha: <?= $pedido['fecha'] ?></p>

<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; foreach ($detalles as $d):
            $subtotal = $d['precio_unitario'] * $d['cantidad'];
            $total += $subtotal;
        ?>
        <tr>
            <td><?= $d['nombre'] ?></td>
            <td><?= $d['cantidad'] ?></td>
            <td>Q<?= number_format($d['precio_unitario'],2) ?></td>
            <td>Q<?= number_format($subtotal,2) ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>Q<?= number_format($total,2) ?></strong></td>
        </tr>
    </tbody>
</table>
