<!DOCTYPE html>
<html lang="es">
<head>
    <title>Cobra Reports Menu</title>
    <link rel="Stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css"/>
    <style>
        #admin div {
            float: left;
            width: 33.333%;
            font-size: larger;
        }
        #gen div {
            float: left;
            width: 24.9%;
            font-size: larger;
        }
        button {
            margin: 0.75em;
        }
    </style>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
</head>
<body id="demos">
<script>
    $(function () {
        $("#tabs").tabs();
        $("button").button();
    });
</script>
<div id="tabs">
    <ul>
        <li><a href="#admin">Administración</a></li>
        <li><a href="#gen">Reportes Generales</a></li>
        <li><a href="#spec">Reportes por Clientes</a></li>
        <li><a href="#bot">ROBOT y ELASTIX</a></li>
    </ul>
    <div id="admin">
        <div>
        <h2>Cargas</h2>
        <?php
        foreach ($cargas as $row) { ?>
            <button onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button><br>
        <?php
        }
        ?>
        </div>
        <div>
        <h2>Visitas</h2>
        <?php
        foreach ($visitas as $row) { ?>
            <button onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button><br>
            <?php
        }
        ?>
        </div>
        <div>
        <h2>Administración</h2>
        <?php
        foreach ($admin as $row) { ?>
            <button onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button><br>
            <?php
        }
        ?>
        </div>
    </div>
    <div id="gen">
        <h2>Reportes Generales</h2>
        <div>
            <h2>Queues</h2>
        <?php
        foreach ($queues as $row) { ?>
            <button onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button>
            <?php
        }
        ?>
        </div>
        <div>
            <h2>Promesas y Pagos</h2>
            <?php
            foreach ($promPago as $row) { ?>
                <button onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button>
                <?php
            }
            ?>
        </div>
        <div>
            <h2>Horarios</h2>
            <?php
            foreach ($horarios as $row) { ?>
                <button onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button>
                <?php
            }
            ?>
        </div>
        <div>
            <h2>Hojas de calculo</h2>
            <?php
            foreach ($XLS as $row) { ?>
                <button onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button>
                <?php
            }
            ?>
        </div>
    </div>
    <div id="spec">
        <h2>Reportes Especializados</h2>
    </div>
    <div id="bot">
        <h2>Controlar ROBOT</h2>
        <h3>ROBOT</h3>
    </div>
</div>
<p>
    <button onclick="window.location = 'quick.php?capt=<?php echo $capt; ?>'">Tiempo Real</button>
    <button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>'">Las Cuentas</button>
    <button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>&go=LOGOUT'">LOGOUT</button>
    <br>
</p>
</body>
</html>
