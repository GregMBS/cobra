<!DOCTYPE html>
<html>
    <head>
        <title>Query del Inventario</title>

        <style type="text/css">
            body {font-family: arial, helvetica, sans-serif; font-size: 8pt; }
            table {border: 1pt solid #000000;background-color: #c0c0c0;}
            tr:hover {background-color: #ff0000;}
            th {border: 1pt solid #000000;background-color: #c0c0c0;}
            .loud {text-align:center; font-weight:bold; color:red;}
            .num {text-align:right;}
        </style>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php
        echo $capt;
        ?>'">Regressar a la plantilla administrativa</button><br>
        <form action="<?php echo $here; ?>" method="get" name="queryparms">
            <input type="hidden" name="capt" value="<?php echo $capt ?>">
            <p>Cliente: 
                <select name="cliente">
                    <option value="todos" style="font-size:120%;">todos</option>
                    <option value="actives" style="font-size:120%;">todos activos</option>
                    <?php
foreach ($resultc as $answerc) {
                        ?>
                        <option value="<?php echo $answerc['cliente']; ?>" style="font-size:120%;">
                            <?php echo $answerc['cliente']; ?></option>
                        <?php
}
                        ?>
                </select>
            </p>
            <input type='submit' name='go' value='Query Inventario'>
        </form>
    </body>
</html>
