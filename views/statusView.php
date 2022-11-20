<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Database Status</title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" /> 
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script> 
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" type="text/javascript"></script> 
        <style>
            tr:hover {background-color: yellow;}
        </style>
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button><br>
        <table class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Host</th>
                    <th>db</th>
                    <th>Command</th>
                    <th>Time</th>
                    <th>State</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                $j = 0;

                foreach ($main as $row) {
                    $j++;
                    [$ID, $User, $Host, $db, $Command, $Time, $State, $Info] = $row;
                    ?>
                    <tr>
                        <td><label><input type="text" readonly="readonly" name="ID" value="<?php echo $ID; ?>" /></label></td>
                        <td><?php echo $User; ?></td> 
                        <td><?php echo $Host; ?></td> 
                        <td><?php echo $db; ?></td> 
                        <td><?php echo $Command; ?></td> 
                        <td><?php echo $Time; ?></td> 
                        <td><?php echo $State; ?></td> 
                        <td><?php echo $Info; ?></td> 
                        <td>
                            <form class="kill" 
                                  name="kill<?php echo $ID ?>" 
                                  method="get" action="/status.php"
                                  id="kill<?php echo $ID ?>">
                                <input type="hidden" name="capt" value="<?php echo $capt ?>"> 
                                <input type="submit" name="go" value="KILL">
                            </form>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <table class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>Table</th>
                    <th>Rows</th>
                    <th>Data</th>
                    <th>Index</th>
                    <th>D/I</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                foreach ($resultTable as $row) {
                    $Table = $row[2];
                    $Rows = $row[7];
                    $Data = $row[9];
                    $Index = $row[11];
                    $DI = $Data / ($Index + 1);
                    ?>
                    <tr>
                        <td><?php echo $Table; ?></td> 
                        <td><?php echo $Rows; ?></td> 
                        <td><?php echo $Data; ?></td> 
                        <td><?php echo $Index; ?></td> 
                        <td><?php echo $DI; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html> 
