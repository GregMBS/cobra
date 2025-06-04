<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Administraci&oacute;n de las cuentas de los gestores</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <style>
            tr:hover {background-color: #fff9c4;}
        </style>
    </head>
    <body>
        <div class="container py-4">
            <button class="btn btn-secondary mb-3" onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Gestor</th>
                            <th>Completo</th>
                            <th>Contrase&ntilde;a</th>
                            <th>Tipo</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $j = 0;
                        foreach ($result as $row) {
                            $j++;
                            $usuaria = $row['USUARIA'];
                            $completo = mb_convert_encoding($row['COMPLETO'], 'Windows-1252', 'UTF-8');
                            $tipo = $row['TIPO'];
                            $camp = $row['CAMP'];
                            $gestor = $row['INICIALES'];
                            $passw = $row['PASSW'];
                        ?>
                        <tr>
                            <td>
                                <form class="gestorChange" name="gestorChange<?php echo $j; ?>" method="get" action="/gestorAdmin.php" id="gestorChange<?php echo $j; ?>">
                                    <input type="hidden" name="capt" value="<?php echo $capt ?>">
                                    <input type="hidden" name="j" value="<?php echo $j ?>">
                                    <input type="text" name="usuaria" readonly class="form-control-plaintext" value="<?php echo $usuaria; ?>" />
                                </form>
                            </td>
                            <td><input form="gestorChange<?php echo $j; ?>" type="text" name="completo" class="form-control" value="<?php echo $completo; ?>" /></td>
                            <td><input form="gestorChange<?php echo $j; ?>" type="password" name="passw" class="form-control" value="<?php echo $passw; ?>" /></td>
                            <td>
                                <select form="gestorChange<?php echo $j; ?>" name="tipo" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($groups as $g) {
                                        $group = $g['grupo'];
                                    ?>
                                    <option value="<?php echo $group ?? ''; ?>" <?php if (strtolower($group) == strtolower($tipo)) echo "selected"; ?>><?php echo $group ?? ''; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><input form="gestorChange<?php echo $j; ?>" type="submit" name="go" value="GUARDAR" class="btn btn-success btn-sm"></td>
                            <td><input form="gestorChange<?php echo $j; ?>" type="submit" name="go" value="BORRAR" class="btn btn-danger btn-sm"></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>
                                <form class="gestorAdd" name="gestorAdd" method="get" action="/gestorAdmin.php" id="gestorAdd">
                                    <input type="hidden" name="capt" value="<?php echo $capt ?>">
                                    <input type="text" name="usuaria" class="form-control" value="" />
                                </form>
                            </td>
                            <td><input form="gestorAdd" type="text" name="completo" class="form-control" value="" /></td>
                            <td><input form="gestorAdd" type="password" name="passw" class="form-control" value="" /></td>
                            <td>
                                <select form="gestorAdd" name="tipo" class="form-select">
                                    <option value=""></option>
                                    <?php foreach ($groups as $g) {
                                        $group = $g['grupo'];
                                    ?>
                                    <option value="<?php echo $group ?? ''; ?>"><?php echo $group ?? ''; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td colspan="2"><input form="gestorAdd" type="submit" name="go" value="AGREGAR" class="btn btn-primary btn-sm w-100"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
