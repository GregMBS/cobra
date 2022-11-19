<table class="ui-widget">
    <thead class="ui-widget-header">
    <tr>
        <th>ID CUENTA</th>
        <th>CUENTA</th>
        <th>NOMBRE</th>
        <th>CLIENTE</th>
        <th>SALDO TOTAL</th>
        <th>QUEUE</th>
        <th>GESTOR</th>
        <th>FECHA DE ASIGNA</th>
        <th>FECHA DE REGRESA</th>
    </tr>
    </thead>
    <tbody class="ui-widget-content">
    <?php
    if (!empty($gestor)) {
        foreach ($resultMain as $row) { ?>
            <tr>
                <td><?php echo $row->id_cuenta; ?></td>
                <td><?php echo $row->numero_de_cuenta; ?></td>
                <td><?php echo $row->nombre_deudor; ?></td>
                <td><?php echo $row->cliente; ?></td>
                <td><?php echo number_format($row->saldo_total); ?></td>
                <td><?php echo $row->queue; ?></td>
                <td><?php echo $row->gestor; ?></td>
                <td><?php echo $row->fechaout; ?></td>
                <td><?php echo $row->fechain; ?></td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>