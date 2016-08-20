<p>
<form action="carga2.php" method="post" name="assoc">
    <input name="cliente" type="hidden" value="<?php
    echo $cliente
    ?>" />
    <input name="fecha_de_actualizacion" type="hidden" value="<?php
    echo $fecha_de_actualizacion
    ?>" />
    <input type="hidden" name="filename" value='<?php
    echo $filename
    ?>' />
    <input type="hidden" name="capt" value="<?php echo $capt ?>" />
</p>
<p>
<table summary="Nuevo campos">
    <?php
    $querypdex = "select position from cargadex where cliente='" . $cliente . "';";
    $resultpdex = $con->query($querypdex) or die($con->error);
    $numdex = 0;

    while ($answerpdex = $resultpdex->fetch_row()) {
        $numdex++;
    }

    if ($numdex == 0) {

        for ($c = 0; $c < $num; $c++) {

            if (!empty($data[$c])) {
                ?>
                <tr><td><?php
                        echo trim($data[$c])
                        ?></td>
                    <td>
                        <select name="pos<?php
                        echo $c
                        ?>">
                            <option value='nousar<?php echo $c ?>'>no usar</option>
                            <?php
                            $queryres = "show columns from resumen";
                            $resultres = $con->query($queryres) or die($con->error);
                            $k = 0;

                            while ($answerres = $resultres->fetch_row()) {
                                ?>
                                <option value='<?php echo $k ?>'<?php
                                if (trim($data[$c]) == $answerres[0]) {
                                    echo " selected='selected'";
                                }
                                ?>><?php echo $answerres[0]; ?></option>
                                        <?php
                                        $k++;
                                    }
                                    ?>
                        </select></td></tr>
                <?php
            } else {
                ?>
                <input type="hidden" value="nousar" name="pos<?php
                echo $c
                ?>"/>
                       <?php
                   }
               }
           } else {
               $querydex = "select * from cargadex where cliente='" . $cliente . "';";
               $resultdex = $con->query($querydex) or die($con->error);
               $c = 0;

               while ($answerdex = $resultdex->fetch_row()) {
                   echo $data[$c] . " " . $answerdex[1] . " " . $answerdex[2] . " " . $answerdex[3] . "<br>";
                   $c++;
               }
           }
           fclose($handle);
           ?>
    </p>
    <p>
        <input type="hidden" name="maxc" value="<?php echo $c ?>" />
        <input type="hidden" name="capt" value="<?php echo $capt ?>" />
        <input type="submit" name="go" value="asociar" />
    </p>
</form>
