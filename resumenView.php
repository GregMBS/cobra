<html>
    <html>
        <head>

            <title>Resumen</title>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <style type="text/css">
                body {font-family: verdana,arial, helvetica, sans-serif; font-size: 10pt; background-color: #ffffff;color:#000000;}
                .hidebox {display:none}
                div {clear:both}
                span.formcap {display: block; width: 20em; float: left; font-size: 100%; font-weight:bold;}
                span.formcapa {display: block; width: 13em; float: left; font-size: 100%; font-weight:bold;}
                span.formcaps {display: block; width: 6em; float: left; font-size: 100%; font-weight:bold;}
                #deudor {width: 7em;}
                #domicilio {width: 7em;}
                span.formtit {display: block; width: 24em; float: left; font-size: 100%; font-weight:bold;}
                span.formfirst {display: block; width: 24em; float: left;}
                select, input, button {font-family: verdana,arial, helvetica, sans-serif;font-size:100%}
                input {font-family: verdana,arial, helvetica, sans-serif;font-size:100%; font-weight:bold;}
                #GESTION input {font-size:80%; width:auto}
                #GENERAL textarea {font-family: verdana,arial, helvetica, sans-serif;font-size:90%;width:9cm; font-weight:normal;}
                #GENERAL table {width:100%}
                #GENERAL td {border:0}
                #CONTABLES table {width:100%}
                #CONTABLES td {border:0; font-weight:normal; font-size:90%;}
                #GESTION table {width:100%;background-color:#ddffdd}
                #GESTION tr {background-color:#ddffdd}
                #GESTION td {border:0; font-weight:bold; font-size:80%; background-color:#ddffdd}
                #VISITA table {width:100%}
                #VISITA td {border:0; font-weight:normal; font-size:90%;}
                a:link {color:blue;}   
                a:visited {color:green;}   
                a:hover {color:red;}   
                a:active {color:yellow;}   
                #telefono2 {font-weight:bold;}   
                #telbox span.formcap {display: block; width: 14em; float: left;}
                div {border: 1pt black solid;background-color:#ffffff;}
                #demobox {float: left;}
                .telbox {float: left;}
                .verif {font-weight:bold; background-color:#00ff00;}
                .badnoold {font-weight:normal; font-style:italic; background-color:#ff0000;}
                #descbox {float: left;}
                #gestionbox {clear: right;}
                #capturabox {float: left;}
                #guardbox {float: left; width:42em;}
                #captresbox {float: left;}
                #notabox {float: left;}
                .clearbox {clear: both; text-align: center;}
                table {color:#000000;}
                tr {height:2em;}
                th {width: 9em;}
                th.gestion {width: 32em;}
                th.status {width: 16em;}
                th.timestamp {width: 8em;}
                th.telefono {width: 8em;}
                th.chico {width: 5em;}
                td {border: 1pt solid #000000;background-color: #ffffff; width:10em;}
                td.gestion {width: 32em;height: 1em;overflow:hidden;}
                td.status {width: 16em;}
                td.timestamp {width: 8em;}
                td.telefono {width: 8em;}
                td.chico {width: 5em;}
                #tableContainer {height: 4cm; overflow: scroll;}
                .noshow { display: none; width: 0;}
                #searchbox {z-index: 98; display: none; position: absolute; left: 30%; top: 30%; color: #000000; background-color: #ffffff; text-align: center; padding: 1em; border: 2px black solid;}
                #searchbox input {color: #000000; background-color: #ffffff;}
                #quicksearchbox {z-index: 98; display: none; position: absolute; left: 30%; top: 30%; color: #000000; background-color: #ffffff; text-align: center; padding: 1em; border: 2px black solid;}
                #quicksearchbox input {color: #000000; background-color: #ffffff;}
                #calm {z-index: 98; position: absolute; left: 30%; top: 30%; color: #000000; background-color: #ffffff; text-align: center; padding: 1em; border: 2px black solid;}
                #calm input {color: #000000; background-color: #ffffff;}
                #pagocapt td {background-color: #ffffff;}
                #pagocapt2 td {background-color: #ffffff;}
                .visitable td {border:0; background-color: transparent;width:auto;}
                #buttonbox form {float:left}
                .buttons {float:left;width:auto}
                .buttons input {float:left}
                .buttons button {float:left;width:auto}
                <?php if ($notalert > 0) { ?> 
                    #notasq input {background-color: #ff0000;}
                    <?php
                }
                if ($pagalert > 0) {
                    ?> 
                    #pagos input {background-color: #ff0000;}
                    <?php
                }
                if ((preg_match('/[dv]o$/', $status_de_credito)) && ($mytipo <> 'admin')) {
                    ?> 
                    #GUARDbutt {display:none;}
                <?php } ?>
                <?php if ($mytipo == 'visitador') { ?> 
                    #databox,#prombox,#nuevoboxt,#combox,#guardbox,#dtelboxt,#clock {display:none;}
                    #visitboxt,#visitbox {display:block;}
                <?php } ?>
                .deudor {color: #ff0000;}
                .visit {color: #00aa00;}
                #avalbox input {font-size: 85%}
                #avalbox .shortinp {width: 5em;}
                ul.tabs 
                { list-style-type: none; padding: 0; margin: 0;} 
                ul.tabs li 
                { float: left; padding: 0; margin: 0; padding-top: 0; background: url(tab_right.png) no-repeat right top; margin-right: 1px; } 
                ul.tabs li a 
                { display: block; padding: 0px 10px; color: #fff; text-decoration: none; background: url(tab_left.png) no-repeat left top; } 
                ul.tabs li a:hover 
                { color: #ff0; }		
            </style>
            <script type="text/javascript" src="dom-drag.js"></script>
            <SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript">
                function aviso() {}
                function paging(pageid) {
                document.getElementById("TELEFONOS").style.display="none";
                document.getElementById("REFERENCIAS").style.display="none";
                document.getElementById("LABORAL").style.display="none";
                document.getElementById("CONTABLES").style.display="none";
                document.getElementById("MISCELANEA").style.display="none";
                document.getElementById("VISITA").style.display="none";
                document.getElementById("HISTORIA").style.display="none";
                document.getElementById("EXTRAS").style.display="none";
                document.getElementById(pageid).style.display="block";
                if (document.getElementById("GESTION")) 
                {document.getElementById("GESTION").style.display="block";}
                if (pageid==="VISITA") {
                document.getElementById("GESTION").style.display="none";
                }
                <?php
                if (empty($flag)) {
                    $flag = 0;
                }
                if ($flag > 0) {
                    ?>
                    alert("<?php echo $flagmsg; ?>\nBuscar para checar que gestion de cuenta <?php echo $CUENTA; ?> está guardado corectamente.");
                <?php } ?>
                }
                function npromChange(thisform)
                {
                with (thisform) {
                N_PROM.value=(N_PROM1.value*1)+(N_PROM2.value*1);
                }
                }
                function statusChange(thisform)
                {
                with (thisform) {
                if (C_CVST.substr(0,3)==="PAG") {
                document.getElementById("pagocapt").style.backgroundColor="yellow";
                document.getElementById("pagocapt2").style.backgroundColor="yellow";
                document.getElementById("pagocaptv").style.backgroundColor="yellow";
                }
                }
                }

                function clock() {
                var d=new Date();
                var tn=d.getTime();
                var tll = new Date('<?php echo $tl; ?>');
                var tl=tll.getTime();
                document.getElementById("timer").value=tn-tl;
                document.getElementById("timers").value=parseInt(parseInt(document.getElementById("timer").value)/1000)%60;
                document.getElementById("timerm").value=parseInt(parseInt(document.getElementById("timer").value)/1000/60);
                if (document.getElementById("timerm").value>2) {
                document.getElementById("clock").style.backgroundColor="yellow";
                }
                if (document.getElementById("timerm").value>4) {
                document.getElementById("clock").style.backgroundColor="red";
                }
                if (document.getElementById("timer").value%2==0) {
                document.getElementById("clock").style.backgroundColor="green";
                }
                }
                function openSearch() {
                setInterval('clock()',1000);
                <?php
                if ($qcount > 1) {
                    ?>
                    alert("ERROR RA3 - Hay <?php echo $qcount; ?> cuentas con este número.");
                    <?php
                }
                if ($notalert == 1) {
                    ?>
                    var goalert = confirm("Tiene alerta pendiente <?php echo $notalertt; ?> para cuenta <?php echo $alertcuenta; ?> Quiere verlo?");
                    if(goalert==true)
                    {
                    window.location="resumen.php?find=<?php echo $alertcuenta; ?>&field=numero_de_cuenta&capt=<?php echo $capt; ?>&go=FROMALERT&from=resumen.php&go1=FROMALERT";
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
                    $nn        = 0;
                    $highlight = filter_input(INPUT_GET, 'highlight',
                        FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $hfind     = filter_input(INPUT_GET, 'hfind',
                        FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    if (empty($highlight)) {
                        $xfield[0] = '';
                        $xfind     = '';
                    } else {
                        $xfield[0] = $highlight;
                        $xfind     = "/".$hfind."/";
                    }
                    $ofield = $xfield[0];
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1))) {
                        $xfield[$nn] = 'tel_1';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2))) {
                        $xfield[$nn] = 'tel_2';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_3))) {
                        $xfield[$nn] = 'tel_3';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_4))) {
                        $xfield[$nn] = 'tel_4';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind,
                            $tel_1_alterno))) {
                        $xfield[$nn] = 'tel_1_alterno';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind,
                            $tel_2_alterno))) {
                        $xfield[$nn] = 'tel_2_alterno';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind,
                            $tel_3_alterno))) {
                        $xfield[$nn] = 'tel_3_alterno';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind,
                            $tel_4_alterno))) {
                        $xfield[$nn] = 'tel_4_alterno';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_verif))) {
                        $xfield[$nn] = 'tel_1_verif';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_verif))) {
                        $xfield[$nn] = 'tel_2_verif';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_3_verif))) {
                        $xfield[$nn] = 'tel_3_verif';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_4_verif))) {
                        $xfield[$nn] = 'tel_4_verif';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind,
                            $tel_1_laboral))) {
                        $xfield[$nn] = 'tel_1_laboral';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind,
                            $tel_2_laboral))) {
                        $xfield[$nn] = 'tel_2_laboral';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_ref_1))) {
                        $xfield[$nn] = 'tel_1_ref_1';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_ref_1))) {
                        $xfield[$nn] = 'tel_2_ref_1';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_ref_2))) {
                        $xfield[$nn] = 'tel_1_ref_2';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_ref_2))) {
                        $xfield[$nn] = 'tel_2_ref_2';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_ref_3))) {
                        $xfield[$nn] = 'tel_1_ref_3';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_ref_3))) {
                        $xfield[$nn] = 'tel_2_ref_3';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_ref_4))) {
                        $xfield[$nn] = 'tel_1_ref_4';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_ref_4))) {
                        $xfield[$nn] = 'tel_2_ref_4';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'TELS') && (preg_match($xfind,
                            $telefonos_marcados))) {
                        $xfield[$nn] = 'telefonos_marcados';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'REFS') && (preg_match($xfind,
                            $nombre_deudor_alterno))) {
                        $xfield[$nn] = 'nombre_deudor_alterno';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'REFS') && (preg_match($xfind,
                            $nombre_referencia_1))) {
                        $xfield[$nn] = 'nombre_referencia_1';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'REFS') && (preg_match($xfind,
                            $nombre_referencia_2))) {
                        $xfield[$nn] = 'nombre_referencia_2';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'REFS') && (preg_match($xfind,
                            $nombre_referencia_3))) {
                        $xfield[$nn] = 'nombre_referencia_3';
                        $nn          = $nn + 1;
                    }
                    if (($ofield == 'REFS') && (preg_match($xfind,
                            $nombre_referencia_4))) {
                        $xfield[$nn] = 'nombre_referencia_4';
                        $nn          = $nn + 1;
                    }
                    if ($ofield == 'ROBOT') {
                        $xfield[$nn] = 'historybody';
                        $nn          = $nn + 1;
                    }
                    $n = 0;
                    while (isset($xfield[$n])) {
                        ?>
                        document.getElementById("<?php echo $xfield[$n] ?>").style.backgroundColor="yellow";
                        document.getElementById("<?php echo $xfield[$n] ?>").style.fontWeight="bold";
                        document.getElementById("<?php echo $xfield[$n] ?>").parentNode.style.display="block";
                        <?php
                        $n++;
                    }
                }
                if ($lockflag == 1) {
                    ?>
                    alert("ERROR RA4 - Esta record está en uso de <?php echo $locker ?>");
                <?php } ?>
                }

                var r={
                'special':/[\W]/g,
                'quotes':/['\''&'\"']/g,
                'notnumbers':/[^\d]/g
                }

                function valid(o,w){
                o.value = o.value.replace(r[w],' ');
                }

                function tooLong(e)
                {
                if (window.document.getElementById("C_OBSE1").value.length>250) {
                window.document.getElementById("C_OBSE1").value=window.document.getElementById("C_OBSE1").value.replace('  ',' ');
                window.document.getElementById("C_OBSE1").value=window.document.getElementById("C_OBSE1").value.substr(0,200);
                confirm('GESTION demasiado largo');
                window.document.getElementById("C_OBSE1").style.backgroundColor="yellow";
                return false;}
                }
                function logout()
                {
                window.location="resumen.php?capt=<?php echo $capt; ?>&go='LOGOUT'";
                }

                function showsearch()
                {
                document.getElementById('searchbox').style.display="block";
                document.getElementById('find').focus();
                }
                function showbox(boxname)
                {
                document.getElementById(boxname).style.display="block";
                }
                function cancelbox(boxname)
                {
                document.getElementById(boxname).style.display="none";
                searching="";
                }
                function addToTels(pos,tel) {
                document.getElementById("C_TELE").options[pos]=new Option(tel.value, tel.value, true, true);
                document.getElementById("C_TELE").options[pos].style.fontWeight="bold";
                document.getElementById("C_TELE").options[pos].style.backgroundColor="#00FF00";
                }
            </SCRIPT>
            <script type="text/javascript" src="depuracion.js"></script>
            <script type="text/javascript" src="depuracionv.js"></script>
            <SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript" SRC="CalendarPopup.js"></SCRIPT>
        </head>
        <body onLoad="alerttxt = new String('');
                paging('HISTORIA');
                openSearch();
                aviso();" id="todos">
            <div id="buttonbox">
                <?php if (($go == 'FROMULTIMA') || ($go == 'FROMBUSCAR')) { ?>
                    <form class="buttons" name="seg" method="get" action=
                          "resumen.php" id="segid">
                        <input type="hidden" name="capt" value="<?php echo $capt ?>">
                        <input type="hidden" name="find" value="<?php echo $id_cuenta ?>">
                        <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
                        <input type="submit" name="go" value="REINTRO QUEUE"></form>
                <?php } ?>
                <form class="buttons" name="ultima" method="get" action=
                      "resumen.php" id="ultima">
                    <input type="hidden" name="capt" value="<?php echo $capt ?>">
