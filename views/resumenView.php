<!DOCTYPE html>
<html lang="es">
<head>
    <title>Resumen</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" href="/css/resumen.css" />
    <style>
        <?php if ($notalert > 0) { ?>
        #notasq input {
            background-color: #ff0000;
        }

        <?php
        }
        if ($pagalert > 0) {
        ?>
        #pagos input {
            background-color: #ff0000;
        }

        <?php
        }
        if ((preg_match('/-/', $status_de_credito)) && ($mytipo <> 'admin')) {
        ?>
        #GUARDbutt {
            display: none;
        }

        <?php } ?>
        <?php if ($mytipo == 'visitador') { ?>
        #dataBox, #clock {
            display: none;
        }

        <?php } ?>
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    <SCRIPT>
        function aviso() {
        }

        function paging(pageid) {
            document.getElementById("TELEFONOS").style.display = "none";
            document.getElementById("REFERENCIAS").style.display = "none";
            document.getElementById("LABORAL").style.display = "none";
            document.getElementById("CONTABLES").style.display = "none";
            document.getElementById("MISCELANEA").style.display = "none";
            document.getElementById("VISITA").style.display = "none";
            document.getElementById("HISTORIA").style.display = "none";
            document.getElementById(pageid).style.display = "block";
            if (document.getElementById("GESTION")) {
                document.getElementById("GESTION").style.display = "block";
            }
            if (pageid === "VISITA") {
                document.getElementById("GESTION").style.display = "none";
            }
            <?php
            if (empty($flag)) {
                $flag = 0;
            }
            if ($flag > 0) {
            /** @var string $flagmsg */
            ?>
            alert("<?php echo $flagmsg; ?>\nBuscar para checar que gestion de cuenta <?php echo $CUENTA; ?> está guardado corectamente.");
            <?php } ?>
        }

        function clock() {
            const d = new Date();
            const tn = d.getTime();
            const tll = new Date('<?php echo $tl; ?>');
            const tl = tll.getTime();
            document.getElementById("timer").value = tn - tl;
            document.getElementById("timers").value = (parseInt(document.getElementById("timer").value) / 1000) % 60;
            document.getElementById("timerMin").value = parseInt(document.getElementById("timer").value) / 1000 / 60;
            if (document.getElementById("timerMin").value > 2) {
                document.getElementById("clock").style.backgroundColor = "yellow";
            }
            if (document.getElementById("timerMin").value > 4) {
                document.getElementById("clock").style.backgroundColor = "red";
            }
            if (document.getElementById("timer").value % 2 === 0) {
                document.getElementById("clock").style.backgroundColor = "green";
            }
        }

        function openSearch() {
            setInterval('clock()', 1000);
            <?php
            if ($qcount > 1) {
            ?>
            alert("ERROR RA3 - Hay <?php echo $qcount; ?> cuentas con este número.");
            <?php
            }
            if ($notalert == 1) {
            /**
             * @var string $notalertt
             * @var string $alertcuenta
             */
            ?>
            const goalert = confirm("Tiene alerta pendiente <?php echo $notalertt; ?> para cuenta <?php echo $alertcuenta; ?> Quiere verlo?");
            if (goalert) {
                window.location = "resumen.php?find=<?php echo $alertcuenta; ?>&field=numero_de_cuenta&capt=<?php echo $capt; ?>&go=FROMALERT&from=resumen.php&go1=FROMALERT";
            }
            <?php
            }
            if ((preg_match('/[dv]o$/', $status_de_credito)) || (preg_match('/[dv]o$/',
            $status_de_credito))) {
            ?>
            alert("Esta cuenta está <?php echo $status_de_credito ?>");
            <?php
            }
            if ($lockflag == 0) {
            $nn = 0;
            $highlight = filter_input(INPUT_GET, 'highlight',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $hFind = filter_input(INPUT_GET, 'hFind',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (empty($highlight)) {
                $xField[0] = '';
                $xFind = '';
            } else {
                $xField[0] = $highlight;
                $xFind = "/" . $hFind . "/";
            }
            $oField = $xField[0];
            if (($oField == 'TELS') && (preg_match($xFind, $tel_1))) {
                $xField[$nn] = 'tel_1';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_2))) {
                $xField[$nn] = 'tel_2';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_3))) {
                $xField[$nn] = 'tel_3';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_4))) {
                $xField[$nn] = 'tel_4';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind,
                    $tel_1_alterno))) {
                $xField[$nn] = 'tel_1_alterno';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind,
                    $tel_2_alterno))) {
                $xField[$nn] = 'tel_2_alterno';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind,
                    $tel_3_alterno))) {
                $xField[$nn] = 'tel_3_alterno';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind,
                    $tel_4_alterno))) {
                $xField[$nn] = 'tel_4_alterno';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_1_verif))) {
                $xField[$nn] = 'tel_1_verif';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_2_verif))) {
                $xField[$nn] = 'tel_2_verif';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_3_verif))) {
                $xField[$nn] = 'tel_3_verif';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_4_verif))) {
                $xField[$nn] = 'tel_4_verif';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind,
                    $tel_1_laboral))) {
                $xField[$nn] = 'tel_1_laboral';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind,
                    $tel_2_laboral))) {
                $xField[$nn] = 'tel_2_laboral';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_1_ref_1))) {
                $xField[$nn] = 'tel_1_ref_1';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_2_ref_1))) {
                $xField[$nn] = 'tel_2_ref_1';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_1_ref_2))) {
                $xField[$nn] = 'tel_1_ref_2';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_2_ref_2))) {
                $xField[$nn] = 'tel_2_ref_2';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_1_ref_3))) {
                $xField[$nn] = 'tel_1_ref_3';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_2_ref_3))) {
                $xField[$nn] = 'tel_2_ref_3';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_1_ref_4))) {
                $xField[$nn] = 'tel_1_ref_4';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind, $tel_2_ref_4))) {
                $xField[$nn] = 'tel_2_ref_4';
                $nn = $nn + 1;
            }
            if (($oField == 'TELS') && (preg_match($xFind,
                    $telefonos_marcados))) {
                $xField[$nn] = 'telefonos_marcados';
                $nn = $nn + 1;
            }
            if (($oField == 'REFS') && (preg_match($xFind,
                    $nombre_deudor_alterno))) {
                $xField[$nn] = 'nombre_deudor_alterno';
                $nn = $nn + 1;
            }
            if (($oField == 'REFS') && (preg_match($xFind,
                    $nombre_referencia_1))) {
                $xField[$nn] = 'nombre_referencia_1';
                $nn = $nn + 1;
            }
            if (($oField == 'REFS') && (preg_match($xFind,
                    $nombre_referencia_2))) {
                $xField[$nn] = 'nombre_referencia_2';
                $nn = $nn + 1;
            }
            if (($oField == 'REFS') && (preg_match($xFind,
                    $nombre_referencia_3))) {
                $xField[$nn] = 'nombre_referencia_3';
                $nn = $nn + 1;
            }
            if (($oField == 'REFS') && (preg_match($xFind,
                    $nombre_referencia_4))) {
                $xField[$nn] = 'nombre_referencia_4';
                $nn = $nn + 1;
            }
            if ($oField == 'ROBOT') {
                $xField[$nn] = 'historyBody';
                $nn = $nn + 1;
            }
            $n = 0;
            while (isset($xField[$n])) {
            if (!empty($xField[$n])) {
            ?>
            document.getElementById("<?php echo $xField[$n] ?>").style.backgroundColor = "yellow";
            document.getElementById("<?php echo $xField[$n] ?>").style.fontWeight = "bold";
            document.getElementById("<?php echo $xField[$n] ?>").parentElement.style.display = "block";
            <?php
            }
            $n++;
            }
            }
            if ($lockflag == 1) {
            /** @var string $locker */
            ?>
            alert("ERROR RA4 - Esta record está en uso de <?php echo $locker ?>");
            <?php } ?>
        }

        const r = {
            'special': /[\W]/g,
            'quotes': /['"]/g,
            'notnumbers': /[^\d]/g
        };

        function valid(o, w) {
            o.value = o.value.replace(r[w], ' ');
        }

        /**
         *
         * @param campo
         * @returns {boolean}
         */
        function tooLong(campo) {
            if (window.document.getElementById(campo).value.length > 250) {
                window.document.getElementById(campo).value = window.document.getElementById(campo).value.replace('  ', ' ');
                window.document.getElementById(campo).value = window.document.getElementById(campo).value.substr(0, 200);
                confirm('GESTION demasiado largo');
                window.document.getElementById(campo).style.backgroundColor = "yellow";
                return false;
            }
        }

        function showsearch() {
            document.getElementById('searchBox').style.display = "block";
            document.getElementById('find').focus();
        }

    </SCRIPT>
    <script src="/js/resumen.js"></script>
    <script src="/js/depuracion.js"></script>
    <script src="/js/depuracionv.js"></script>
</head>
<body onLoad="alertTxt = '';
                paging('HISTORIA');
                openSearch();
                aviso();" id="todos">
<div id="buttonBox">
    <?php if (($go == 'FROMULTIMA') || ($go == 'FROMBUSCAR')) { ?>
        <form class="buttons" name="seg" method="get" action=
        "/resumen.php" id="segid">
            <input type="hidden" name="capt" value="<?php echo $capt ?>">
            <input type="hidden" name="find" value="<?php echo $id_cuenta ?>">
            <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
            <input type="submit" name="go" value="REINTRO QUEUE"></form>
    <?php } ?>
    <form class="buttons" name="ultima" method="get" action=
    "/resumen.php" id="ultima">
        <input type="hidden" name="capt" value="<?php echo $capt ?>">
        <!--                    <input type="hidden" name="find" value="<?php echo $id_cuenta ?>">
                    <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
                    -->
        <input type="submit" name="go" value="ULTIMA"></form>
    <form class="buttons" name="buscar" action="/resumen.php" id="buscar">
        <button type="button" value="buscar" onclick=
        "showsearch();">BUSCAR
        </button>
    </form>
    <form class="buttons" name="migo" method="get" action=
    "migo<?php
    if (($mytipo == 'admin') && (substr($cr, 0, 4) != 'SELF')) {
        echo 'admin';
    }
    ?>.php" id="migo">
        <input type="hidden" name="find" value="<?php echo $tcapt ?>">
        <input type="hidden" name="capt" value="<?php echo $capt ?>">
        <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
        <input type="submit" name="go" value="CUENTAS"></form>
    <form class="buttons" name="visitlist" method="get" action=
    "/realvisitlist.php" id="visitlist" target="_blank">
        <input type="hidden" name="capt" value="<?php echo $capt ?>">
        <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
        <input type="hidden" name="ejecutivo_asignado_call_center"
               value="<?php echo $ejecutivo_asignado_call_center ?>">
        <input type="submit" name="go" value="VISITAS"></form>
    <form class="buttons" name="rotas" method="get" action=
    "/rotas.php" id="rotas">
        <input type="hidden" name="capt" value="<?php echo $capt ?>">
        <input type="submit" name="go" value="PROMESAS"></form>
    <?php
    if ($hasPic) { ?>
        <form action="<?php echo $picFile; ?>" target="_blank">
            <input type="submit" value="Foto">
        </form>
        <?php
    }
    if ($id_cuenta > 0) {
        ?>
        <form class="buttons" name="pagos" method="get" action="/pagos.php" id="pagos" target="_blank">
            <input type="hidden" name="capt" value="<?php
            if (isset($capt)) {
                echo $capt;
            }
            ?>">
            <input type="hidden" name="id_cuenta" value="<?php
            echo $id_cuenta;
            ?>">
            <input type="submit" name="go" value="PAGOS"></form>
    <?php } ?>
    <?php $CTA = $numero_de_credito; ?>
    <form class="buttons" name="notasq" method="get" action="/notas.php" id="notas" target="_blank"><input type="hidden"
                                                                                                           name="capt"
                                                                                                           value="<?php
                                                                                                           if (isset($capt)) {
                                                                                                               echo $capt;
                                                                                                           }
                                                                                                           ?>">
        <input type="hidden" name="CUENTA" value="<?php
        if (isset($numero_de_cuenta)) {
            echo $numero_de_cuenta;
        }
        ?>">
        <input type="hidden" name="C_CONT" value="<?php
        if (isset($id_cuenta)) {
            echo $id_cuenta;
        }
        ?>">
        <input type="submit" name="go" value="NOTAS"></form>
    <form class="buttons" name="queuesg" method="get" action=
    "/queuesg.php" id="queuesg">
        <input type="hidden"
               name="mytipo" value="<?php
        if (isset($mytipo)) {
            echo $mytipo;
        }
        ?>">
        <input type="hidden"
               name="capt" value="<?php
        if (isset($capt)) {
            echo $capt;
        }
        ?>">
        <input type="submit" name="go" value="QUEUES"></form>
    <form class="buttons" name="logout" method="get" action=
    "/resumen.php" id="logout">
        <input type="hidden" name="capt" value="<?php
        if (isset($capt)) {
            echo $capt;
        }
        ?>">
        <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
        <input type="submit" name="go" value="LOGOUT"></form>
    <?php
    if (empty($cliente)) {
        $cliente = '';
    }
    ?>
    <button><?php echo $cliente . ' ' . $sdc . ' ' . $cr ?></BUTTON>
    <?php
    if ($mytipo == 'admin') {
        ?>
        <form action="/reports.php" method="get">
            <input type="hidden" name="capt" value="<?php echo $capt; ?>">
            <input type="submit" value="REPORTES">
        </form>
    <?php } ?>

    <span style='font-weight:bold;font-size:120%;'><?php echo $capt; ?></span>
    <?php if (!empty($cliente)) { ?>
        <span onmouseover='this.style.visibility = "hidden";'><img style="position:absolute;top:0;right:0" height=50
                                                                   alt="client logo" src='logos/<?php
            echo
            $cliente;
            ?>.jpg'></span>
    <?php } ?>
    <form class="buttons" name="trouble" method="get" action="/trouble.php" id="trouble" target="_blank">
        <input type="hidden" name="capt" value="<?php
        if (isset($capt)) {
            echo $capt;
        }
        ?>">
        <input type="submit" name="go" value="ERROR">
    </form>
    <?php
    include 'privacidadInclude.php';
    ?>

</div>
<div class="clearBox">
    <UL class='tabs'>
        <LI><A onClick="paging('TELEFONOS')">TELEFONOS</A></LI>
        <LI><A onClick="paging('REFERENCIAS')">REFERENCIAS</A></LI>
        <LI><A onClick="paging('LABORAL')">LABORAL</A></LI>
        <LI><A onClick="paging('CONTABLES')">CONTABLES</A></LI>
        <LI><A onClick="paging('MISCELANEA')">MISCELÁNEA</A></LI>
        <LI><A onClick="paging('VISITA')">CAPTURA VISITA</A></LI>
        <LI><A onClick="paging('HISTORIA')">HISTORIA</A></LI>
    </UL>
</div>
<form action="/resumen.php" method="post" name="resumenForm" id="resumenForm">
    <div id="GENERAL">
        <table id="demograficas">
            <tr>
                <td>
                    <label class='formLabel' for='nombre_deudor'>Deudor</label>
                    <input type='text' size=80 style='width:12cm'
                           name=nombre_deudor id="nombre_deudor"
                           readonly='readonly' value='<?php
                    if (isset($nombre_deudor)) {
                        echo htmlentities($nombre_deudor);
                    }
                    ?>'><br>
                </td>
                <td>
                    <label class='formLabel' for='domicilio_deudor'>Domicilio</label>
                    <textarea name=domicilio_deudor id=domicilio_deudor readonly='readonly' rows=4 cols=20>
                                    <?php echo $domicilio_deudor . "\n" . $colonia_deudor . "\n" . $ciudad_deudor . ", " . $estado_deudor . '  ' . $cp_deudor; ?>
                                    <?php
                                    if (isset($domicilio_deudor_2)) {
                                        echo "\n o \n" . $domicilio_deudor_2;
                                    }
                                    ?>
                                </textarea><br>
                    <?php if (!empty($direccion_nueva)) { ?>
                        <label class='formLabel' for="direccion_nueva">Dirección nueva</label>
                        <input type='text' id=direccion_nueva name=direccion_nueva readonly='readonly'
                               value='<?php echo $direccion_nueva; ?>'>
                        <br>
                        <?php
                    }
                    if (substr($cliente, 0, 9) == "INFONAVIT") {
                        ?>
                        <label class='formLabel' for="nss">NSS</label>
                        <input type='text' id=nss name=nss readonly='readonly' value='<?php
                        if (isset($nss)) {
                            echo $nss;
                        }
                        ?>'><br>
                        <?php
                    }
                    if (!empty($avapar)) {
                        ?>
                        <span class='formLabel'>Referencia OXXO</span>
                        <?php echo $avapar; ?><br>
                    <?php } ?>
                </td>
            <tr>
                <td>
                    <label class='formLabel' for="ejecutivo_asignado_call_center">Gestor - call center</label>
                    <input type='text' id=ejecutivo_asignado_call_center name=ejecutivo_asignado_call_center
                           readonly='readonly' value='<?php
                    if (isset($ejecutivo_asignado_call_center)) {
                        echo $ejecutivo_asignado_call_center;
                    }
                    ?>'><br>
                    <label class='formLabel' for="numero_de_cuenta">Numero de cuenta</label>
                    <input type='text' name=numero_de_cuenta
                           id="numero_de_cuenta" readonly='readonly'
                           value='<?php
                           if (isset($numero_de_cuenta)) {
                               echo $numero_de_cuenta;
                           }
                           ?>'><br>
                    <label class='formLabel' for="status_aarsa">Status de cuenta</label>
                    <input type='text' id=status_aarsa name=status_aarsa
                           readonly='readonly' value='<?php
                    if (isset($status_aarsa)) {
                        echo $status_aarsa;
                    }
                    ?>'><br>
                    <?php echo $gestiones; ?> gestiones<br>
                    <?php echo $promesas; ?> promesas<br>
                    <?php echo $pagos; ?> pagos<br>
                </td>
                <td>
                    <div id='clock'>
                        <input type="hidden" name="timer" id="timer" readonly="readonly" value="0">:
                        <input type="text" name="timerMin" id="timerMin" readonly="readonly" value="0" size="3">:
                        <input type="text" name="timers" id="timers" readonly="readonly" value="0" size="3"><br>
                        <?php
                        $campoColor = " style='background-color:red; color:white;'";
                        $numGestiones = $resultng['cng'] or 0;
                        $numProm = $resultnp['cnp'] or 0;

                        if ($numGestiones > 20) {
                            $campoColor = " style='background-color:yellow; color:black;'";
                        }
                        if ($numGestiones > 40) {
                            $campoColor = " style='background-color:green; color:white;'";
                        }
                        ?>
                        <input type="text"<?php echo $campoColor; ?> name="numgest" id="numgest" readonly="readonly"
                               value="<?php echo $numGestiones . ' gestiones'; ?>">
                        <input type="text" name="numprom" id="numprom" readonly="readonly"
                               value="<?php echo $numProm . ' promesas'; ?>">
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="TELEFONOS">
        <label class='formLabelBig'>Tel Casa</label>
        <input type='text' name=tel_1 id="tel_1" readonly='readonly' value='<?php
        if (isset($tel_1)) {
            echo $tel_1;
        }
        ?>'><br>
        <label class='formLabelBig'>Tel Cel</label>
        <input type='text' name=tel_2 id="tel_2" readonly='readonly' value='<?php
        if (isset($tel_2)) {
            echo $tel_2;
        }
        ?>'><br>
        <label class='formLabelBig'>Tel 3</label>
        <input type='text' name=tel_3 id="tel_3" readonly='readonly' value='<?php
        if (isset($tel_3)) {
            echo $tel_3;
        }
        ?>'><br>
        <label class='formLabelBig'>Tel 4</label>
        <input type='text' name=tel_4 id="tel_4" readonly='readonly' value='<?php
        if (isset($tel_4)) {
            echo $tel_4;
        }
        ?>'><br>
        <label class='formLabelBig'>E-mail</label>
        <input type='text' name=email_deudor readonly='readonly' value='<?php
        if (isset($email_deudor)) {
            echo $email_deudor;
        }
        ?>'><br>
    </div>
    <div id="REFERENCIAS">
        <?php if (isset($nombre_deudor_alterno)) { ?>
            <label class='formLabelSmall'>Recadero</label>
            <input type='text' name=nombre_deudor_alterno
                   id="nombre_deudor_alterno" readonly='readonly' value='<?php
            if (isset($nombre_deudor_alterno)) {
                echo htmlentities($nombre_deudor_alterno);
            }
            ?>'>
            <?php
        }
        if (isset($domicilio_deudor_alterno)) {
            ?>
            <br><label class='formLabelSmall'>Dirección Recadero</label>
            <textarea readonly='readonly'><?php
                echo $domicilio_deudor_alterno . "\n" .
                    $colonia_deudor_alterno . "\n" .
                    $ciudad_deudor_alterno . "\n" .
                    $estado_deudor_alterno;
                ?>
                        </textarea>
            <?php
        }
        if (isset($domicilio_deudor_alterno_2a)) {
            ?>
            <textarea readonly='readonly'><?php
                /**
                 * @var string $colonia_deudor_alterno_2a
                 * @var string $ciudad_deudor_alterno_2a
                 * @var string $estado_deudor_alterno_2a
                 */
                echo $domicilio_deudor_alterno_2a . "\n" .
                    $colonia_deudor_alterno_2a . "\n" .
                    $ciudad_deudor_alterno_2a . "\n" .
                    $estado_deudor_alterno_2a;
                ?>
                        </textarea>
            <?php
        }
        if (isset($parentesco_aval)) {
            ?>
            <input type='text' name=parentesco_aval class='shortinp' readonly='readonly' value='<?php
            if (isset($parentesco_aval)) {
                echo $parentesco_aval;
            }
            ?>'><br>
        <?php } ?>
        <br>
        <?php if (isset($tel_1_alterno)) { ?>
            <label class='formLabelSmall'>Tel Casa</label>
            <input type='text' name=tel_1_alterno id="tel_1_alterno"
                   readonly='readonly' value='<?php
            if (isset($tel_1_alterno)) {
                echo $tel_1_alterno;
            }
            ?>'><br>
            <?php
        }
        if (isset($tel_2_alterno)) {
            ?>
            <label class='formLabelSmall'>Tel Cel</label>
            <input type='text' name=tel_2_alterno id="tel_2_alterno"
                   readonly='readonly' value='<?php
            if (isset($tel_2_alterno)) {
                echo $tel_2_alterno;
            }
            ?>'><br>
            <?php
        }
        if (isset($tel_3_alterno)) {
            ?>
            <label class='formLabelSmall'>Tel 3</label>
            <input type='text' name=tel_3_alterno id="tel_3_alterno"
                   readonly='readonly' value='<?php
            if (isset($tel_3_alterno)) {
                echo $tel_3_alterno;
            }
            ?>'><br>
            <?php
        }
        if (isset($tel_4_alterno)) {
            ?>
            <label class='formLabelSmall'>Tel 4</label>
            <input type='text' name=tel_4_alterno id="tel_4_alterno"
                   readonly='readonly' value='<?php
            if (isset($tel_4_alterno)) {
                echo $tel_4_alterno;
            }
            ?>'><br>
            <?php
        }
        if ($cliente == 'UR') {
            ?>
            <label class='formLabelBig'>Madre</label>
        <?php } else { ?>
            <label class='formLabelSmall'>Ref 1</label>
            <?php
        }
        if (isset($nombre_referencia_1)) {
            ?>
            <input type='text' size=40 name=nombre_referencia_1 id="nombre_referencia_1" readonly='readonly'
                   value='<?php
                   if (isset($nombre_referencia_1)) {
                       echo htmlentities($nombre_referencia_1);
                   }
                   ?>'>
            <?php
        }
        if (isset($referencias_1)) {
            ?>
            <input type='text' name=referencias_1 class='shortinp' readonly='readonly' value='<?php
            if (isset($referencias_1)) {
                echo $referencias_1;
            }
            ?>'><br>
        <?php } ?>
        <br>
        <?php if (isset($tel_1_ref_1)) { ?>
            <label class='formLabelSmall'>Tel Casa</label>
            <input type='text' name=tel_1_ref_1 id="tel_1_ref_1"
                   readonly='readonly' value='<?php
            if (isset($tel_1_ref_1)) {
                echo $tel_1_ref_1;
            }
            ?>'><br>
            <?php
        }
        if (isset($tel_2_ref_1)) {
            ?>
            <label class='formLabelSmall'>Tel Cel</label>
            <input type='text' name=tel_2_ref_1 id="tel_2_ref_1"
                   readonly='readonly' value='<?php
            if (isset($tel_2_ref_1)) {
                echo $tel_2_ref_1;
            }
            ?>'><br>
            <?php
        }
        ?>
        <label class='formLabelSmall'>Ref 2</label>
        <?php if (isset($nombre_referencia_2)) { ?>
            <input type='text' size=40 name=nombre_referencia_2 id="nombre_referencia_2" readonly='readonly'
                   value='<?php
                   if (isset($nombre_referencia_2)) {
                       echo htmlentities($nombre_referencia_2);
                   }
                   ?>'>
            <?php
        }
        if (isset($referencias_2)) {
            ?>
            <input type='text' name=referencias_2 class='shortinp' readonly='readonly' value='<?php
            if (isset($referencias_2)) {
                echo $referencias_2;
            }
            ?>'><br>
        <?php } ?>
        <br>
        <?php if (isset($tel_1_ref_2)) { ?>
            <label class='formLabelSmall'>Tel Casa</label>
            <input type='text' name=tel_1_ref_2 id="tel_1_ref_2"
                   readonly='readonly' value='<?php
            if (isset($tel_1_ref_2)) {
                echo $tel_1_ref_2;
            }
            ?>'><br>
            <?php
        }
        if (isset($tel_2_ref_2)) {
            ?>
            <label class='formLabelSmall'>Tel Cel</label>
            <input type='text' name=tel_2_ref_2 id="tel_2_ref_2"
                   readonly='readonly' value='<?php
            if (isset($tel_2_ref_2)) {
                echo $tel_2_ref_2;
            }
            ?>'><br>
            <?php
        }
        if ($cliente == 'UR') {
            ?>
            <label class='formLabelBig'>Tutor</label>
        <?php } else { ?>
            <label class='formLabelSmall'>Ref 3</label>
            <?php
        }
        if (isset($nombre_referencia_3)) {
            ?>
            <input type='text' size=40 name=nombre_referencia_3 id="nombre_referencia_3" readonly='readonly'
                   value='<?php
                   if (isset($nombre_referencia_3)) {
                       echo htmlentities($nombre_referencia_3);
                   }
                   ?>'>
            <?php
        }
        if (isset($referencias_3)) {
            ?>
            <input type='text' name=referencias_3 class='shortinp' readonly='readonly' value='<?php
            if (isset($referencias_3)) {
                echo $referencias_3;
            }
            ?>'><br>
        <?php } ?>
        <br>
        <?php if (isset($tel_1_ref_3)) { ?>
            <label class='formLabelSmall'>Tel Casa</label>
            <input type='text' name=tel_1_ref_3 id="tel_1_ref_3"
                   readonly='readonly' value='<?php
            if (isset($tel_1_ref_3)) {
                echo $tel_1_ref_3;
            }
            ?>'><br>
            <?php
        }
        if (isset($tel_2_ref_3)) {
            ?>
            <label class='formLabelSmall'>Tel Cel</label>
            <input type='text' name=tel_2_ref_3 id="tel_2_ref_3"
                   readonly='readonly' value='<?php
            if (isset($tel_2_ref_3)) {
                echo $tel_2_ref_3;
            }
            ?>'><br>
            <?php
        }
        if (isset($nombre_referencia_4)) {
            ?>
            <label class='formLabelSmall'>Ref 4</label>
            <input type='text' size=40 name=nombre_referencia_4 id="nombre_referencia_4" readonly='readonly'
                   value='<?php
                   if (isset($nombre_referencia_4)) {
                       echo htmlentities($nombre_referencia_4);
                   }
                   ?>'>
            <?php
        }
        if (isset($referencias_4)) {
            ?>
            <input type='text' name=referencias_4 class='shortinp' readonly='readonly' value='<?php
            if (isset($referencias_4)) {
                echo $referencias_4;
            }
            ?>'><br>
        <?php } ?>
        <br>
        <?php if (isset($tel_1_ref_4)) { ?>
            <label class='formLabelSmall'>Tel Casa</label>
            <input type='text' name=tel_1_ref_4 id="tel_1_ref_4"
                   readonly='readonly' value='<?php
            if (isset($tel_1_ref_4)) {
                echo $tel_1_ref_4;
            }
            ?>'><br>
            <?php
        }
        if (isset($tel_2_ref_4)) {
            ?>
            <label class='formLabelSmall'>Tel Cel</label>
            <input type='text' name=tel_2_ref_4 id="tel_2_ref_4"
                   readonly='readonly' value='<?php
            if (isset($tel_2_ref_4)) {
                echo $tel_2_ref_4;
            }
            ?>'><br>
        <?php } ?>
    </div>

    <div id="LABORAL">
        <label class='formLabelBig'>Empresa</label>
        <input type='text' size=100 name=empresa readonly='readonly' value='<?php
        if (isset($empresa)) {
            echo $empresa;
        }
        ?>'><br>
        <label class='formLabelBig'>Domicilio</label>
        <input type='text' name=domicilio_laboral readonly='readonly' value='<?php
        if (isset($domicilio_laboral)) {
            echo $domicilio_laboral;
        }
        ?>'><br>
        <label class='formLabelBig'>Colonia</label>
        <input type='text' name=colonia_laboral readonly='readonly' value='<?php
        if (isset($colonia_laboral)) {
            echo $colonia_laboral;
        }
        ?>'><br>
        <label class='formLabelBig'>Ciudad Estado</label>
        <input type='text' name=ciudad_laboral readonly='readonly'
               value='<?php
               if (isset($ciudad_laboral)) {
                   echo $ciudad_laboral;
               }
               ?>'><br>
        <br>
        <label class='formLabelBig'>Tel 1</label>
        <input type='text' name=tel_1_laboral id="tel_1_laboral" readonly='readonly'
               value='<?php
               if (isset($tel_1_laboral)) {
                   echo $tel_1_laboral;
               }
               ?>'><br>
        <label class='formLabelBig'>Tel 2</label>
        <input type='text' name=tel_2_laboral id="tel_2_laboral" readonly='readonly'
               value='<?php
               if (isset($tel_2_laboral)) {
                   echo $tel_2_laboral;
               }
               ?>'><br>
    </div>
    <br>

    <div id="CONTABLES">
        <table id="contablesTable">
            <tr>
                <td>Numero de credito</td>
                <td><input type='text' name=numero_de_credito readonly='readonly' value='<?php
                    if (isset($numero_de_credito)) {
                        echo $numero_de_credito;
                    }
                    ?>'></td>
                <td>ID cuenta</td>
                <td><input type='text' name="id_cuenta" id="id_cuenta" readonly='readonly' value='<?php
                    if (isset($id_cuenta)) {
                        echo $id_cuenta;
                    }
                    ?>'></td>
                <?php if (!empty($folio)) { ?>
                <td>Ultimo folio</td>
                <td><input type='text' name="ufolio" id="ufolio" readonly='readonly' value='<?php echo $folio; ?>'/>
                    <?php } ?>
            </tr>
            <tr>
                <td>Fecha de asignacion</td>
                <td><input type='text' name=fecha_de_asignacion readonly='readonly' value='<?php
                    if (isset($fecha_de_asignacion)) {
                        echo $fecha_de_asignacion;
                    }
                    ?>'></td>
                <td>Fecha de actualizacion</td>
                <td><input type='text' name=fecha_de_actualizacion readonly='readonly' value='<?php
                    if (isset($fecha_de_actualizacion)) {
                        echo $fecha_de_actualizacion;
                    }
                    ?>'></td>
                <td>RFC deudor</td>
                <td><input type='text' name=rfc_deudor readonly='readonly' value='<?php
                    if (isset($rfc_deudor)) {
                        echo $rfc_deudor;
                    }
                    ?>'></td>
            </tr>
            <tr>
                <td>Fecha de retiro</td>
                <td><input type='text' name=contrato readonly='readonly' value='<?php
                    if (isset($fecha_de_deasignacion)) {
                        echo $fecha_de_deasignacion;
                    }
                    ?>'></td>
                <td>Saldo cuota</td>
                <td><input type='text' name=saldo_cuota readonly='readonly' value='<?php
                    if (isset($saldo_cuota)) {
                        echo '$' . number_format($saldo_cuota);
                    }
                    ?>'></td>
            </tr>
            <tr>
                <td>Saldo total</td>
                <td><input type='text' name=saldo_total readonly='readonly' value='<?php
                    if (isset($saldo_total)) {
                        echo '$' . number_format($saldo_total);
                    }
                    ?>'></td>
                <?php
                if ($saldo_descuento_1 > 0) {
                    ?>
                    <td>Saldo total sin gastos</td>
                    <td><input type='text' name=saldo_descuento_1 readonly='readonly'
                               value='<?php echo '$' . number_format($saldo_descuento_1); ?>'></td>
                    <?php
                }
                if ($gastos_de_cobranza > 0) {
                    ?>
                    <td>Gastos de Cobranza</td>
                    <td><input type='text' name=gastos_de_cobranza readonly='readonly' value='<?php
                        echo '$' . number_format($gastos_de_cobranza);
                        ?>'></td>
                    <?php
                }

                if ($monto_adeudado > 0) {
                    ?>
                    <td>Monto en Contenci&oacute;n</td>
                    <td><input type='text' name=monto_adeudado readonly='readonly' value='<?php
                        echo '$' . number_format($monto_adeudado);
                        ?>'></td>
                    <?php
                }
                ?>
                <td>% descuento</td>
                <td><input type='text' name=descuento readonly='readonly' value='<?php
                    if ($saldo_descuento_1 > 0) {
                        echo number_format(100 - ($saldo_descuento_2
                                    / $saldo_descuento_1) * 100) . "%";
                    } else {
                        echo number_format(100 - ($saldo_descuento_2
                                    / ($saldo_total + 0.01)) * 100) . "%";
                    }
                    ?>'></td>
                <td>Frecuencia</td>
                <td><input type='text' name=frecuencia readonly='readonly' value='<?php
                    if (isset($frecuencia)) {
                        echo $frecuencia;
                    }
                    ?>'>
                <td>Reestructura</td>
                <td><input type='text' name=contrato readonly='readonly' value='<?php
                    if (isset($contrato)) {
                        echo $contrato;
                    }
                    ?>'>
                </td>
            </tr>
            <tr>
                <td>Saldo vencido</td>
                <td><input type='text' name=saldo_vencido readonly='readonly'
                           value='<?php echo '$' . number_format($saldo_vencido); ?>'></td>
                <td>Saldo descuento</td>
                <td><input type='text' name=saldo_descuento_2 readonly='readonly'
                           value='<?php echo '$' . number_format($saldo_descuento_2); ?>'></td>
                <td>Productos</td>
                <td><input type='text' name=producto readonly='readonly' value='<?php
                    if (!empty($prods)) {
                        echo $prods;
                    } else {
                        echo htmlentities($producto);
                    }
                    ?>'></td>
                <?php
                if (isset($subproducto)) {
                    ?>
                    <td>Subproducto</td>
                    <td><input type='text' name=subproducto readonly='readonly' value='<?php
                        echo htmlentities($subproducto);
                        ?>'></td>
                    <?php
                }
                ?>
            </tr>
            <tr>
                <td>Fecha - ultimo pago</td>
                <td><input type='text' name=fecha_de_ultimo_pago readonly='readonly' value='<?php
                    if (isset($fecha_de_ultimo_pago)) {
                        echo $fecha_de_ultimo_pago;
                    }
                    ?>'></td>
                <td>Monto ultimo pago</td>
                <td><input type='text' name=monto_ultimo_pago readonly='readonly' value='<?php
                    if (isset($monto_ultimo_pago)) {
                        echo '$' . number_format($monto_ultimo_pago);
                    }
                    ?>'></td>
                <?php
                if (isset($cuenta_concentradora_1)) {
                    ?>
                    <td>VIN</td>
                    <td><input type='text' name=subproducto readonly='readonly' value='<?php
                        echo htmlentities($cuenta_concentradora_1);
                        ?>'></td>
                    <?php
                }

                if (isset($nrpp)) {
                    ?>
                    <td>Plaza</td>
                    <td><input type='text' name=subproducto readonly='readonly' value='<?php
                        echo htmlentities($nrpp);
                        ?>'></td>
                    <?php
                }

                if (isset($fecha_convenio)) {
                    ?>
                    <td>Facha convenio</td>
                    <td><input type='text' name=fecha-convenio readonly='readonly' value='<?php
                        echo htmlentities($fecha_convenio);
                        ?>'></td>
                    <?php
                }
                ?>
            </tr>
            <tr>
                <td>Segmento</td>
                <td><input type='text' name=status_de_credito readonly='readonly' value='<?php
                    if (isset($status_de_credito)) {
                        echo $status_de_credito;
                    }
                    ?>'></td>
                <td>Meses vencidos</td>
                <td><input type='text' name=pagos_vencidos readonly='readonly' value='<?php
                    if (isset($pagos_vencidos)) {
                        echo $pagos_vencidos;
                    }
                    ?>'>
                <td>D&iacute;as vencidos</td>
                <td><input type='text' name=dias_vencidos readonly='readonly' value='<?php
                    if (isset($dias_vencidos)) {
                        echo $dias_vencidos;
                    }
                    ?>'><br>
            </tr>
        </table>
    </div>
    <div id="MISCELANEA">
        <label class='formLabelBig'>Telefonos marcados</label>
        <input type='text' name="telefonos_marcados"
               id="telefonos_marcados" readonly='readonly' value='<?php
        if (isset($telefonos_marcados)) {
            echo $telefonos_marcados;
        }
        ?>'><br>
        <label class='formLabelBig'>Tel 1 verificado</label>
        <input type='text' name="tel_1_verif" id="tel_1_verif"
               readonly='readonly' value='<?php
        if (isset($tel_1_verif)) {
            echo $tel_1_verif;
        }
        ?>'><br>
        <label class='formLabelBig'>Tel 2 verificado</label>
        <input type='text' name="tel_2_verif" id="tel_2_verif"
               readonly='readonly' value='<?php
        if (isset($tel_2_verif)) {
            echo $tel_2_verif;
        }
        ?>'><br>
        <label class='formLabelBig'>Tel 3 verificado</label>
        <input type='text' name="tel_3_verif" id="tel_3_verif"
               readonly='readonly' value='<?php
        if (isset($tel_3_verif)) {
            echo $tel_3_verif;
        }
        ?>'><br>
        <label class='formLabelBig'>Tel 4 verificado</label>
        <input type='text' name="tel_4_verif" id="tel_4_verif"
               readonly='readonly' value='<?php
        if (isset($tel_4_verif)) {
            echo $tel_4_verif;
        }
        ?>'><br>
        <label class='formLabelBig'>Tel de ult. contacto</label>
        <input type='text' name="telefono_de_ultimo_contacto"
               readonly='readonly' value='<?php
        if (isset($telefono_de_ultimo_contacto)) {
            echo $telefono_de_ultimo_contacto;
        }
        ?>'><br>
        <label class='formLabelBig'>Ultimo status</label>
        <input type='text' name='ultimo_status_de_la_gestion'
               readonly='readonly' value='<?php
        if (isset($ultimo_status_de_la_gestion)) {
            echo $ultimo_status_de_la_gestion;
        }
        ?>'><br>
    </div>

</form>
<div id="searchBox">
    <h2>Buscar</h2>
    <form name="search" method="get" action=
    "/buscar.php" id="search">Buscar a: <input type=
                                               "text" name="find" id="find"> en <select name="field">
            <option value="numero_de_cuenta">Cuenta</option>
            <option value="numero_de_credito"># del Grupo</option>
            <option value="nombre_deudor">Nombre</option>
            <option value="domicilio_deudor">Direcci&oacute;n</option>
            <option value="TELS">Telefonos</option>
            <option value="ROBOT">Telefonos marcados</option>
            <option value="REFS">Aval/Referencias</option>
            <option value="id_cuenta">Expediente</option>
        </select><br>
        Client = <select name="cliente">
            <option value=" ">Todos</option>
            <?php
            foreach ($resultcl as $clienteList) {
                ?>
                <option value="<?php echo $clienteList[0]; ?>"><?php echo $clienteList[0]; ?>
                </option>
            <?php } ?>
        </select><br>
        <input type="hidden" name="capt" value="<?php
        if (isset($capt)) {
            echo $capt;
        }
        ?>">
        <input type="hidden" name="C_CONT" value="<?php
        if (isset($id_cuenta)) {
            echo $id_cuenta;
        }
        ?>">
        <input type="hidden" name="go" value="BUSCAR">
        <input type="hidden" name="from" value="resumen.php">
        <input type="submit" name="go1" value="BUSCAR">
        <input type="button" name="cancel" onclick="cancelbox('searchbox')"
               value="Cancel">
    </form>
</div>
<div class="toggleBox" id="VISITA">
    <form action="/resumen.php" method="get" id="capturaForm">
        <input type="hidden" name="minprom" readonly="readonly" value="<?php
        echo $saldo_descuento_2 + 0;
        ?>">
        <input type="hidden" name="error" readonly="readonly" value="1">
        <input type="hidden" name="C_HRFI" readonly="readonly" value="<?php
        if (isset($CT)) {
            echo $CT;
        }
        ?>">
        <input type="hidden" name="AUTO" readonly="readonly" value="">
        <input type="hidden" name="find" readonly="readonly" value="<?php
        if (isset($find)) {
            echo $find;
        }
        ?>">
        <input type="hidden" name="field" readonly="readonly" value="<?php
        if (isset($field)) {
            echo $field;
        }
        ?>">
        <input type="hidden" name="capt" readonly="readonly" value="<?php
        if (isset($capt)) {
            echo $capt;
        }
        ?>">
        <input type="hidden" name="camp" readonly="readonly" value="<?php
        if (isset($camp)) {
            echo $camp;
        }
        ?>">
        <input type="hidden" name="neworder" readonly="readonly" value="<?php
        if (isset($neworder)) {
            echo $neworder;
        }
        ?>">
        <input type="hidden" name="C_CVGE" readonly="readonly" value="<?php
        if (isset($C_CVGE)) {
            echo $C_CVGE;
        }
        ?>">
        <input type="hidden" name="C_CVBA" readonly="readonly" value="<?php
        if (isset($cliente)) {
            echo $cliente;
        }
        ?>">
        <input type="hidden" name="C_ATTE" readonly="readonly" value="">
        <input type="hidden" name="C_CONT" readonly="readonly" value="<?php
        if (isset($id_cuenta)) {
            echo $id_cuenta;
        }
        ?>">
        <input type="hidden" name="C_CONTAN" readonly="readonly" value="<?php
        if (isset($status_aarsa)) {
            echo $status_aarsa;
        }
        ?>">
        <input type="hidden" name="CUENTA" id="CUENTA2" readonly="readonly" value="<?php
        if (isset($numero_de_cuenta)) {
            echo $numero_de_cuenta;
        }
        ?>">
        <input type="hidden" name="C_EJE" readonly="readonly" value="<?php
        if (isset($ejecutivo_asignado_call_center)) {
            echo $ejecutivo_asignado_call_center;
        }
        ?>">
        <input type="hidden" name="oldGo" readonly="readonly" value="<?php echo $go; ?>"><br>
        <p>DICTAMEN DOMICILIO PARTICULAR</p>
        <table class='visitable'>
            <tr>
                <th>Tipo:</th>
                <td><label><input type="checkbox" name="domTipo" value="casa" id="casa"> Casa</label></td>
                <td><label><input type="checkbox" name="domTipo" value="departamento" id="departamento">
                        Departamento</label></td>
                <td><label><input type="checkbox" name="domTipo" value="terreno" id="terreno"> Terreno</label></td>
                <td><label><input type="checkbox" name="domTipo" value="trabajo" id="trabajo"> Trabajo/Oficina</label>
                </td>
            </tr>
            <tr>
                <th>Propio:</th>
                <td><label><input type="checkbox" name="domOwn" value="propio" id="propio"> Propio</label></td>
                <td><label><input type="checkbox" name="domOwn" value="rentado" id="rentado"> Rentado</label></td>
                <td><label><input type="checkbox" name="domOwn" value="abandonado" id="abandonado"> Abandonado</label>
                </td>
                <td><label><input type="checkbox" name="domOwn" value="deshabilitado" id="deshabilitado"> Deshabilitado</label>
                </td>
                <td><label><input type="checkbox" name="domOwn" value="invadido" id="invadido"> Invadido</label></td>
                <td><label><input type="checkbox" name="domOwn" value="prestado" id="prestado"> Prestado</label></td>
                <td><label><input type="checkbox" name="domOwn" value="laborando" id="laborando"> Laborando</label></td>
            </tr>
            <tr>
                <th>Nivel:</th>
                <td><label><input type="checkbox" name="C_NSE" value="alto" id="alto">Alto</label></td>
                <td><label><input type="checkbox" name="C_NSE" value="medio" id="medio">Medio</label></td>
                <td><label><input type="checkbox" name="C_NSE" value="bajo" id="bajo">Bajo</label></td>
            </tr>
            <tr>
                <th>Estado:</th>
                <td><label><input type="checkbox" name="domStat" value="malo" id="malo">Malo</label></td>
                <td><label><input type="checkbox" name="domStat" value="regular" id="regular">Regular</label></td>
                <td><label><input type="checkbox" name="domStat" value="bueno" id="bueno">Bueno</label></td>
                <td><label><input type="checkbox" name="domStat" value="excelente" id="excelente">Excelente</label></td>
            </tr>
        </table>
        <p>SE&Ntilde;AS:</p>
        <label class="formLabelBig" for="C_CFAC">Color:</label>
        <select id="C_CFAC" name="C_CFAC">
            <option value="no">No especifica</option>
            <option value="Amarilla">Amarilla</option>
            <option value="Azul">Azul</option>
            <option value="Beige">Beige</option>
            <option value="Blanca">Blanca</option>
            <option value="Cafe">Cafe</option>
            <option value="Cantera">Cantera</option>
            <option value="Celeste">Celeste</option>
            <option value="Crema">Crema</option>
            <option value="Forja">Forja</option>
            <option value="Gris">Gris</option>
            <option value="Ladrillo">Ladrillo</option>
            <option value="Madera">Madera</option>
            <option value="Melon">Melon</option>
            <option value="Metalica">Metalica</option>
            <option value="Morada">Morada</option>
            <option value="Naranja">Naranja</option>
            <option value="Negra">Negra</option>
            <option value="Roja">Roja</option>
            <option value="Rosa">Rosa</option>
            <option value="Verde">Verde</option>
        </select><br>
        <label class="formLabelBig" for="C_CPTA">Puerta:</label>
        <select id="C_CPTA" name="C_CPTA">
            <option value="no">No especifica</option>
            <option value="no_tiene">No tiene</option>
            <option value="Amarilla">Amarilla</option>
            <option value="Azul">Azul</option>
            <option value="Beige">Beige</option>
            <option value="Blanca">Blanca</option>
            <option value="Cafe">Cafe</option>
            <option value="Celeste">Celeste</option>
            <option value="Crema">Crema</option>
            <option value="Forja">Forja</option>
            <option value="Gris">Gris</option>
            <option value="Ladrillo">Ladrillo</option>
            <option value="Madera">Madera</option>
            <option value="Melon">Melon</option>
            <option value="Metalica">Metalica</option>
            <option value="Morada">Morada</option>
            <option value="Naranja">Naranja</option>
            <option value="Negra">Negra</option>
            <option value="Roja">Roja</option>
            <option value="Rosa">Rosa</option>
            <option value="Verde">Verde</option>
        </select><br>
        <label class="formLabelBig" for="C_CREJ">Reja/Barandal:</label>
        <select id="C_CREJ" name="C_CREJ">
            <option value="no">No especifica</option>
            <option value="No">No tiene</option>
            <option value="Amarilla">Amarilla</option>
            <option value="Azul">Azul</option>
            <option value="Beige">Beige</option>
            <option value="Blanca">Blanca</option>
            <option value="Cafe">Cafe</option>
            <option value="Celeste">Celeste</option>
            <option value="Crema">Crema</option>
            <option value="Gris">Gris</option>
            <option value="Ladrillo">Ladrillo</option>
            <option value="Madera">Madera</option>
            <option value="Melon">Melon</option>
            <option value="Metalica">Metalica</option>
            <option value="Morada">Morada</option>
            <option value="Naranja">Naranja</option>
            <option value="Negra">Negra</option>
            <option value="Roja">Roja</option>
            <option value="Rosa">Rosa</option>
            <option value="Verde">Verde</option>
        </select><br>
        <label class="formLabelBig" for="C_CPAT">Patio/Jard&iacute;n:</label>
        <select id="C_CPAT" name="C_CPAT">
            <option value="no">No especifica</option>
            <option value="si">S&iacute;</option>
            <option value="no">No</option>
        </select><br>
        <label class="formLabelBig" for="C_CNIV">Pisos:</label>
        <select id="C_CNIV" name="C_CNIV">
            <option value="planta baja">planta baja</option>
            <option value="planta alta">planta alta</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value=">3">>3</option>
        </select><br>
        <p>DATOS DE LA GESTION</p>
        <label class="formLabelBig" for="C_VH">Hora:</label>
        <SELECT id="C_VH" NAME="C_VH">
            <OPTION VALUE=0>0</option>
            <OPTION VALUE=1>1</option>
            <OPTION VALUE=2>2</option>
            <OPTION VALUE=3>3</option>
            <OPTION VALUE=4>4</option>
            <OPTION VALUE=5>5</option>
            <OPTION VALUE=6>6</option>
            <OPTION VALUE=7>7</option>
            <OPTION VALUE=8>8</option>
            <OPTION VALUE=9>9</option>
            <OPTION VALUE=10>10</option>
            <OPTION VALUE=11>11</option>
            <OPTION VALUE=12>12</option>
            <OPTION VALUE=13>13</option>
            <OPTION VALUE=14>14</option>
            <OPTION VALUE=15>15</option>
            <OPTION VALUE=16>16</option>
            <OPTION VALUE=17>17</option>
            <OPTION VALUE=18>18</option>
            <OPTION VALUE=19>19</option>
            <OPTION VALUE=20>20</option>
            <OPTION VALUE=21>21</option>
            <OPTION VALUE=22>22</option>
            <OPTION VALUE=23>23</option>
        </select>:
        <SELECT NAME="C_VMN">
            <OPTION VALUE=00>00</option>
            <OPTION VALUE=01>01</option>
            <OPTION VALUE=02>02</option>
            <OPTION VALUE=03>03</option>
            <OPTION VALUE=04>04</option>
            <OPTION VALUE=05>05</option>
            <OPTION VALUE=06>06</option>
            <OPTION VALUE=07>07</option>
            <OPTION VALUE=08>08</option>
            <OPTION VALUE=09>09</option>
            <OPTION VALUE=10>10</option>
            <OPTION VALUE=11>11</option>
            <OPTION VALUE=12>12</option>
            <OPTION VALUE=13>13</option>
            <OPTION VALUE=14>14</option>
            <OPTION VALUE=15>15</option>
            <OPTION VALUE=16>16</option>
            <OPTION VALUE=17>17</option>
            <OPTION VALUE=18>18</option>
            <OPTION VALUE=19>19</option>
            <OPTION VALUE=20>20</option>
            <OPTION VALUE=21>21</option>
            <OPTION VALUE=22>22</option>
            <OPTION VALUE=23>23</option>
            <OPTION VALUE=24>24</option>
            <OPTION VALUE=25>25</option>
            <OPTION VALUE=26>26</option>
            <OPTION VALUE=27>27</option>
            <OPTION VALUE=28>28</option>
            <OPTION VALUE=29>29</option>
            <OPTION VALUE=30>30</option>
            <OPTION VALUE=31>31</option>
            <OPTION VALUE=32>32</option>
            <OPTION VALUE=33>33</option>
            <OPTION VALUE=34>34</option>
            <OPTION VALUE=35>35</option>
            <OPTION VALUE=36>36</option>
            <OPTION VALUE=37>37</option>
            <OPTION VALUE=38>38</option>
            <OPTION VALUE=39>39</option>
            <OPTION VALUE=40>40</option>
            <OPTION VALUE=41>41</option>
            <OPTION VALUE=42>42</option>
            <OPTION VALUE=43>43</option>
            <OPTION VALUE=44>44</option>
            <OPTION VALUE=45>45</option>
            <OPTION VALUE=46>46</option>
            <OPTION VALUE=47>47</option>
            <OPTION VALUE=48>48</option>
            <OPTION VALUE=49>49</option>
            <OPTION VALUE=50>50</option>
            <OPTION VALUE=51>51</option>
            <OPTION VALUE=52>52</option>
            <OPTION VALUE=53>53</option>
            <OPTION VALUE=54>54</option>
            <OPTION VALUE=55>55</option>
            <OPTION VALUE=56>56</option>
            <OPTION VALUE=57>57</option>
            <OPTION VALUE=58>58</option>
            <OPTION VALUE=59>59</option>
        </select>
        <br>
        <label for="C_VD" class="formLabelBig">Fecha:</label>
        <INPUT TYPE="text" NAME="C_VD" ID="C_VD" VALUE="<?php echo $CD ?>">
        <br>
        <label class="formLabelBig" id="C_CARGv">Parentesco/Cargo</label>
        <select name="C_CARG" id="C_CARGv">
            <option value="">&nbsp;</option>
            <option value="Aval">Aval/Recadero</option>
            <option value="Cónyuge">Cónyuge</option>
            <option value="Deudor">Deudor</option>
            <option value="Familiar">Familiar</option>
            <option value="Hermano/a">Hermano/a</option>
            <option value="Hijo/a">Hijo/a</option>
            <option value="Madre">Madre</option>
            <option value="Otro">Otro</option>
            <option value="Padre">Padre</option>
            <option value="Vecino/a">Vecino/a</option>
        </select><br>
        <label class="formLabelBig" for="C_OBSE12">Gestion</label>
            <textarea rows="2" cols="40" name="C_OBSE1" id='C_OBSE12'
                      onkeypress="tooLong('C_OBSE12')"></textarea><br>
        <label class="formLabelBig" for="ACCIONv">Acción:</label>
        <select id="ACCIONv" name="ACCION" style="width: 8cm;">
            <?php
            foreach ($resultAccionV as $answerAccionV) {
                ?>
                <option style='width: 12cm;'
                        value="<?php echo $answerAccionV[0]; ?>"><?php echo $answerAccionV[0]; ?></option>
                <?php
            }
            ?>
        </select><br>
        <label class="formLabelBig" for="C_CVSTv">Status:</label>
        <select id="C_CVSTv" name="C_CVST" style="width: 8cm;" onblur="statusChange(this.form);">
            <option value="" selected="selected"></option>
            <?php
            foreach ($resultDictamenV as $answerDictamenV) {
                ?>
                <option style='width: 12cm;'
                        value="<?php echo $answerDictamenV[0]; ?>"><?php echo $answerDictamenV[0]; ?></option>
                <?php
            }
            ?>
        </select><br>
        <label class="formLabelBig" for="MOTIVv">Motivadores:</label>
        <select id="MOTIVv" name="MOTIV" style="width: 8cm;">
            <option style='width: 12cm;' value=" ">
                <?php
                foreach ($resultMotivV

                as $answerMotivV) {
                ?>
            <option style='width: 12cm;'
                    value="<?php echo $answerMotivV[0]; ?>"><?php echo $answerMotivV[0]; ?></option>
            <?php
            }
            ?>
        </select><br>
        <table>
            <tr>
                <td><label class="formLabelBig" for="D_PROMv">Fecha promesa</label>
                    <INPUT TYPE="text" NAME="D_PROMv" ID="D_PROMv" VALUE="" SIZE=15>
                    <br>
                    <label class="formLabelBig" for="N_PROMv">Cantidad de pago prometido</label>
                    $<input type="text" name="N_PROMv" id="N_PROMv" value=""><br>
                </td>
                <td id='pagocaptv'><label class="formLabelBig" for="D_PAGOv">Fecha ya pagó</label>
                    <INPUT TYPE="text" NAME="D_PAGOv" ID="D_PAGOv" VALUE="" SIZE=15>
                    <br>
                    <label class="formLabelBig" for="N_PAGOv">Cantidad de ya pagó</label>
                    $<input type="text" name="N_PAGOv" id="N_PAGOv" value=""><br>
                </td>
            </tr>
        </table>
        <label class="formLabelBig" for="C_PROMv">Comentario de promesa</label>
        <input type="text" name="C_PROM" id="C_PROMv" value=""><br>
        <label class="formLabelBig" for="C_FREQv">Frecuencia de pago prometido</label>
        <select name="C_FREQ" id="C_FREQv">
            <option value="" selected="selected">&nbsp;</option>
            <option value="unico">Unico</option>
            <option value="semanales">Semanales</option>
            <option value="quincenales">Quincenales</option>
            <option value="mensuales">Mensuales</option>
            <option value="otro">Otro (en Gestion comentas)</option>
        </select>
        <br>
        <label class="formLabelBig" for="C_VISIT">Visitador:</label>
        <select name="C_VISIT" id="C_VISIT">
            <option value=''></option>
            <?php
            foreach ($resultGestorV as $answerGestorV) {
                ?>
                <option value="<?php echo $answerGestorV[0]; ?>"><?php echo htmlentities($answerGestorV[1]); ?></option>
            <?php }
            ?>
        </select>
        <br>
        <label class="formcap">ENTRE CALLE</label>
        <input type="text" name="C_CALLE1"> Y <input type="text"
                                                     name="C_CALLE2">
        <br>
        <div class="toggleBox" id="nuevoboxt2">
            <p class="formLabelBig">Actualización de datos</p><br>
            <label class="formLabelBig" for="C_NTELv">Tel.</label>
            <input type="text" id="C_NTELv" name="C_NTEL" value=""><br>
            <label class="formLabelBig" for="C_OBSE2v">Tel 2.</label>
            <input type="text" size=50 id="C_OBSE2v" name="C_OBSE2" value=""><br>
            <label class="formLabelBig" for="C_NDIRv">Direcci&oacute;n</label>
            <input type="text" size=50 id="C_NDIRv" name="C_NDIR" value=""><br>
        </div>
        <input type="hidden" name="go" value="CAPTURADO">
        <input type="submit" name="CAPTURADO" value="CAPTURADO">
    </form>
</div>
<!--</div>-->

<div id="HISTORIA">
    <table style="border: 0; padding: 0; border-collapse: collapse; width: 100%" id="historyhead">
        <tr>
            <?php
            $fieldNames = array("Status", "Fecha/Hora", "Gestor",
                "Telefono", "Gestion", "Gestion");
            $fieldSize = array("status", "timestamp", "chico", "telefono",
                "gestion", "hideBox");
            for ($j = 0; $j < 5; $j++) {
                $fieldName = $fieldNames[$j];
                ?>
                <th<?php echo ' class="' . $fieldSize[$j] . '"'; ?>><?php
                    if (isset($fieldName)) {
                        echo $fieldName;
                    }
                    ?></th> <?php
            }
            ?></tr>
    </table>
    <?php
    if (!empty($rowsub)) {
        ?>
        <div id='tableContainer' class='tableContainer'>
            <table style="border: 0; padding: 0; border-collapse: collapse; width: 100%" id='historyBody'>
                <tbody class="scrollContent">
                <?php
                $j = 0;
                $c = 0;
                foreach ($rowsub as $answer) {
                    $auto = $answer['auto'];
                    $visit = $answer['c_cniv'];
                    $gestor = utf8_encode($answer['c_cvge']);
                    $gestion = utf8_encode($answer['c_obse1']);
                    $timestamp = utf8_encode($answer['fecha']);
                    $stat = utf8_encode($answer['c_cvst']);
                    ?>
                    <tr<?php echo $rc->highlight($stat, $visit); ?>><?php
                        for ($k = 0; $k < 5; $k++) {
                            $encoded = utf8_encode($answer[$k]);
                            if (is_null($encoded)) {
                                $encoded = "&nbsp;";
                            }
                            $ank = str_replace('00:00:00',
                                '', $encoded);
                            $JSCode = '';
                            if ($fieldSize[$k] == "gestion") {
                                $JSCode1 = " onClick='alert(";
                                $JSCode2 = ")'";
                                $JSCode = $JSCode1 . '"' . preg_replace("[\n\r]",
                                        " ",
                                        $timestamp . ': ' . $gestion) . '"' . $JSCode2;
                            }
                            ?>
                            <td<?php
                            if ($c == 1) {
                                echo " style='background-color:#dddddd'";
                            }
                            echo ' class="' . $fieldSize[$k] . '"' . $JSCode;
                            ?>>
                                <?php
                                if (isset($ank)) {
                                    echo htmlentities($ank,
                                        ENT_QUOTES, "UTF-8");
                                }
                                ?>
                            </td>
                            <?php
                        }
                        $c = 1 - $c;
                        ?>
                    </tr>
                    <?php
                    $j++;
                }
                ?>
                <tr>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
<div id="GESTION">
    <form action="/resumen.php" method="get" id="gestionForm">
        <input type="hidden" name="minprom" value="<?php
        echo $saldo_descuento_2 + 0;
        ?>">
        <input type="hidden" name="authorized" value="<?php
        if (empty($AUTH)) {
            $AUTH = '';
        }
        if (($mytipo == 'admin') || ($AUTH != '')) {
            echo 1;
        } else {
            echo 0;
        }
        ?>">
        <table id="dataBox">
            <?php
            if ($mytipo == 'admin' || $mytipo == 'supervisor') {
                ?>
                <tr>
                    <td>Gestor</td>
                    <td><select name="C_CVGE">
                            <option value="<?php echo $capt; ?>"><?php echo $capt; ?></option>
                            <?php
                            foreach ($resultGestor as $answerGestor) {
                                ?>
                                <option value="<?php echo $answerGestor[0]; ?>"><?php echo $answerGestor[0]; ?></option>
                            <?php }
                            ?>
                        </select></td>
                </tr>
            <?php } else { ?>
                <input type="hidden" name="C_CVGE" readonly="readonly" value="<?php
                if (isset($C_CVGE)) {
                    echo $C_CVGE;
                }
                ?>">
            <?php } ?>
            <tr id='authbox' class="hideBox">
                <td>Autorizaci&oacute;n</td>
                <td><input type="password" name="AUTH" id="AUTH" value=""></td>
            </tr>
            <tr>
                <td>Telefono</td>
                <td colspan=2><select id="C_TELE" name="C_TELE">
                        <option value=''>&nbsp;</option>
                        <option value='Entrante'>Llamada entrante</option>
                        <option value='Oficina'>Cliente Visito</option>
                        <option value='040'>040</option>
                        <option value=''>Nuevo Tel. 1</option>
                        <option value=''>Nuevo Tel. 2</option>
                        <?php
                        if (isset($tel_1)) {
                            ?>
                        <option <?php echo $t1; ?>value='<?php echo $tel_1 ?>'>TEL Casa
                            - <?php echo $tel_1 ?></option><?php } ?>
                        <?php if (isset($tel_1_laboral)) { ?>
                        <option <?php echo $t1l; ?>value='<?php echo $tel_1_laboral; ?>'>TEL LABORAL 1
                            - <?php echo $empresa . ' - ' . $tel_1_laboral; ?></option><?php } ?>
                        <?php if (isset($tel_1_ref_1)) { ?>
                        <option <?php echo $t1r1; ?>value='<?php echo $tel_1_ref_1; ?>'>TEL 1 REF 1
                            - <?php echo $nombre_referencia_1 . ' - ' . $tel_1_ref_1; ?></option><?php } ?>
                        <?php if (isset($tel_1_ref_2)) { ?>
                        <option <?php echo $t1r2; ?>value='<?php echo $tel_1_ref_2; ?>'>TEL 1 REF 2
                            - <?php echo $nombre_referencia_2 . ' - ' . $tel_1_ref_2; ?></option><?php } ?>
                        <?php if (isset($tel_1_ref_3)) { ?>
                        <option <?php echo $t1r3; ?>value='<?php echo $tel_1_ref_3; ?>'>TEL 1 REF 3
                            - <?php echo $nombre_referencia_3 . ' - ' . $tel_1_ref_3; ?></option><?php } ?>
                        <?php if (isset($tel_1_ref_4)) { ?>
                        <option <?php echo $t1r4; ?>value='<?php echo $tel_1_ref_4; ?>'>TEL 1 REF 4
                            - <?php echo $nombre_referencia_4 . ' - ' . $tel_1_ref_4; ?></option><?php } ?>
                        <?php if (isset($tel_1_verif)) { ?>
                        <option class='verif' <?php echo $t1v; ?>value='<?php echo $tel_1_verif; ?>'>TEL 1 VERIF
                            - <?php echo $tel_1_verif; ?></option><?php } ?>
                        <?php if (isset($tel_2)) { ?>
                        <option <?php echo $t2; ?>value='<?php echo $tel_2; ?>'>CELULAR
                            - <?php echo $tel_2; ?></option><?php } ?>
                        <?php if (isset($tel_2_laboral)) { ?>
                        <option <?php echo $t2l; ?>value='<?php echo $tel_2_laboral; ?>'>TEL LABORAL 2
                            - <?php echo $empresa . ' - ' . $tel_2_laboral; ?></option><?php } ?>
                        <?php if (isset($tel_2_ref_1)) { ?>
                        <option <?php echo $t2r1; ?>value='<?php echo $tel_2_ref_1; ?>'>TEL 2 REF 1
                            - <?php echo $nombre_referencia_1 . ' - ' . $tel_2_ref_1; ?></option><?php } ?>
                        <?php if (isset($tel_2_ref_2)) { ?>
                        <option <?php echo $t2r2; ?>value='<?php echo $tel_2_ref_2; ?>'>TEL 2 REF 2
                            - <?php echo $nombre_referencia_2 . ' - ' . $tel_2_ref_2; ?></option><?php } ?>
                        <?php if (isset($tel_2_ref_3)) { ?>
                        <option <?php echo $t2r3; ?>value='<?php echo $tel_2_ref_3; ?>'>TEL 2 REF 3
                            - <?php echo $nombre_referencia_3 . ' - ' . $tel_2_ref_3; ?></option><?php } ?>
                        <?php if (isset($tel_2_ref_4)) { ?>
                        <option <?php echo $t2r4; ?>value='<?php echo $tel_2_ref_4; ?>'>TEL 2 REF 4
                            - <?php echo $nombre_referencia_4 . ' - ' . $tel_2_ref_4; ?></option><?php } ?>
                        <?php if (isset($tel_2_verif)) { ?>
                        <option class='verif' <?php echo $t2v; ?>value='<?php echo $tel_2_verif; ?>'>TEL 2 VERIF
                            - <?php echo $tel_2_verif; ?></option><?php } ?>
                        <?php if (isset($tel_3)) { ?>
                        <option <?php echo $t3; ?>value='<?php echo $tel_3; ?>'>TEL 3
                            - <?php echo $tel_3; ?></option><?php } ?>
                        <?php if (isset($tel_3_verif)) { ?>
                        <option class='verif' <?php echo $t3v; ?>value='<?php echo $tel_3_verif; ?>'>TEL 3 VERIF
                            - <?php echo $tel_3_verif; ?></option><?php } ?>
                        <?php if (isset($tel_4)) { ?>
                        <option <?php echo $t4; ?>value='<?php echo $tel_4; ?>'>TEL 4
                            - <?php echo $tel_4; ?></option><?php } ?>
                        <?php if (isset($tel_4_verif)) { ?>
                        <option class='verif' <?php echo $t4v; ?>value='<?php echo $tel_4_verif; ?>'>TEL 4 VERIF
                            - <?php echo $tel_4_verif; ?></option><?php } ?>
                        <?php if (isset($telefono_de_ultimo_contacto)) { ?>
                        <option <?php echo $tuc; ?>value='<?php echo $telefono_de_ultimo_contacto; ?>'>TEL DE ULT.
                            CONT. - <?php echo $telefono_de_ultimo_contacto; ?></option><?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td id="pcap2">Parentesco/Cargo</td>
                <td><select name="C_CARG">
                        <option value="">&nbsp;</option>
                        <option value="Aval">Aval/Recadero</option>
                        <option value="Conyuge">C&oacute;nyuge</option>
                        <option value="Deudor">Deudor</option>
                        <option value="Familiar">Familiar</option>
                        <option value="Hermano/a">Hermano/a</option>
                        <option value="Hijo/a">Hijo/a</option>
                        <option value="Madre">Madre</option>
                        <option value="Otro">Otro</option>
                        <option value="Padre">Padre</option>
                        <option value="Vecino/a">Vecino/a</option>
                        <option value="Yerno">Yerno</option>
                    </select></td>
            </tr>
            <tr>
                <td>Gestion</td>
                <td><textarea rows="4" cols="50" name="C_OBSE1" id='C_OBSE1'
                              onkeypress="tooLong('C_OBSE1')" onkeyup="valid(this, 'special')"
                              onmouseover='this.focus();'
                              onblur="valid(this, 'special')" onmousedown='this.focus();'></textarea></td>
                <td colspan=2>Acci&oacute;n
                    <select name="ACCION" id="ACCION">
                        <?php
                        foreach ($resultAccion as $answerAccion) {
                            ?>
                            <option value="<?php echo $answerAccion[0]; ?>" style="font-size:120%;"><?php
                                if (isset($answerAccion[0])) {
                                    echo $answerAccion[0];
                                }
                                ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br>
                    Status
                    <select name="C_CVST" id="C_CVST" onblur="statusChange(this.form);">
                        <option value=''></option>
                        <?php
                        foreach ($resultDictamen as $answerDictamen) {
                            ?>
                            <option value="<?php
                            if (isset($answerDictamen[0])) {
                                echo htmlentities($answerDictamen[0]);
                            }
                            ?>"
                                    style="font-size:120%;">
                                <?php
                                if (isset($answerDictamen[0])) {
                                    echo htmlentities($answerDictamen[0]);
                                }
                                ?>
                            </option>
                        <?php } ?>
                    </select><br>
                    Causa no pago
                    <select name="C_CNP" id="C_CNP">
                        <?php
                        foreach ($resultCnp as $answerCnp) {
                            ?>
                            <option value="<?php echo $answerCnp[0]; ?>" style="font-size:120%;"><?php
                                if (isset($answerCnp[0])) {
                                    echo htmlentities($answerCnp[0]);
                                }
                                ?></option>
                            <?php
                        }
                        ?>
                    </select>

                </td>
            </tr>
            <tr>
                <td>Motivadores</td>
                <td><select id="C_MOTIV" name="C_MOTIV">
                        <option value=" ">
                            <?php
                            foreach ($resultMotiv

                            as $answerMotiv) {
                            ?>
                        <option value="<?php echo $answerMotiv[0]; ?>"><?php echo $answerMotiv[0]; ?></option>
                        <?php
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Se necesita localizar <input type="checkbox" name="LOCALIZAR" id="localizar" <?php
                    if (!empty($localizar)) {
                        echo 'selected="selected"';
                    }
                    ?>></td>
                <td colspan=2>Localizable <select name='CUANDO'>
                        <option value=""></option>
                        <option value="madrugada" <?php
                        if ($CUANDO == 'madrugada') {
                            echo 'selected="selected"';
                        }
                        ?>>madrugada
                        </option>
                        <option value="manana" <?php
                        if ($CUANDO == 'manana') {
                            echo 'selected="selected"';
                        }
                        ?>>ma&ntilde;ana
                        </option>
                        <option value="tarde" <?php
                        if ($CUANDO == 'tarde') {
                            echo 'selected="selected"';
                        }
                        ?>>tarde
                        </option>
                        <option value="noche" <?php
                        if ($CUANDO == 'noche') {
                            echo 'selected="selected"';
                        }
                        ?>>noche
                        </option>
                        <option value="robot" <?php
                        if ($CUANDO == 'robot') {
                            echo
                            'selected="selected"';
                        }
                        ?>>robot
                        </option>
                        <option value="visita" <?php
                        if ($CUANDO == 'visita') {
                            echo
                            'selected="selected"';
                        }
                        ?>>visita
                        </option>
                    </select></td>
            </tr>
            <tr>
                <td>Cant. de promesa única o 1a</td>
                <td>$<input type="text" name="N_PROM1" value="0" size="8" onchange="npromChange(this.form);"
                            onmouseover='this.focus();'></td>
                <td>$<input type="text" name="N_PROM1_OLD" readonly="readonly" size="8" value="<?php
                    if (isset($N_PROM1_OLD)) {
                        echo $N_PROM1_OLD;
                    }
                    ?>"></td>
            </tr>
            <tr>
                <td><label for="D_PROM1">Fecha promesa única o 1a</label></td>
                <td><INPUT TYPE="text" NAME="D_PROM1" ID="D_PROM1" VALUE="" SIZE=15></td>
                <td><?php
                    if (isset($D_PROM1_OLD)) {
                        echo $D_PROM1_OLD;
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Cant. de promesa 2a</td>
                <td>$<input type="text" name="N_PROM2" value="0" onchange="npromChange(this.form);"
                            onmouseover='this.focus();'></td>
                <td>$<input type="text" name="N_PROM2_OLD" size="8" readonly="readonly" value="<?php
                    if (isset($N_PROM2_OLD)) {
                        echo $N_PROM2_OLD;
                    }
                    ?>"><br>
            </tr>
            <tr>
                <td><label for="D_PROM2">Fecha promesa 2a</label></td>
                <td><INPUT TYPE="text" NAME="D_PROM2" ID="D_PROM2" VALUE="" SIZE=15></td>
                <td><?php
                    if (isset($D_PROM2_OLD)) {
                        echo $D_PROM2_OLD;
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Cant. de promesa 3a</td>
                <td>$<input type="text" name="N_PROM3" value="0" onchange="npromChange(this.form);"
                            onmouseover='this.focus();'></td>
                <td>$<input type="text" name="N_PROM3_OLD" size="8" readonly="readonly" value="<?php
                    if (isset($N_PROM3_OLD)) {
                        echo $N_PROM3_OLD;
                    }
                    ?>"><br>
            </tr>
            <tr>
                <td>Fecha promesa 3a</td>
                <td><INPUT TYPE="text" NAME="D_PROM3" ID="D_PROM3" VALUE="" SIZE=15></td>
                <td><?php
                    if (isset($D_PROM3_OLD)) {
                        echo $D_PROM3_OLD;
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Cant. de promesa 4a</td>
                <td>$<input type="text" name="N_PROM4" value="0" onchange="npromChange(this.form);"
                            onmouseover='this.focus();'></td>
                <td>$<input type="text" name="N_PROM4_OLD" size="8" readonly="readonly" value="<?php
                    if (isset($N_PROM4_OLD)) {
                        echo $N_PROM4_OLD;
                    }
                    ?>"><br>
            </tr>
            <tr>
                <td>Fecha promesa 4a</td>
                <td><INPUT TYPE="text" NAME="D_PROM4" ID="D_PROM4" VALUE="" SIZE=15></td>
                <td><?php
                    if (isset($D_PROM4_OLD)) {
                        echo $D_PROM4_OLD;
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Frecuencia de promesa</td>
                <td><select name="C_PROM" id="C_PROM">
                        <option selected="selected" value="">&nbsp;</option>
                        <option value="unico">Unico</option>
                        <option value="dos pagos">Dos pagos</option>
                        <option value="semanales">Semanales</option>
                        <option value="quincenales">Quincenales</option>
                        <option value="mensuales">Mensuales</option>
                        <option value="otro">Otro (en Gestion comentas)</option>
                    </select></td>
            </tr>
            <tr>
                <td>Cant. de promesa total</td>
                <td><input type="text" name="N_PROM" id="N_PROM" readonly="readonly" style="background-color:#c0c0c0;"
                           value=""></td>
                <td>Cant. prometido anterior</td>
                <td><input type="text" name="N_PROM_OLD" id="N_PROM_OLD" readonly="readonly"
                           style="background-color:#c0c0c0;" value="<?php
                    if (isset($N_PROM_OLD)) {
                        echo floor($N_PROM_OLD);
                    }
                    ?>"></td>
            </tr>
            <tr id="pagocapt">
                <td>Monto Pag&oacute;</td>
                <td>$<input type="text" name="N_PAGO" id="N_PAGO" value="0" onmouseover='this.focus();'></td>
            </tr>
            <tr id="pagocapt2">
                <td>Fecha Pagó</td>
                <td><INPUT TYPE="text" NAME="D_PAGO" ID="D_PAGOi" VALUE="" SIZE=15></td>
            </tr>
            <tr>
                <td colspan=2>Actualizaci&oacute;n de Datos</td>
            </tr>
            <tr>
                <td>Tel.</td>
                <td><input type="text" name="C_NTEL" value="" onmouseover='this.focus();'
                           onChange="addToTels(4, this)"></td>
            </tr>
            <tr>
                <td>Tel 2.</td>
                <td><input type="text" size=50 name="C_OBSE2" value="" onmouseover='this.focus();'
                           onChange="addToTels(5, this)"></td>
            </tr>
            <tr>
                <td>Direcci&oacute;n</td>
                <td><input type="text" size=50 name="C_NDIR" value="" onmouseover='this.focus();'></td>
            </tr>
            <tr>
                <td><label for="C_EMAIL">E-mail</label></td>
                <td><input type="text" id="C_EMAIL" name="C_EMAIL" value="" onmouseover='this.focus();'></td>
            </tr>
        </table>
        <input type="submit" name="GUARDAR" id="GUARDbutt" value="GUARDAR" ondblclick="return false;">
        <button type="button" value="RESET" onclick="this.form.GUARDAR.disabled = false">RESET</button>
        <br>
        <div class="noShow">
            <input type="hidden" name="from" readonly="readonly" value="resumen.php">
            <input type="hidden" name="D_FECH" readonly="readonly" value="<?php
            if (isset($CD)) {
                echo $CD;
            }
            ?>">
            <input type="hidden" name="D_PROM" readonly="readonly" value="<?php
            if (isset($CD)) {
                echo $CD;
            }
            ?>">
            <input type="hidden" name="C_HRIN" readonly="readonly" value="<?php
            if (isset($CT)) {
                echo $CT;
            }
            ?>">
            <input type="hidden" name="C_HRFI" readonly="readonly" value="<?php
            if (isset($CT)) {
                echo $CT;
            }
            ?>">
            <input type="hidden" name="AUTO" readonly="readonly" value=""><br>
            <input type="hidden" name="find" readonly="readonly" value="<?php
            if (isset($find)) {
                echo $find;
            }
            ?>">
            <input type="hidden" name="field" readonly="readonly" value="<?php
            if (isset($field)) {
                echo $field;
            }
            ?>">
            <input type="hidden" name="capt" readonly="readonly" value="<?php
            if (isset($capt)) {
                echo $capt;
            }
            ?>">
            <input type="hidden" name="camp" readonly="readonly" value="<?php
            if (isset($camp)) {
                echo $camp;
            }
            ?>">
            <input type="hidden" name="neworder" readonly="readonly" value="<?php
            if (isset($neworder)) {
                echo $neworder;
            }
            ?>">
            <input type="hidden" name="C_CVBA" readonly="readonly" value="<?php
            if (isset($cliente)) {
                echo $cliente;
            }
            ?>">
            <input type="hidden" name="C_ATTE" readonly="readonly" value="">
            <input type="hidden" name="C_CONT" readonly="readonly" value="<?php
            if (isset($id_cuenta)) {
                echo $id_cuenta;
            }
            ?>">
            <input type="hidden" name="C_CONTAN" readonly="readonly" value="<?php
            if (isset($status_aarsa)) {
                echo $status_aarsa;
            }
            ?>">
            <input type="hidden" name="CUENTA" id="CUENTA" readonly="readonly" value="<?php
            if (isset($numero_de_cuenta)) {
                echo $numero_de_cuenta;
            }
            ?>">
            <input type="hidden" name="C_EJE" id="C_EJE" readonly="readonly" value="<?php
            if (isset($ejecutivo_asignado_call_center)) {
                echo $ejecutivo_asignado_call_center;
            }
            ?>">
            <input type="hidden" name="oldGo" readonly="readonly" value="<?php echo $go; ?>">
            <input type="hidden" name="error" readonly="readonly" value="1">
            <input type="hidden" name="go" readonly="readonly" value="GUARDAR">
        </div>
    </form>
</div>
<script>
    $(function () {
        const vdCalendar = $("#C_VD");
        const prvCalendar = $("#D_PROMv");
        const pagCalendar = $("#D_PAGOi");
        const pavCalendar = $("#D_PAGOv");
        const pr1Calendar = $("#D_PROM1");
        const pr2Calendar = $("#D_PROM2");
        const pr3Calendar = $("#D_PROM3");
        const pr4Calendar = $("#D_PROM4");
        $.datepicker.setDefaults(getMx());
        vdCalendar.datepicker("option", "dateFormat", 'yy-mm-dd');
        prvCalendar.datepicker("option", "dateFormat", 'yy-mm-dd');
        pavCalendar.datepicker("option", "dateFormat", 'yy-mm-dd');
        pr1Calendar.datepicker({minDate: 0, maxDate: "+2M", dateFormat: 'yy-mm-dd'});
        pr2Calendar.datepicker({minDate: 0, maxDate: "+2M", dateFormat: 'yy-mm-dd'});
        pr3Calendar.datepicker({minDate: 0, maxDate: "+2M", dateFormat: 'yy-mm-dd'});
        pr4Calendar.datepicker({minDate: 0, maxDate: "+2M", dateFormat: 'yy-mm-dd'});
        pagCalendar.datepicker({maxDate: 0, dateFormat: 'yy-mm-dd'});
    });
</script>
</body>
</html>
