<!DOCTYPE html>
<html>
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
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <table summary="Processlist" class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>ID</a></th>
                    <th>User</a></th>
                    <th>Host</a></th>
                    <th>db</a></th>
                    <th>Command</a></th>
                    <th>Time</a></th>
                    <th>State</a></th>
                    <th>Info</a></th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                $j = 0;

                foreach ($result as $row) {
                    $j = $j + 1;
                    $ID = $row[0];
                    $User = $row[1];
                    $Host = $row[2];
                    $db = $row[3];
                    $Command = $row[4];
                    $Time = $row[5];
                    $State = $row[6];
                    $Info = $row[7];
                    ?>
                    <tr>
                        <td><input type="text" readonly="readonly" name="ID" value="<?php echo $ID; ?>" /></td> 
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
                                  method="get" action="status.php" 
                                  id="kill<?php echo $ID ?>">
                                <input type="hidden" name="capt" value="<?php echo $capt ?>"> 
                                <input type="submit" name="go" value="KILL">
                            </form>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <table summary="Processlist" class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>Table</a></th>
                    <th>Rows</a></th>
                    <th>Data</a></th>
                    <th>Index</a></th>
                    <th>D/I</a></th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                foreach ($resulttab as $row) {
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