<!--                    <input type="hidden" name="find" value="<?php echo $id_cuenta ?>">
                    <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
                    -->
                    <input type="submit" name="go" value="ULTIMA"></form>
                <form class="buttons" name="buscar" action="resumen.php" id="buscar">
                    <button type="button" value="buscar" onclick=
                            "showsearch();">BUSCAR</button>
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
                      "realvisitlist.php" id="visitlist" target="_blank">
                    <input type="hidden" name="capt" value="<?php echo $capt ?>"> 
                    <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>"> 
                    <input type="hidden" name="ejecutivo_asignado_call_center" value="<?php echo $ejecutivo_asignado_call_center ?>"> 
                    <input type="submit" name="go" value="VISITAS"></form>
                <form class="buttons" name="rotas" method="get" action=
                      "rotas.php" id="rotas">
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
                <form class="buttons" name="pagos" method="get" action="pagos.php" id="pagos" target="_blank">
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
                <form class="buttons" name="white" method="get" action="white.php" id="white" target="_blank">
                    <input type="hidden" name="capt" value="<?php
                    if (isset($capt)) {
                        echo $capt;
                    }
                    ?>">
                    <input type="submit" name="go" value="PAGINAS BLANCAS"></form>

                <?php $CTA = $numero_de_credito; ?>
                <form class="buttons" name="notasq" method="get" action="notas.php" id="notas" target="_blank"><input type="hidden"
                                                                                                                      name="capt" value="<?php
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
                      "queuesg.php" id="queuesg">
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
                      "resumen.php" id="logout">
                    <input type="hidden" name="capt" value="<?php
                    if (isset($capt)) {
                        echo $capt;
                    }
                    ?>">
                    <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
                    <input type="submit" name="go" value="LOGOUT"></form>
                <?php if ($camp == 0) { ?>
                    <form action="resumen.php" method="get">
                        <input type="hidden" name="capt" value="<?php echo $capt ?>">
                        <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
                        <select name="clientefilt" onChange="this.form.submit()">
                            <option value="" <?php if (!empty($clientefilt)) {
                        ?>
                                        selected="selected"
                                    <?php } ?>>todos</option>
                                    <?php
                                    foreach ($resultfilt as $answerfilt) {
                                        ?>
                                <option value="<?php echo $answerfilt['cliente']; ?>" <?php
                                if (($cliente == $answerfilt['cliente']) && ($sdc
                                    == $answerfilt['sdc']) && ($cr == $answerfilt['queue'])) {
                                    ?>
                                            selected='selected'
                                            <?php
                                        }
                                        ?>><?php echo $answerfilt['cliente'].' '.$answerfilt['sdc'].' '.$answerfilt['queue']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </form>
                    <?php
                } else {
                    if (empty($cliente)) {
                        $cliente = '';
                    }
                    ?>
                    <button><?php echo $cliente.' '.$sdc.' '.$cr ?></BUTTON>
                    <?php
                }
                if ($mytipo == 'admin') {
                    ?>
                    <form action="reports.php" method="get">
                        <input type="hidden" name="capt" value="<?php echo $capt; ?>">
                        <input type="submit" value="REPORTES">
                    </form>
                <?php } ?>

                <span style='font-weight:bold;font-size:120%;'><?php echo $capt; ?></span>
                <?php if (!empty($cliente)) { ?>
                    <span onmouseover='this.style.visibility = "hidden";'><img style="position:absolute;top:0;right:0" height=50 alt="client logo" src='logos/<?php
                        echo
                        $cliente;
                        ?>.jpg'></span>
                    <?php } ?>
                <form class="buttons" name="trouble" method="get" action="trouble.php" id="trouble" target="_blank">
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
            <div class="clearbox">
                <UL class='tabs'>
                    <LI><A onClick="paging('TELEFONOS')">TELEFONOS</A></LI>
                    <LI><A onClick="paging('REFERENCIAS')">REFERENCIAS</A></LI>
                    <LI><A onClick="paging('LABORAL')">LABORAL</A></LI>
                    <LI><A onClick="paging('CONTABLES')">CONTABLES</A></LI>
                    <LI><A onClick="paging('MISCELANEA')">MISCELANEA</A></LI>
                    <?php
                    if ($others > 1) {
                        ?>
                        <LI><A onClick="paging('EXTRAS');">OTRAS CUENTAS</A></LI>
                    <?php } ?>
                    <?php if ($cliente == 'Surtidor del Hogar') { ?>
                        <LI><A onClick="paging('EXTRAS');">PRODUCTOS</A></LI>
                    <?php } ?>
                    <LI><A onClick="paging('VISITA')">CAPTURA VISITA</A></LI>
                    <LI><A onClick="paging('HISTORIA')">HISTORIA</A></LI>
                </UL>
            </div>
            <form action="resumen.php" method="post" name="resumenform" id=
                  "resumenform">
                <div id="GENERAL">
                    <table summary="demograficas">
                        <tr>
                            <td>
                                <span class='formcapa' id='deudor'>Deudor</span><input type='text' size=80 style='width:12cm' name=nombre_deudor id="nombre_deudor" readonly='readonly' value='<?php
                                if (isset($nombre_deudor)) {
                                    echo htmlentities($nombre_deudor);
                                }
                                ?>'><br>
                            </td>
                            <td>
                                <span class='formcapa' id='domicilio'>Domicilio</span>
                                <textarea name=domicilio_deudor id=domicilio_deudor readonly='readonly' rows=4 cols=20>
                                    <?php echo $domicilio_deudor."\n".$colonia_deudor."\n".$ciudad_deudor.", ".$estado_deudor.'  '.$cp_deudor; ?>
                                    <?php
                                    if (isset($domicilio_deudor_2)) {
                                        echo "\n o \n".$domicilio_deudor_2;
                                    }
                                    ?>
                                </textarea><br>
                                <?php if (!empty($direccion_nueva)) { ?>
                                    <span class='formcapa'>Direcci&oacute;n nueva</span><input type='text' name=direccion_nueva readonly='readonly' value='<?php echo $direccion_nueva; ?>'><br>
                                    <?php
                                }
                                if (substr($cliente, 0, 9) == "INFONAVIT") {
                                    ?>
                                    <span class='formcapa'>NSS</span><input type='text' name=nss readonly='readonly' value='<?php
                                    if (isset($nss)) {
                                        echo $nss;
                                    }
                                    ?>'><br>
                                                                            <?php
                                                                        }
                                                                        if (substr($cliente,
                                                                                0,
                                                                                8)
                                                                            == "JURIDICO") {
                                                                            ?>
                                    <input type='text' name=nss readonly='readonly' value='<?php
                                    if (isset($avapar)) {
                                        echo $avapar;
                                    }
                                    ?>'><br>
                                       <?php } ?>
                            </td>
                        <tr>
                            <td>
                                <span class='formcapa'>Gestor - call center</span><input type='text' name=ejecutivo_asignado_call_center readonly='readonly' value='<?php
                                if (isset($ejecutivo_asignado_call_center)) {
                                    echo $ejecutivo_asignado_call_center;
                                }
                                ?>'><br>
                                <span class='formcapa'>Numero de cuenta</span><input type='text' name=numero_de_cuenta id="numero_de_cuenta" readonly='readonly' value='<?php
                                if (isset($numero_de_cuenta)) {
                                    echo $numero_de_cuenta;
                                }
                                ?>'><br>
                                <span class='formcapa'>Status de cuenta</span><input type='text' name=status_aarsa readonly='readonly' value='<?php
                                if (isset($status_aarsa)) {
                                    echo $status_aarsa;
                                }
                                ?>'><br>
                            </td>
                            <td>
                                <div id='clock'>
                                    <input type="hidden" name="timer" id="timer" readonly="readonly" value="0">:
                                    <input type="text" name="timerm" id="timerm" readonly="readonly" value="0" size="3">:
                                    <input type="text" name="timers" id="timers" readonly="readonly" value="0" size="3"><br>
                                    <?php
                                    $campoc  = " style='background-color:red; color:white;'";
                                    $numgest = $resultng['cng'] or 0;
				    
                                        if ($numgest > 20) {
                                            $campoc = " style='background-color:yellow; color:black;'";
                                        }
                                        if ($numgest > 40) {
                                            $campoc = " style='background-color:green; color:white;'";
                                        }
                                    ?>
                                    <input type="text"<?php echo $campoc; ?> name="numgest" id="numgest" readonly="readonly" value="<?php echo $numgest.' gestiones'; ?>">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="TELEFONOS">
                    <span class='formcap'>Tel Casa</span><input type='text' name=tel_1 id="tel_1" readonly='readonly' value='<?php
                    if (isset($tel_1)) {
                        echo $tel_1;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel Cel</span><input type='text' name=tel_2 id="tel_2" readonly='readonly' value='<?php
                    if (isset($tel_2)) {
                        echo $tel_2;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel 3</span><input type='text' name=tel_3 id="tel_3" readonly='readonly' value='<?php
                    if (isset($tel_3)) {
                        echo $tel_3;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel 4</span><input type='text' name=tel_4 id="tel_4" readonly='readonly' value='<?php
                    if (isset($tel_4)) {
                        echo $tel_4;
                    }
                    ?>'><br>
                    <span class='formcap'>E-mail</span><input type='text' name=email_deudor readonly='readonly' value='<?php
                    if (isset($email_deudor)) {
                        echo $email_deudor;
                    }
                    ?>'><br>
                </div>
                <div id="REFERENCIAS">
                    <?php if (isset($nombre_deudor_alterno)) { ?>
                        <span class='formcaps'>Aval</span><input type='text' name=nombre_deudor_alterno id="nombre_deudor_alterno" readonly='readonly' value='<?php
                        if (isset($nombre_deudor_alterno)) {
                            echo htmlentities($nombre_deudor_alterno);
                        }
                        ?>'>
                                                                 <?php
                                                             }
                                                             if (isset($domicilio_deudor_alterno)) {
                                                                 ?>
                        <br><span class='formcaps'>Dirección Aval</span>
                        <textarea readonly='readonly'><?php
                            echo $domicilio_deudor_alterno."\n".
                            $colonia_deudor_alterno."\n".
                            $ciudad_deudor_alterno."\n".
                            $estado_deudor_alterno;
                            ?>
                        </textarea>
                        <?php
                    }
                    if (isset($domicilio_deudor_alterno_2a)) {
                        ?>
                        <textarea readonly='readonly'><?php
                            echo $domicilio_deudor_alterno_2a."\n".
                            $colonia_deudor_alterno_2a."\n".
                            $ciudad_deudor_alterno_2a."\n".
                            $estado_deudor_alterno_2a;
                            ?>
                        </textarea>
                        <?php
                    }
                    if (isset($nombre_deudor_alterno_2)) {
                        ?>
                        <br><span class='formcaps'>Aval 2</span><input type='text' name=nombre_deudor_alterno_2
                                                                       id="nombre_deudor_alterno_2" readonly='readonly'
                                                                       value='<?php
                                                                       if (isset($nombre_deudor_alterno_2)) {
                                                                           echo htmlentities($nombre_deudor_alterno_2);
                                                                       }
                                                                       ?>'>
                                                                       <?php
                                                                   }
                                                                   if (isset($domicilio_deudor_alterno_2)) {
                                                                       ?>
                        <br><span class='formcaps'>Dirección Aval 2</span>
                        <textarea readonly='readonly'><?php
                            echo $domicilio_deudor_alterno_2."\n".
                            $colonia_deudor_alterno_2."\n".
                            $ciudad_deudor_alterno_2."\n".
                            $estado_deudor_alterno_2;
                            ?>
                        </textarea>
                        <?php
                    }
                    if (isset($domicilio_deudor_alterno_2b)) {
                        ?>
                        <textarea readonly='readonly'><?php
                            echo $domicilio_deudor_alterno_2b."\n".
                            $colonia_deudor_alterno_2b."\n".
                            $ciudad_deudor_alterno_2b."\n".
                            $estado_deudor_alterno_2b;
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
                        <span class='formcaps'>Tel Casa</span><input type='text' name=tel_1_alterno id="tel_1_alterno" readonly='readonly' value='<?php
                        if (isset($tel_1_alterno)) {
                            echo $tel_1_alterno;
                        }
                        ?>'><br>
                                                                     <?php
                                                                 }
                                                                 if (isset($tel_2_alterno)) {
                                                                     ?>
                        <span class='formcaps'>Tel Cel</span><input type='text' name=tel_2_alterno id="tel_2_alterno" readonly='readonly' value='<?php
                        if (isset($tel_2_alterno)) {
                            echo $tel_2_alterno;
                        }
                        ?>'><br>
                                                                    <?php
                                                                }
                                                                if (isset($tel_3_alterno)) {
                                                                    ?>
                        <span class='formcaps'>Tel 3</span><input type='text' name=tel_3_alterno id="tel_3_alterno" readonly='readonly' value='<?php
                        if (isset($tel_3_alterno)) {
                            echo $tel_3_alterno;
                        }
                        ?>'><br>
                                                                  <?php
                                                              }
                                                              if (isset($tel_4_alterno)) {
                                                                  ?>
                        <span class='formcaps'>Tel 4</span><input type='text' name=tel_4_alterno id="tel_4_alterno" readonly='readonly' value='<?php
                        if (isset($tel_4_alterno)) {
                            echo $tel_4_alterno;
                        }
                        ?>'><br>
                                                                  <?php
                                                              }
                                                              if ($cliente == 'UR') {
                                                                  ?>
                        <span class='formcap'>Madre</span>
                    <?php } else { ?>
                        <span class='formcaps'>Ref 1</span>
                        <?php
                    }
                    if (isset($nombre_referencia_1)) {
                        ?>
                        <input type='text' size=40 name=nombre_referencia_1 id="nombre_referencia_1" readonly='readonly' value='<?php
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
                        <span class='formcaps'>Tel Casa</span><input type='text' name=tel_1_ref_1 id="tel_1_ref_1" readonly='readonly' value='<?php
                        if (isset($tel_1_ref_1)) {
                            echo $tel_1_ref_1;
                        }
                        ?>'><br>
                                                                     <?php
                                                                 }
                                                                 if (isset($tel_2_ref_1)) {
                                                                     ?>
                        <span class='formcaps'>Tel Cel</span><input type='text' name=tel_2_ref_1 id="tel_2_ref_1" readonly='readonly' value='<?php
                        if (isset($tel_2_ref_1)) {
                            echo $tel_2_ref_1;
                        }
                        ?>'><br>
                                                                    <?php
                                                                }
                                                                ?>
                    <span class='formcaps'>Ref 2</span>
                    <?php if (isset($nombre_referencia_2)) { ?>
                        <input type='text' size=40 name=nombre_referencia_2 id="nombre_referencia_2" readonly='readonly' value='<?php
                        if (isset($nombre_referencia_2)) {
                            echo htmlentities($nombre_referencia_2);
                        }
                        ?>'>
                               <?php
                           }
                           if (isset($referencias_2)) {
                               ?>
                        <input type='text' name=referencias_2  class='shortinp' readonly='readonly' value='<?php
                        if (isset($referencias_2)) {
                            echo $referencias_2;
                        }
                        ?>'><br>
                           <?php } ?>
                    <br>
                    <?php if (isset($tel_1_ref_2)) { ?>
                        <span class='formcaps'>Tel Casa</span><input type='text' name=tel_1_ref_2 id="tel_1_ref_2" readonly='readonly' value='<?php
                        if (isset($tel_1_ref_2)) {
                            echo $tel_1_ref_2;
                        }
                        ?>'><br>
                                                                     <?php
                                                                 }
                                                                 if (isset($tel_2_ref_2)) {
                                                                     ?>
                        <span class='formcaps'>Tel Cel</span><input type='text' name=tel_2_ref_2 id="tel_2_ref_2" readonly='readonly' value='<?php
                        if (isset($tel_2_ref_2)) {
                            echo $tel_2_ref_2;
                        }
                        ?>'><br>
                                                                    <?php
                                                                }
                                                                if ($cliente == 'UR') {
                                                                    ?>
                        <span class='formcap'>Tutor</span>
                    <?php } else { ?>
                        <span class='formcaps'>Ref 3</span>
                        <?php
                    }
                    if (isset($nombre_referencia_3)) {
                        ?>
                        <input type='text' size=40 name=nombre_referencia_3 id="nombre_referencia_3" readonly='readonly' value='<?php
                        if (isset($nombre_referencia_3)) {
                            echo htmlentities($nombre_referencia_3);
                        }
                        ?>'>
                               <?php
                           }
                           if (isset($referencias_3)) {
                               ?>
                        <input type='text' name=referencias_3  class='shortinp' readonly='readonly' value='<?php
                        if (isset($referencias_3)) {
                            echo $referencias_3;
                        }
                        ?>'><br>
                           <?php } ?>
                    <br>
                    <?php if (isset($tel_1_ref_3)) { ?>
                        <span class='formcaps'>Tel Casa</span><input type='text' name=tel_1_ref_3 id="tel_1_ref_3" readonly='readonly' value='<?php
                        if (isset($tel_1_ref_3)) {
                            echo $tel_1_ref_3;
                        }
                        ?>'><br>
                                                                     <?php
                                                                 }
                                                                 if (isset($tel_2_ref_3)) {
                                                                     ?>
                        <span class='formcaps'>Tel Cel</span><input type='text' name=tel_2_ref_3 id="tel_2_ref_3" readonly='readonly' value='<?php
                        if (isset($tel_2_ref_3)) {
                            echo $tel_2_ref_3;
                        }
                        ?>'><br>
                                                                    <?php
                                                                }
                                                                if (isset($nombre_referencia_4)) {
                                                                    ?>
                        <span class='formcaps'>Ref 4</span>
                        <input type='text' size=40 name=nombre_referencia_4 id="nombre_referencia_4" readonly='readonly' value='<?php
                        if (isset($nombre_referencia_4)) {
                            echo htmlentities($nombre_referencia_4);
                        }
                        ?>'>
                               <?php
                           }
                           if (isset($referencias_4)) {
                               ?>
                        <input type='text' name=referencias_4  class='shortinp' readonly='readonly' value='<?php
                        if (isset($referencias_4)) {
                            echo $referencias_4;
                        }
                        ?>'><br>
                           <?php } ?>
                    <br>
                    <?php if (isset($tel_1_ref_4)) { ?>
                        <span class='formcaps'>Tel Casa</span><input type='text' name=tel_1_ref_4 id="tel_1_ref_4" readonly='readonly' value='<?php
                        if (isset($tel_1_ref_4)) {
                            echo $tel_1_ref_4;
                        }
                        ?>'><br>
                                                                     <?php
                                                                 }
                                                                 if (isset($tel_2_ref_4)) {
                                                                     ?>
                        <span class='formcaps'>Tel Cel</span><input type='text' name=tel_2_ref_4 id="tel_2_ref_4" readonly='readonly' value='<?php
                        if (isset($tel_2_ref_4)) {
                            echo $tel_2_ref_4;
                        }
                        ?>'><br>
                                                                <?php } ?>
                </div>

                <div id="LABORAL">
                    <span class='formcap'>Empresa</span><input type='text' size=100 name=empresa readonly='readonly' value='<?php
                    if (isset($empresa)) {
                        echo $empresa;
                    }
                    ?>'><br>
                    <span class='formcap'>Domicilio</span><input type='text' name=domicilio_laboral readonly='readonly' value='<?php
                    if (isset($domicilio_laboral)) {
                        echo $domicilio_laboral;
                    }
                    ?>'><br>
                    <span class='formcap'>Colonia</span><input type='text' name=colonia_laboral readonly='readonly' value='<?php
                    if (isset($colonia_laboral)) {
                        echo $colonia_laboral;
                    }
                    ?>'><br>
                    <span class='formcap'>Ciudad Estado</span><input type='text' name=ciudad_laboral readonly='readonly' value='<?php
                    if (isset($ciudad_laboral)) {
                        echo $ciudad_laboral;
                    }
                    ?>'><br>
                    <!--<span class='formcap'>Estado/CP</span><input type='text' name=estado_laboral readonly='readonly' value='<?php echo $estado_laboral.'/'.$cp_laboral; ?>'><br>
                    --><br>
                    <span class='formcap'>Tel 1</span><input type='text' name=tel_1_laboral id="tel_1_laboral" readonly='readonly' value='<?php
                    if (isset($tel_1_laboral)) {
                        echo $tel_1_laboral;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel 2</span><input type='text' name=tel_2_laboral id="tel_2_laboral" readonly='readonly' value='<?php
                    if (isset($tel_2_laboral)) {
                        echo $tel_2_laboral;
                    }
                    ?>'><br>
                </div>
                <br>
                </div>
                <div id="EXTRAS">
                    <table summary="sdh extras">
                        <tr>
                            <th>Cliente</th>
                            <th>Segmento</th>
                            <th>Status</th>
                            <th>Cuenta</th>
                            <th>Producto</th>
                            <th>Saldo capital</th>
                            <th>Saldo descuento</th>
                        </tr>
                        <?php
                        foreach ($resultextra as $answerextra) {
                            ?>
                            <tr>
                                <td><?php echo $answerextra['cliente']; ?></td>
                                <td><?php echo $answerextra['status_de_credito']; ?></td>
                                <td><?php echo $answerextra['status_aarsa']; ?></td>
                                <td><?php echo $answerextra['numero_de_cuenta']; ?></td>
                                <td><?php echo $answerextra['productos']; ?></td>
                                <td><?php echo number_format($answerextra['sd'], 2); ?></td>
                                <td><?php echo number_format($answerextra['sdd'], 2); ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>

                <div id="CONTABLES">
                    <table summary="contables">
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
                                <td><input type='text' name="ufolio" id="ufolio" readonly='readonly' value='<?php echo $folio; ?>' />
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
                                    echo '$'.number_format($saldo_cuota);
                                }
                                ?>'></td></tr>
                        </tr>
                        <tr>
                            <td>Saldo total</td>
                            <td><input type='text' name=saldo_total readonly='readonly' value='<?php
                                if (isset($saldo_total)) {
                                    echo '$'.number_format($saldo_total);
                                }
                                ?>'></td>
                                <?php
                                if ($saldo_descuento_1 > 0) {
                                    ?>
                                <td>Saldo total sin gastos</td>
                                <td><input type='text' name=saldo_descuento_1 readonly='readonly' value='<?php echo '$'.number_format($saldo_descuento_1); ?>'></td>
                                <?php
                            }
                            if ($gastos_de_cobranza > 0) {
                                ?>
                                <td>Gastos de Cobranza</td>
                                <td><input type='text' name=gastos_de_cobranza readonly='readonly' value='<?php
                                    echo '$'.number_format($gastos_de_cobranza);
                                    ?>'></td>
                                    <?php
                                }

                                if ($monto_adeudado > 0) {
                                    ?>
                                <td>Monto en Contenci&oacute;n</td>
                                <td><input type='text' name=monto_adeudado readonly='readonly' value='<?php
                                    echo '$'.number_format($monto_adeudado);
                                    ?>'></td>
                                    <?php
                                }
                                ?>
                            <td>% descuento</td>
                            <td><input type='text' name=descuento readonly='readonly' value='<?php
                                if ($saldo_descuento_1 > 0) {
                                    echo number_format(100 - ($saldo_descuento_2
                                        / $saldo_descuento_1) * 100)."%";
                                } else {
                                    echo number_format(100 - ($saldo_descuento_2
                                        / ($saldo_total + 0.01)) * 100)."%";
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
                            <td><input type='text' name=saldo_vencido readonly='readonly' value='<?php echo '$'.number_format($saldo_vencido); ?>'></td>
                            <td>Saldo descuento</td>
                            <td><input type='text' name=saldo_descuento_2 readonly='readonly' value='<?php echo '$'.number_format($saldo_descuento_2); ?>'></td>
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
                                    echo '$'.number_format($monto_ultimo_pago);
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
                                <td>Placa</td>
                                <td><input type='text' name=subproducto readonly='readonly' value='<?php
                                    echo htmlentities($nrpp);
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
                    <span class='formcap'>Telefonos marcados</span><input type='text' name="telefonos_marcados" id="telefonos_marcados" readonly='readonly' value='<?php
                    if (isset($telefonos_marcados)) {
                        echo $telefonos_marcados;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel 1 verificado</span><input type='text' name="tel_1_verif" id="tel_1_verif" readonly='readonly' value='<?php
                    if (isset($tel_1_verif)) {
                        echo $tel_1_verif;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel 2 verificado</span><input type='text' name="tel_2_verif" id="tel_2_verif" readonly='readonly' value='<?php
                    if (isset($tel_2_verif)) {
                        echo $tel_2_verif;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel 3 verificado</span><input type='text' name="tel_3_verif" id="tel_3_verif" readonly='readonly' value='<?php
                    if (isset($tel_3_verif)) {
                        echo $tel_3_verif;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel 4 verificado</span><input type='text' name="tel_4_verif" id="tel_4_verif" readonly='readonly' value='<?php
                    if (isset($tel_4_verif)) {
                        echo $tel_4_verif;
                    }
                    ?>'><br>
                    <span class='formcap'>Tel de ult. contacto</span><input type='text' name="telefono_de_ultimo_contacto" readonly='readonly' value='<?php
                    if (isset($telefono_de_ultimo_contacto)) {
                        echo $telefono_de_ultimo_contacto;
                    }
                    ?>'><br>
                    <span class='formcap'>Ultimo status</span><input type='text' name='ultimo_status_de_la_gestion' readonly='readonly' value='<?php
                    if (isset($ultimo_status_de_la_gestion)) {
                        echo $ultimo_status_de_la_gestion;
                    }
                    ?>'><br>
                </div>

            </form>
            <div id="searchbox">
                <h2>Buscar</h2>
                <form name="search" method="get" action=
                      "buscar.php" id="search">Buscar a: <input type=
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
                        foreach ($resultcl as $answercl) {
                            ?>
                            <option value="<?php echo $answercl[0]; ?>"><?php echo $answercl[0]; ?>
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
            <div class="togglebox" id="VISITA">
                <form action="resumen.php" method="get" id="capturaform" 
                      onSubmit="return validate_form2(this, event,<?php
                      echo $saldo_descuento_2 + 0;
                      ?>,<?php
                      if (empty($AUTH)) {
                          $AUTH = '';
                      }
                      if (($mytipo == 'admin') || ($AUTH != '')) {
                          echo 1;
                      } else {
                          echo 0;
                      }
                      ?>, ' ');
                              this.disabled = true;">
                    <div class="noshow">
                        <input type="text" name="error" readonly="readonly" value="1" ><br>
                        <input type="text" name="C_HRFI" readonly="readonly" value="<?php
                        if (isset($CT)) {
                            echo $CT;
                        }
                        ?>" ><br>
                        <input type="text" name="AUTO" readonly="readonly" value="" ><br>
                        <input type="text" name="find" readonly="readonly" value="<?php
                        if (isset($find)) {
                            echo $find;
                        }
                        ?>" ><br>
                        <input type="text" name="field" readonly="readonly" value="<?php
                        if (isset($field)) {
                            echo $field;
                        }
                        ?>" ><br>
                        <input type="text" name="capt" readonly="readonly" value="<?php
                        if (isset($capt)) {
                            echo $capt;
                        }
                        ?>" ><br>
                        <input type="text" name="camp" readonly="readonly" value="<?php
                        if (isset($camp)) {
                            echo $camp;
                        }
                        ?>" ><br>
                        <input type="text" name="neworder" readonly="readonly" value="<?php
                        if (isset($neworder)) {
                            echo $neworder;
                        }
                        ?>" ><br>
                        <input type="text" name="C_CVGE" readonly="readonly" value="<?php
                        if (isset($C_CVGE)) {
                            echo $C_CVGE;
                        }
                        ?>" ><br>
                        <input type="text" name="C_CVBA" readonly="readonly" value="<?php
                        if (isset($cliente)) {
                            echo $cliente;
                        }
                        ?>" ><br>
                        <input type="text" name="C_ATTE" readonly="readonly" value="" ><br>
                        <input type="text" name="C_CONT" readonly="readonly" value="<?php
                        if (isset($id_cuenta)) {
                            echo $id_cuenta;
                        }
                        ?>" ><br>
                        <input type="text" name="C_CONTAN" readonly="readonly" value="<?php
                        if (isset($status_aarsa)) {
                            echo $status_aarsa;
                        }
                        ?>" ><br>
                        <input type="text" name="CUENTA" id="CUENTA2" readonly="readonly" value="<?php
                        if (isset($numero_de_cuenta)) {
                            echo $numero_de_cuenta;
                        }
                        ?>" ><br>
                        <input type="text" name="C_EJE" readonly="readonly" value="<?php
                        if (isset($ejecutivo_asignado_call_center)) {
                            echo $ejecutivo_asignado_call_center;
                        }
                        ?>" ><br>
                        <input type="text" name="oldgo" readonly="readonly" value="<?php echo $go; ?>" ><br>
                    </div>
                    <p>DICTAMEN DOMICILIO PARTICULAR</p>
                    <table class='visitable'>
                        <tr>
                            <th>Tipo:</th>
                            <td><label><input type="checkbox" name="domtipo" value="casa" id="casa"> Casa</label></td>
                            <td><label><input type="checkbox" name="domtipo" value="departamento" id="departamento"> Departamento</label></td>
                            <td><label><input type="checkbox" name="domtipo" value="terreno" id="terreno"> Terreno</label></td>
                            <td><label><input type="checkbox" name="domtipo" value="trabajo" id="trabajo"> Trabajo/Oficina</label></td>
                        </tr>
                        <tr>
                            <th>Propio:</th>
                            <td><label><input type="checkbox" name="domown" value="propio" id="propio"> Propio</label></td>
                            <td><label><input type="checkbox" name="domown" value="rentado" id="rentado"> Rentado</label></td>
                            <td><label><input type="checkbox" name="domown" value="abandonado" id="abandonado"> Abandonado</label></td>
                            <td><label><input type="checkbox" name="domown" value="deshabilitado" id="deshabilitado"> Deshabilitado</label></td>
                            <td><label><input type="checkbox" name="domown" value="invadido" id="invadido"> Invadido</label></td>
                            <td><label><input type="checkbox" name="domown" value="prestado" id="prestado"> Prestado</label></td>
                            <td><label><input type="checkbox" name="domown" value="laborando" id="laborando"> Laborando</label></td>
                        </tr>
                        <tr>
                            <th>Nivel:</th>
                            <td><label><input type="checkbox" name="C_NSE" value="alto" id="alto">Alto</label></td>
                            <td><label><input type="checkbox" name="C_NSE" value="medio" id="medio">Medio</label></td>
                            <td><label><input type="checkbox" name="C_NSE" value="bajo" id="bajo">Bajo</label></td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
                            <td><label><input type="checkbox" name="domstat" value="malo" id="malo">Malo</label></td>
                            <td><label><input type="checkbox" name="domstat" value="regular" id="regular">Regular</label></td>
                            <td><label><input type="checkbox" name="domstat" value="bueno" id="bueno">Bueno</label></td>
                            <td><label><input type="checkbox" name="domstat" value="excelente" id="excelente">Excelente</label></td>
                        </tr>
                    </table>
                    <p>SE&Ntilde;AS:</p>
                    <span class="formcap">Color:</span>
                    <select name="C_CFAC">
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
                    <span class="formcap">Puerta:</span>
                    <select name="C_CPTA">
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
                    <span class="formcap">Reja/Barandal:</span>
                    <select name="C_CREJ">
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
                    <span class="formcap">Patio/Jard&iacute;n:</span>
                    <select name="C_CPAT">
                        <option value="no">No especifica</option>
                        <option value="si">S&iacute;</option>
                        <option value="no">No</option>
                    </select><br>
                    <span class="formcap">Pisos:</span>
                    <select name="C_CNIV">
                        <option value="planta baja">planta baja</option>
                        <option value="planta alta">planta alta</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value=">3">>3</option>
                    </select><br>
                    <p>DATOS DE LA GESTION</p>
                    <span class="formcap">Hora:</span>
                    <SELECT NAME="C_VH">
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
                    <span class="formcap">Fecha:</span>
                    <SCRIPT LANGUAGE="JavaScript" type="text/javascript">
                        var cal6 = new CalendarPopup();
                        cal6.setMonthNames('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                        cal6.setDayHeaders('Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa');
                        cal6.setWeekStartDay(1);
                        cal6.setTodayText("Hoy");
                    </SCRIPT>
                    <INPUT TYPE="text" NAME="C_VD" ID="C_VD" VALUE="<?php echo $CD ?>" SIZE=15>
                    <BUTTON onClick="cal6.select(document.getElementById('C_VD'), 'anchor6', 'yyyy-MM-dd');
                            return false;" NAME="anchor6" ID="anchor6">eligir</BUTTON>
                    <br>
                    <span class="formcap" id="pcap">Parentesco/Cargo</span>
                    <select name="C_CARG">
                        <option value="">&nbsp;</option>
                        <option value="Aval">Aval</option>
                        <option value="Conyuge">C&oacute;nyuge</option>
                        <option value="Deudor">Deudor</option>
                        <option value="Familiar">Familiar</option>
                        <option value="Hermano/a">Hermano/a</option>
                        <option value="Hijo/a">Hijo/a</option>
                        <option value="Madre">Madre</option>
                        <option value="Otro">Otro</option>
                        <option value="Padre">Padre</option>
                        <option value="Vecino/a">Vecino/a</option>
                    </select><br>
                    <span class="formcap">Gestion</span><textarea rows="2" cols="40" name="C_OBSE1" id='C_OBSE12' onkeypress="tooLong(this)"></textarea><br>
                    <span class="formcap">Acci&oacute;n:</span>
                    <select name="ACCION" style="width: 8cm;">
                        <?php
                        foreach ($resultAccionV as $answerAccionV) {
                            ?>
                            <option style='width: 12cm;' value="<?php echo $answerAccionV[0]; ?>"><?php echo $answerAccionV[0]; ?></option>
                            <?php
                        }
                        ?>
                    </select><br>
                    <span class="formcap">Status:</span>
                    <select name="C_CVST" style="width: 8cm;"  onblur="statusChange(this.form);">
                        <option value="" selected="selected"> </option>
                        <?php
                        foreach ($resultDictamenV as $answerDictamenV) {
                            ?>
                            <option style='width: 12cm;' value="<?php echo $answerDictamenV[0]; ?>"><?php echo $answerDictamenV[0]; ?></option>
                            <?php
                        }
                        ?>
                    </select><br>
                    <span class="formcap">Motivadores:</span>
                    <select name="MOTIV" style="width: 8cm;">
                        <option style='width: 12cm;' value=" ">
                            <?php
                            foreach ($resultMotivV as $answerMotivV) {
                                ?>
                            <option style='width: 12cm;' value="<?php echo $answerMotivV[0]; ?>"><?php echo $answerMotivV[0]; ?></option>
                            <?php
                        }
                        ?>
                    </select><br>
                    <table>
                        <tr>
                            <td> <span class="formcap">Fecha promesa</span>
                                <SCRIPT LANGUAGE="JavaScript" type="text/javascript">
                                    var cal7 = new CalendarPopup();
                                    cal7.setMonthNames('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                                    cal7.setDayHeaders('Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa');
                                    cal7.setWeekStartDay(1);
                                    cal7.setTodayText("Hoy");
                                </SCRIPT>
                                <INPUT TYPE="text" NAME="D_PROMv" ID="D_PROMv" VALUE="" SIZE=15>
                                <BUTTON onClick="cal7.select(document.getElementById('D_PROMv'), 'anchor7', 'yyyy-MM-dd');
                                        return false;" NAME="anchor7" ID="anchor7">eligir</BUTTON>
                                <br>
                                <span class="formcap">Cantidad de pago prometido</span>
                                $<input type="text" name="N_PROMv" value=""><br>
                            </td>
                            <td id='pagocaptv'> <span class="formcap">Fecha ya pag&oacute;</span>
                                <SCRIPT LANGUAGE="JavaScript" type="text/javascript">
                                    var cal8 = new CalendarPopup();
                                    cal8.setMonthNames('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                                    cal8.setDayHeaders('Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa');
                                    cal8.setWeekStartDay(1);
                                    cal8.setTodayText("Hoy");
                                </SCRIPT>
                                <INPUT TYPE="text" NAME="D_PAGOv" ID="D_PAGOv" VALUE="" SIZE=15>
                                <BUTTON onClick="cal8.select(document.getElementById('D_PAGOv'), 'anchor8', 'yyyy-MM-dd');
                                        return false;" NAME="anchor8" ID="anchor8">eligir</BUTTON>
                                <br>
                                <span class="formcap">Cantidad de ya pag&oacute;</span>
                                $<input type="text" name="N_PAGOv" value=""><br>
                            </td>
                        </tr>
                    </table>
                    <span class="formcap">Comentario de promesa</span>
                    <input type="text" name="C_PROM" value=""><br>
                    <span class="formcap">Frecuencia de pago prometido</span>
                    <select name="C_FREQ">
                        <option value="" selected="selected">&nbsp;</option>
                        <option value="unico">Unico</option>
                        <option value="semanales">Semanales</option>
                        <option value="quincenales">Quincenales</option>
                        <option value="mensuales">Mensuales</option>
                        <option value="otro">Otro (en Gestion comentas)</option>
                    </select>
                    <br>
                    <span class="formcap">Visitador:</span>
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
                    <span class="formcap">ENTRE CALLE</span><input type="text" name="C_CALLE1"> Y <input type="text" name="C_CALLE2">
                    <br>
                    <div class="togglebox" id="nuevoboxt2">
                        <span class="formcap">Actualizaci&oacute;n de datos</span><br>
                        <span class="formcap">Tel.</span><input type="text" name="C_NTEL" value=""><br>
                        <span class="formcap">Tel 2.</span><input type="text" size=50 name="C_OBSE2" value=""><br>
                        <span class="formcap">Direcci&oacute;n</span><input type="text" size=50 name="C_NDIR" value=""><br>
                    </div>
                    <input type="hidden" name="go" value="CAPTURADO">
                    <input type="submit" name="CAPTURADO" value="CAPTURADO">
                </form>
            </div>
            <!--</div>-->

            <div id="HISTORIA">
                <table summary="historiahead" border='0' cellpadding='0' cellspacing=
                       '0' width='100%' id="historyhead">
                    <tr>
                        <?php
                        $fieldnames = array("Status", "Fecha/Hora", "Gestor",
                            "Telefono", "Gestion", "Gestion");
                        $fieldsize  = array("status", "timestamp", "chico", "telefono",
                            "gestion", "hidebox");
                        for ($j = 0; $j < 5; $j++) {
                            $fieldname = $fieldnames[$j];
                            ?>
                            <th<?php echo ' class="'.$fieldsize[$j].'"'; ?>><?php
                                if (isset($fieldname)) {
                                    echo $fieldname;
                                }
                                ?></th> <?php
                        }
                        ?></tr>
                </table>
                <?php
                if (!empty($rowsub)) {
                    ?>
                    <div id='tableContainer' class='tableContainer'>
                        <table summary="historia" border='0' cellpadding='0' cellspacing=
                               '0' width='100%' id='historybody'>
                            <tbody class="scrollContent">
                                <?php
                                $j = 0;
                                $c = 0;
                                foreach ($rowsub as $answer) {
                                    $auto      = $answer['auto'];
                                    $visit     = $answer['c_cniv'];
                                    $gestor    = utf8_encode($answer['c_cvge']);
                                    $gestion   = utf8_encode($answer['c_obse1']);
                                    $timestamp = utf8_encode($answer['fecha']);
                                    $stat      = utf8_encode($answer['c_cvst']);
                                    ?>
                                    <tr<?php echo highhist($stat, $visit); ?>><?php
                                        for ($k = 0; $k < 5; $k++) {
                                            $anku = utf8_encode($answer[$k]);
                                            if (is_null($anku)) {
                                                $anku = "&nbsp;";
                                            }
                                            $ank    = str_replace('00:00:00',
                                                '', $anku);
                                            $jscode = '';
                                            if ($fieldsize[$k] == "gestion") {
                                                $jscode1 = " onClick='alert(";
                                                $jscode2 = ")'";
                                                $jscode  = $jscode1.'"'.preg_replace("[\n\r]",
                                                        " ",
                                                        $timestamp.': '.$gestion).'"'.$jscode2;
                                            }
                                            ?>
                                            <td<?php
                                            if ($c == 1) {
                                                echo " style='background-color:#dddddd'";
                                            }
                                            echo ' class="'.$fieldsize[$k].'"'.$jscode;
                                            ?>>
                                                    <?php
                                                    if (isset($ank)) {
                                                        echo htmlentities($ank,
                                                            ENT_QUOTES, "UTF-8");
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
                                <tr><td></td></tr>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
            <div id="GESTION">
                <form action="resumen.php" method="get" id="gestionform" 
                      onSubmit="return validate_form(this, event,<?php
                      echo $saldo_descuento_2 + 0;
                      ?>,<?php
                      if (empty($AUTH)) {
                          $AUTH = '';
                      }
                      if (($mytipo == 'admin') || ($AUTH != '')) {
                          echo 1;
                      } else {
                          echo 0;
                      }
                      ?>, ' ');">
                    <table id="databox">
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
                                            <option value="<?php echo $answerGestor[1]; ?>"><?php echo $answerGestor[0]; ?></option>
                                        <?php }
                                        ?>
                                    </select></td>
                            </tr>
                        <?php } else { ?>
                            <input type="hidden" name="C_CVGE" readonly="readonly" value="<?php
                            if (isset($C_CVGE)) {
                                echo $C_CVGE;
                            }
                            ?>" >
                               <?php } ?>
                        <tr id='authbox' class="hidebox">
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
                                        ?><option <?php echo $t1; ?>value='<?php echo $tel_1 ?>'>TEL Casa - <?php echo $tel_1 ?></option><?php } ?>
                                    <?php if (isset($tel_1_laboral)) { ?><option <?php echo $t1l; ?>value='<?php echo $tel_1_laboral; ?>'>TEL LABORAL 1 - <?php echo $empresa.' - '.$tel_1_laboral; ?></option><?php } ?>
                                    <?php if (isset($tel_1_ref_1)) { ?><option <?php echo $t1r1; ?>value='<?php echo $tel_1_ref_1; ?>'>TEL 1 REF 1 - <?php echo $nombre_referencia_1.' - '.$tel_1_ref_1; ?></option><?php } ?>
                                    <?php if (isset($tel_1_ref_2)) { ?><option <?php echo $t1r2; ?>value='<?php echo $tel_1_ref_2; ?>'>TEL 1 REF 2 - <?php echo $nombre_referencia_2.' - '.$tel_1_ref_2; ?></option><?php } ?>
                                    <?php if (isset($tel_1_ref_3)) { ?><option <?php echo $t1r3; ?>value='<?php echo $tel_1_ref_3; ?>'>TEL 1 REF 3 - <?php echo $nombre_referencia_3.' - '.$tel_1_ref_3; ?></option><?php } ?>
                                    <?php if (isset($tel_1_ref_4)) { ?><option <?php echo $t1r4; ?>value='<?php echo $tel_1_ref_4; ?>'>TEL 1 REF 4 - <?php echo $nombre_referencia_4.' - '.$tel_1_ref_4; ?></option><?php } ?>
                                    <?php if (isset($tel_1_verif)) { ?><option class='verif' <?php echo $t1v; ?>value='<?php echo $tel_1_verif; ?>'>TEL 1 VERIF - <?php echo $tel_1_verif; ?></option><?php } ?>
                                    <?php if (isset($tel_2)) { ?><option <?php echo $t2; ?>value='<?php echo $tel_2; ?>'>CELULAR - <?php echo $tel_2; ?></option><?php } ?>
                                    <?php if (isset($tel_2_laboral)) { ?><option <?php echo $t2l; ?>value='<?php echo $tel_2_laboral; ?>'>TEL LABORAL 2 - <?php echo $empresa.' - '.$tel_2_laboral; ?></option><?php } ?>
                                    <?php if (isset($tel_2_ref_1)) { ?><option <?php echo $t2r1; ?>value='<?php echo $tel_2_ref_1; ?>'>TEL 2 REF 1 - <?php echo $nombre_referencia_1.' - '.$tel_2_ref_1; ?></option><?php } ?>
                                    <?php if (isset($tel_2_ref_2)) { ?><option <?php echo $t2r2; ?>value='<?php echo $tel_2_ref_2; ?>'>TEL 2 REF 2 - <?php echo $nombre_referencia_2.' - '.$tel_2_ref_2; ?></option><?php } ?>
                                    <?php if (isset($tel_2_ref_3)) { ?><option <?php echo $t2r3; ?>value='<?php echo $tel_2_ref_3; ?>'>TEL 2 REF 3 - <?php echo $nombre_referencia_3.' - '.$tel_2_ref_3; ?></option><?php } ?>
                                    <?php if (isset($tel_2_ref_4)) { ?><option <?php echo $t2r4; ?>value='<?php echo $tel_2_ref_4; ?>'>TEL 2 REF 4 - <?php echo $nombre_referencia_4.' - '.$tel_2_ref_4; ?></option><?php } ?>
                                    <?php if (isset($tel_2_verif)) { ?><option class='verif' <?php echo $t2v; ?>value='<?php echo $tel_2_verif; ?>'>TEL 2 VERIF - <?php echo $tel_2_verif; ?></option><?php } ?>
                                    <?php if (isset($tel_3)) { ?><option <?php echo $t3; ?>value='<?php echo $tel_3; ?>'>TEL 3 - <?php echo $tel_3; ?></option><?php } ?>
                                    <?php if (isset($tel_3_verif)) { ?><option class='verif' <?php echo $t3v; ?>value='<?php echo $tel_3_verif; ?>'>TEL 3 VERIF - <?php echo $tel_3_verif; ?></option><?php } ?>
                                    <?php if (isset($tel_4)) { ?><option <?php echo $t4; ?>value='<?php echo $tel_4; ?>'>TEL 4 - <?php echo $tel_4; ?></option><?php } ?>
                                    <?php if (isset($tel_4_verif)) { ?><option class='verif' <?php echo $t4v; ?>value='<?php echo $tel_4_verif; ?>'>TEL 4 VERIF - <?php echo $tel_4_verif; ?></option><?php } ?>
                                    <?php if (isset($telefono_de_ultimo_contacto)) { ?><option <?php echo $tuc; ?>value='<?php echo $telefono_de_ultimo_contacto; ?>'>TEL DE ULT. CONT. - <?php echo $telefono_de_ultimo_contacto; ?></option><?php } ?>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td id="pcap2">Parentesco/Cargo</td>
                            <td><select name="C_CARG">
                                    <option value="">&nbsp;</option>
                                    <option value="Aval">Aval</option>
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
                                          onkeypress="tooLong(this)" onkeyup="valid(this, 'special')" onmouseover='this.focus();'
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
                                        foreach ($resultMotiv as $answerMotiv) {
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
                                    ?>>madrugada</option>
                                    <option value="manana" <?php
                                    if ($CUANDO == 'manana') {
                                        echo 'selected="selected"';
                                    }
                                    ?>>ma&ntilde;ana</option>
                                    <option value="tarde" <?php
                                    if ($CUANDO == 'tarde') {
                                        echo 'selected="selected"';
                                    }
                                    ?>>tarde</option>
                                    <option value="noche" <?php
                                    if ($CUANDO == 'noche') {
                                        echo 'selected="selected"';
                                    }
                                    ?>>noche</option>
                                    <option value="robot" <?php
                                    if ($CUANDO == 'robot') {
                                        echo
                                        'selected="selected"';
                                    }
                                    ?>>robot</option>
                                    <option value="visita" <?php
                                    if ($CUANDO == 'visita') {
                                        echo
                                        'selected="selected"';
                                    }
                                    ?>>visita</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Cant. de promesa unico o 1o</td>
                            <td>$<input type="text" name="N_PROM1" value="0" size="8" onchange="npromChange(this.form);" onmouseover='this.focus();'></td>
                            <td>$<input type="text" name="N_PROM1_OLD" readonly="readonly" size="8" value="<?php
                                if (isset($N_PROM1_OLD)) {
                                    echo $N_PROM1_OLD;
                                }
                                ?>"></td>
                        </tr>
                        <tr>
                            <td>Fecha promesa unico o 1o
                                <SCRIPT LANGUAGE="JavaScript" type="text/javascript">
                                    var cal4 = new CalendarPopup();
                                    var oneMinute = 60 * 1000;  // milliseconds in a minute
                                    var oneHour = oneMinute * 60;
                                    var oneDay = oneHour * 24;
                                    var today = new Date();
                                    var dateInMS = today.getTime() + oneDay * 10;
                                    var yesterday = new Date();
                                    yesterday.setDate(yesterday.getDate() - 1);
                                    cal4.setMonthNames('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                                    cal4.setDayHeaders('Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa');
                                    cal4.setWeekStartDay(1);
                                    cal4.setTodayText("Hoy");
                                    cal4.addDisabledDates(null, formatDate(yesterday, "yyyy-MM-dd"));
                                    cal4.addDisabledDates('<?php echo $dday; ?>', null);
                                </SCRIPT></td>
                            <td><INPUT TYPE="text" NAME="D_PROM1" ID="D_PROM1" VALUE="" SIZE=15> <BUTTON onClick="cal4.select(document.getElementById('D_PROM1'), 'anchor4', 'yyyy-MM-dd');
                                    return false;" NAME="anchor4" ID="anchor4">eligir</BUTTON></td>
                            <td><input type="text" name="D_PROM1_OLD" style="background-color:#c0c0c0;" readonly="readonly" value="<?php
                                if (isset($D_PROM1_OLD)) {
                                    echo $D_PROM1_OLD;
                                }
                                ?>"></td>
                        </tr>
                        <tr>
                            <td>Cant. de promesa 2o</td>
                            <td>$<input type="text" name="N_PROM2" value="0" onchange="npromChange(this.form);" onmouseover='this.focus();'></td>
                            <td>$<input type="text" name="N_PROM2_OLD" size="8" readonly="readonly" value="<?php
                                if (isset($N_PROM2_OLD)) {
                                    echo $N_PROM2_OLD;
                                }
                                ?>"><br>
                        </tr>
                        <tr>
                            <td>Fecha promesa 2o
                                <SCRIPT LANGUAGE="JavaScript" type="text/javascript">
                                    var cal5 = new CalendarPopup();
                                    var yesterday = new Date();
                                    yesterday.setDate(yesterday.getDate() - 1);
                                    cal5.setMonthNames('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                                    cal5.setDayHeaders('Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa');
                                    cal5.setWeekStartDay(1);
                                    cal5.setTodayText("Hoy");
                                    cal5.addDisabledDates(null, formatDate(yesterday, "yyyy-MM-dd"));
                                    cal5.addDisabledDates('<?php echo $dday2; ?>', null);
                                </SCRIPT>
                            </td>
                            <td><INPUT TYPE="text" NAME="D_PROM2" ID="D_PROM2" VALUE="" SIZE=15> 
                                <BUTTON onClick="cal5.select(document.getElementById('D_PROM2'), 'anchor5', 'yyyy-MM-dd');
                                        return false;" NAME="anchor5" ID="anchor5">eligir</BUTTON></td>
                            <td><input type="text" name="D_PROM2_OLD" style="background-color:#c0c0c0;" readonly="readonly" value="<?php
                                if (isset($D_PROM2_OLD)) {
                                    echo $D_PROM2_OLD;
                                }
                                ?>"></td>
                        </tr>
                        <tr>
                            <td>Cant. de promesa 3o</td>
                            <td>$<input type="text" name="N_PROM3" value="0" onchange="npromChange(this.form);" onmouseover='this.focus();'></td>
                            <td>$<input type="text" name="N_PROM3_OLD" size="8" readonly="readonly" value="<?php
                                if (isset($N_PROM3_OLD)) {
                                    echo $N_PROM3_OLD;
                                }
                                ?>"><br>
                        </tr>
                        <tr>
                            <td>Fecha promesa 3o
                                <SCRIPT LANGUAGE="JavaScript" type="text/javascript">
                                    var cal5c = new CalendarPopup();
                                    var yesterday = new Date();
                                    yesterday.setDate(yesterday.getDate() - 1);
                                    cal5c.setMonthNames('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                                    cal5c.setDayHeaders('Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa');
                                    cal5c.setWeekStartDay(1);
                                    cal5c.setTodayText("Hoy");
                                    cal5c.addDisabledDates(null, formatDate(yesterday, "yyyy-MM-dd"));
                                    cal5c.addDisabledDates('<?php echo $dday2; ?>', null);
                                </SCRIPT>
                            </td>
                            <td><INPUT TYPE="text" NAME="D_PROM3" ID="D_PROM3" VALUE="" SIZE=15> 
                                <BUTTON onClick="cal5c.select(document.getElementById('D_PROM3'), 'anchor5c', 'yyyy-MM-dd');
                                        return false;" NAME="anchor5c" ID="anchor5c">eligir</BUTTON></td>
                            <td><input type="text" name="D_PROM3_OLD" style="background-color:#c0c0c0;" readonly="readonly" value="<?php
                                if (isset($D_PROM3_OLD)) {
                                    echo $D_PROM3_OLD;
                                }
                                ?>"></td>
                        </tr>
                        <tr>
                            <td>Cant. de promesa 4o</td>
                            <td>$<input type="text" name="N_PROM4" value="0" onchange="npromChange(this.form);" onmouseover='this.focus();'></td>
                            <td>$<input type="text" name="N_PROM4_OLD" size="8" readonly="readonly" value="<?php
                                if (isset($N_PROM4_OLD)) {
                                    echo $N_PROM4_OLD;
                                }
                                ?>"><br>
                        </tr>
                        <tr>
                            <td>Fecha promesa 4o
                                <SCRIPT LANGUAGE="JavaScript" type="text/javascript">
                                    var cal5d = new CalendarPopup();
                                    var yesterday = new Date();
                                    yesterday.setDate(yesterday.getDate() - 1);
                                    cal5d.setMonthNames('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                                    cal5d.setDayHeaders('Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa');
                                    cal5d.setWeekStartDay(1);
                                    cal5d.setTodayText("Hoy");
                                    cal5d.addDisabledDates(null, formatDate(yesterday, "yyyy-MM-dd"));
                                    cal5d.addDisabledDates('<?php echo $dday2; ?>', null);
                                </SCRIPT>
                            </td>
                            <td><INPUT TYPE="text" NAME="D_PROM4" ID="D_PROM4" VALUE="" SIZE=15> 
                                <BUTTON onClick="cal5d.select(document.getElementById('D_PROM4'), 'anchor5d', 'yyyy-MM-dd');
                                        return false;" NAME="anchor5d" ID="anchor5d">eligir</BUTTON></td>
                            <td><input type="text" name="D_PROM4_OLD" style="background-color:#c0c0c0;" readonly="readonly" value="<?php
                                if (isset($D_PROM4_OLD)) {
                                    echo $D_PROM4_OLD;
                                }
                                ?>"></td>
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
                            <td><input type="text" name="N_PROM" id="N_PROM" readonly="readonly" style="background-color:#c0c0c0;" value=""></td>
                            <td>Cant. prometido anterior</td>
                            <td><input type="text" name="N_PROM_OLD" id="N_PROM_OLD" readonly="readonly" style="background-color:#c0c0c0;" value="<?php
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
                            <td>Fecha Pag&oacute;
                                <SCRIPT LANGUAGE="JavaScript" type="text/javascript">
                                    var cal9 = new CalendarPopup();
                                    cal9.setMonthNames('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                                    cal9.setDayHeaders('Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa');
                                    cal9.setWeekStartDay(1);
                                    cal9.setTodayText("Hoy");
                                </SCRIPT></td>
                            <td><INPUT TYPE="text" NAME="D_PAGO" ID="D_PAGOi" VALUE="" SIZE=15> 
                                <BUTTON onClick="cal9.select(document.getElementById('D_PAGOi'), 'anchor9', 'yyyy-MM-dd');
                                        return false;" NAME="anchor9" ID="anchor9">eligir</BUTTON></td>
                        </tr>
                        <tr>
                            <td colspan=2>Actualizaci&oacute;n de Datos</td>
                        </tr>
                        <tr>
                            <td>Tel.</td>
                            <td><input type="text" name="C_NTEL" value=""  onmouseover='this.focus();'
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
                            <td>E-mail</td>
                            <td><input type="text" name="C_EMAIL" value="" onmouseover='this.focus();'></td>
                        </tr>
                    </table>
                    <input type="submit" name="GUARDAR" id="GUARDbutt" value="GUARDAR" ondblclick="return false;">
                    <button type="button" value="RESET" onclick="this.form.GUARDAR.disabled = false">RESET</button>
                    <br>
                    </div>
                    </div>
                    <div class="noshow">
                        <input type="text" name="from" readonly="readonly" value="resumen.php" ><br>
                        <input type="text" name="D_FECH" readonly="readonly" value="<?php
                        if (isset($CD)) {
                            echo $CD;
                        }
                        ?>" ><br>
                        <input type="text" name="D_PROM" readonly="readonly" value="<?php
                        if (isset($CD)) {
                            echo $CD;
                        }
                        ?>" ><br>
                        <input type="text" name="C_HRIN" readonly="readonly" value="<?php
                        if (isset($CT)) {
                            echo $CT;
                        }
                        ?>" ><br>
                        <input type="text" name="C_HRFI" readonly="readonly" value="<?php
                        if (isset($CT)) {
                            echo $CT;
                        }
                        ?>" ><br>
                        <input type="text" name="AUTO" readonly="readonly" value="" ><br>
                        <input type="text" name="find" readonly="readonly" value="<?php
                        if (isset($find)) {
                            echo $find;
                        }
                        ?>" ><br>
                        <input type="text" name="field" readonly="readonly" value="<?php
                        if (isset($field)) {
                            echo $field;
                        }
                        ?>" ><br>
                        <input type="text" name="capt" readonly="readonly" value="<?php
                        if (isset($capt)) {
                            echo $capt;
                        }
                        ?>" ><br>
                        <input type="text" name="camp" readonly="readonly" value="<?php
                        if (isset($camp)) {
                            echo $camp;
                        }
                        ?>" ><br>
                        <input type="text" name="neworder" readonly="readonly" value="<?php
                        if (isset($neworder)) {
                            echo $neworder;
                        }
                        ?>" ><br>
                        <input type="text" name="C_CVBA" readonly="readonly" value="<?php
                        if (isset($cliente)) {
                            echo $cliente;
                        }
                        ?>" ><br>
                        <input type="text" name="C_ATTE" readonly="readonly" value="" ><br>
                        <input type="text" name="C_CONT" readonly="readonly" value="<?php
                        if (isset($id_cuenta)) {
                            echo $id_cuenta;
                        }
                        ?>" ><br>
                        <input type="text" name="C_CONTAN" readonly="readonly" value="<?php
                        if (isset($status_aarsa)) {
                            echo $status_aarsa;
                        }
                        ?>" ><br>
                        <input type="text" name="CUENTA" id="CUENTA" readonly="readonly" value="<?php
                        if (isset($numero_de_cuenta)) {
                            echo $numero_de_cuenta;
                        }
                        ?>" ><br>
                        <input type="text" name="C_EJE" id="C_EJE" readonly="readonly" value="<?php
                               if (isset($ejecutivo_asignado_call_center)) {
                                   echo $ejecutivo_asignado_call_center;
                               }
                               ?>" ><br>
                        <input type="text" name="oldgo" readonly="readonly" value="<?php echo $go; ?>" ><br>
                        <input type="text" name="error" readonly="readonly" value="1" ><br>
                        <input type="text" name="go" readonly="readonly" value="GUARDAR" ><br>
                    </div>
                </form>
            </div>
        </body>
    </html> 
