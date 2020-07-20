<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Horarios</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <style type="text/css">
            tr:hover {background-color: #ffff00;}
            .heavy {font-weight:bold;font-size:10pt;}
            .heavytot {font-weight:bold;font-size:10pt;text-align:right;}
            .light {text-align:right;}
            .zeros {color:red;}
        </style>
    </head>
    <body>
        <h2>HORARIOS</h2>
        <div>
            <form action='/horarios_clean2.php' method='get'>
                <select name='gestor'>
                    <?php
                    foreach ($resultnom as $answernom) {
                        $nombre = $answernom['c_cvge'];
                        ?>
                        <option value='<?php echo $nombre; ?>'><?php echo $nombre; ?></option>
                    <?php } ?>
                    <option value='total'>total</option>
                </select>
                <input type='hidden' name='capt' value='<?php echo $capt; ?>'>'
                <input type='submit' name='go' value='gestor'>'
            </form>
        </div>
        <?php if ($go == 'gestor') { ?>
            <div>
                <table class="ui-widget">
                    <?php
                    for ($i = 1; $i <= $dhoy; $i++) {
                        $tsumt[$i] = 0;
                        $tsumb[$i] = 0;
                        $tsumbn[$i] = 0;
                        $tsumg[$i] = 0;
                        $tsumgt[$i] = 0;
                        $tsumct[$i] = 0;
                        $tsumnct[$i] = 0;
                        $tsumpp[$i] = 0;
                        $tsump[$i] = 0;
                    }
                    ?>
                    <thead class="ui-widget-header">
                        <tr>
                            <?php
                            require_once 'horariosViewCommon.php';
                                ?>
                            <td class="heavy"><?php echo $sumct; ?></td>
                        </tr>
                        <tr><td class="heavy">NO CONTACTOS</td>
                            <?php
                            $sumnct = 0;
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($nct[$i] == 0) {
                                    echo ' zeros';
                                }
                                ?>"><?php echo $nct[$i]; ?></td>
                                    <?php
                                    $sumnct = $sumnct + $nct[$i];
                                    $tsumnct[$i] = $tsumnct[$i] + $nct[$i];
                                    ?>
                                <?php }
                                ?>
                            <td class="heavy"><?php echo $sumnct; ?></td>
                        </tr>
                        <tr><td class="heavy">PROMESAS</td>
                            <?php
                            $sumpp = 0;
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($prom[$i] == 0) {
                                    echo ' zeros';
                                }
                                ?>">
                                    <a href='<?php echo strtolower('pdh.php?capt=' . $capt . '&i=' . $prom[$i] . '&gestor=' . $gestor . '&fecha=' . $yr . '-' . $mes . '-' . $i); ?>'>
                                        <?php echo $prom[$i]; ?></a></td>
                                <?php
                                $sumpp = $sumpp + $prom[$i];
                                $tsumpp[$i] = $tsumpp[$i] + $prom[$i];
                                ?>
                            <?php }
                            ?>
                            <td class="heavy"><?php echo $sumpp; ?></td>
                        </tr>
                        <tr><td class="heavy">PAGOS</td>
                            <?php
                            $sump = 0;
                            for ($i = 1; $i <= $dhoy; $i++) {
                                ?>
                                <td class="light<?php
                                if ($pag[$i] == 0) {
                                    echo ' zeros';
                                }
                                ?>"><?php echo $pag[$i]; ?></td>
                                    <?php
                                    $sump = $sump + $pag[$i];
                                    $tsump[$i] = $tsump[$i] + $pag[$i];
                                    ?>
                                <?php }
                                ?>
                            <td class="heavy"><?php echo $sump; ?></td>
                        </tr>
                        <tr style="height:2em"></tr>
                        </tbody>
                </table>
            <?php } ?>
        </div>
    </body>
</html>

