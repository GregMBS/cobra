<?php
/**
 * @var ResumenObject[] $report
 */

use cobra_salsa\ResumenObject;

?>
<!DOCTYPE HTML>

<html lang="es">
<head>
    <title>Cambia de Gestores</title>
    <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<form action="" method="post" name="cambiar">
    <label for="data">Usa numero de cuenta</label>
    <textarea name='data' id='data' rows='20' cols='50'></textarea>
    <input type="hidden" name="capt" value="<?php
    echo $capt
    ?>"/>
    <button type="submit" name="go" value="cargar">Cambiar</button>
</form>
<?php
if (isset($report)) {
    ?>
    <div>
        <?php
        foreach ($report as $row) {
            ?>
            <form class="change" method="post" action="/gestorChangeAjax.php" id="<?php echo $row->id_cuenta; ?>">
                <input type="hidden" name="capt" value="<?php echo $capt; ?>">
                <dl>
                    <dt>
                        <span class="numero_de_cuenta"><?php echo $row->numero_de_cuenta; ?></span>
                        <input type="hidden" name="id_cuenta" value="<?php echo $row->id_cuenta; ?>">
                    </dt>
                    <dd>
                        <label class="agent"
                               for="agent<?php echo $row->id_cuenta; ?>"><?php echo $row->ejecutivo_asignado_call_center; ?></label>
                        <select name="agent" id="agent<?php echo $row->id_cuenta; ?>">
                            <?php
                            foreach ($gestores as $gestor) { ?>
                                <option value="<?php echo $gestor; ?>"><?php echo $gestor; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label class="sdc"><?php echo $row->status_de_credito; ?>
                            <input type="text" name="status_de_credito" value="<?php echo $row->status_de_credito; ?>"></label>
                        <label class="fda"><?php echo $row->fecha_de_actualizacion; ?>
                            <input type="submit" name="go" value="cambiar"></label>
                    </dd>
                </dl>
            </form>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">
    Regresar a la pagina administrativa
</button>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
<script>
    // Attach a submit handler to the form
    $(".change").submit(function (event) {

        // Stop form from submitting normally
        event.preventDefault();

        // Get some values from elements on the page:
        const $form = $(this);
        const id_cuenta = $form.find("input[name='id_cuenta']");
        const id = id_cuenta.val();
        const agent = $form.find("[name='agent']");
        const gestor = agent.val();
        const status_de_credito = $form.find("input[name='status_de_credito']");
        const sdc = status_de_credito.val();
        const url = $form.attr("action");
        const agentLabel = $form.find(".agent");
        const sdcLabel = $form.find(".sdc");
        const fdaLabel = $form.find(".fda");

        // Send the data using post
        const posting = $.post(url, {
            id_cuenta: id, agent: gestor, status_de_credito: sdc, capt: '<?php
                echo $capt;
                ?>'
        });

        // Put the results in a div
        posting.done(function (result) {
            const data = JSON.parse(result);
            agentLabel.text(data.ejecutivo_asignado_call_center);
            sdcLabel.text(data.status_de_credito);
            fdaLabel.text(data.fecha_de_actualizacion);
        });
    });
</script>
</body>
</html>