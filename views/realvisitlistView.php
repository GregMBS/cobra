<!DOCTYPE html>
    <html lang='es'>
        <head>
            <title>Visitas</title>
            <meta charset="utf-8">
            <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
            <style>
                th {width: 9em;}
                td {width:10em;}
            </style>
            <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
            <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        </head>
        <body>
            <div id="historybox">
                <table class="ui-widget" id="historyhead">
                    <thead class="ui-widget-header">
                        <tr>
                            <?php
                            for ($j = 0; $j < 4; $j++) {
                                $fieldname = $fieldnames[$j];
                                ?>
                                <th<?php echo ' class="' . $fieldSize[$j] . '"'; ?>><?php
                                    if (isset($fieldname)) {
                                        echo $fieldname;
                                    }
                                    ?></th> <?php
                            }
                            ?></tr>
                    </thead>
                    <tbody class="ui-widget-content"><?php
                        $j = 0;
                        $c = 0;
                        foreach ($rowsub as $answer) {
                            $auto = $answer['auto'];
                            $gestor = utf8_encode($answer['gestor']);
                            $gestion = utf8_encode($answer['c_obse1']);
                            ?>
                            <tr>
                                <?php
                                for ($k = 0; $k < 4; $k++) {
                                    $field = $fields[$k];
                                    $anku = utf8_encode($answer[$field]);
                                    if (is_null($anku)) {
                                        $anku = "&nbsp;";
                                    }
                                    $ank = str_replace('00:00:00', '', $anku);
                                    $jscode = '';
                                    if ($field == "short") {
                                        $jscode1 = " onClick='alert(";
                                        $jscode2 = ")'";
                                        $jscode = $jscode1 . '"' . preg_replace("[\n\r]", " ", $gestion) . '"' . $jscode2;
                                    }
                                    ?>
                                    <td<?php
                                    if ($c == 1) {
                                        echo " style='background-color:#dddddd'";
                                    }
                                    echo ' class="' . $fieldSize[$k] . '"' . $jscode;
                                    ?>>
                                            <?php
                                            if (isset($ank)) {
                                                echo $ank;
                                            }
                                            ?>
                                    </td>
                                    <?php
                                } $c = 1 - $c;
                                ?>
                            </tr>
                            <?php
                            $j++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    <button onClick='window.close()'>CIERRA</button>
</body>
</html> 

