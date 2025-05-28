<?php
/**
 * @var string $title
 * @var string[] $gestores
 * @var string[] $clientes
 * @var string $flag
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
<div class="container">
    <button class="btn btn-primary" onclick="window.location = 'reports.php?capt=<?php
    if (isset($capt)) {
        echo $capt;
    }
    ?>'">Regresar a la pagina administrativa
    </button>
    <br><br>
    <form action="/big<?php echo $flag; ?>.php" method="get" name="queryParams">
        <input type="hidden" name="capt" value="<?php if (isset($capt)) {
            echo $capt;
        } ?>">
        <div class="form-group">
            <label for="gestor">Gestor:</label>
            <select class="form-control" name="gestor" id="gestor">
                <option value="todos">todos</option>
                <?php
                foreach ($gestores as $gestor) {
                    ?>
                    <option value="<?php echo $gestor[0]; ?>">
                        <?php echo $gestor[0]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="cliente">Cliente:</label>
            <select class="form-control" name="cliente" id="cliente">
                <option value="todos">todos</option>
                <?php
                foreach ($clientes as $cliente) {
                    ?>
                    <option value="<?php echo $cliente[0]; ?>">
                        <?php echo $cliente[0]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>HECHO de:</label>
            <input class="form-control" name="fecha1" id="fecha1" readonly="readonly"/>
            <label>a:</label>
            <input class="form-control" name="fecha2" id="fecha2" readonly="readonly"/>
        </div>
        <div class="form-group">
            <?php
            if (!empty($flag)) {
                if ($flag == 'prom') {
                    ?>
                    <label>VENCIDO de:</label>
                    <input class="form-control" name="fecha3" id="fecha3" readonly="readonly"/>
                    <label>a:</label>
                    <input class="form-control" name="fecha4" id="fecha4" readonly="readonly"/>
                    <?php
                }
            }
            ?>
        </div>
        <fieldset class="form-group">
            <legend>Tipo</legend>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo" id="visits" value="visits">
                <label class="form-check-label" for="visits">
                    Visitas
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo" id="telefono" value="telefono">
                <label class="form-check-label" for="telefono">
                    Telefónica
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipo" id="todos" value="todos">
                <label class="form-check-label" for="todos">
                    Todos
                </label>
            </div>
        </fieldset>
        <button type="submit" class="btn btn-success" name="go">Query</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        flatpickr("#fecha1", {
            locale: "es"
        });
        flatpickr("#fecha2", {
            locale: "es"
        });
        flatpickr("#fecha3", {
            locale: "es"
        });
        flatpickr("#fecha4", {
            locale: "es"
        });
    });
</script>
</body>
</html>
