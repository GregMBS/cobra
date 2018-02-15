<?php
require_once 'views/ViewClass.php';
$view = new ViewClass();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>INFONAVIT Visita Data</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css">
    </head>
    <body>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <form  action="upload.php?capt=<?php echo $capt; ?>" method="POST" 
               enctype="multipart/form-data">
            <label for="archivo">Archivo: </label>
            <input type="file"  name="file" id="archivo">
            <input type="hidden" name="captp" value="<?php echo $capt; ?>">
            <input type= "submit" value ="Upload" >

        </form>
        <?php
        if (isset($gestion)) {
            echo $view->Table($gestion);
        } 
        ?>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#classy').dataTable({
                    "bPaginate": false
                });
            });
        </script>
    </body>
</html>
