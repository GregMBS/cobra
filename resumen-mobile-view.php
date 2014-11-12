<!DOCTYPE HTML>
<html>
    <head>

        <title>Resumen Mob&iacute;l</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/jquery.mobile-1.3.0.min.css">
        <script type="text/JavaScript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/JavaScript" src="js/jquery.mobile-1.3.0.min.js"></script>
        <SCRIPT TYPE="text/JavaScript">
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

            function openSearch() {
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
                window.location="resumen-mobile.php?find=<?php echo $alertcuenta; ?>&field=numero_de_cuenta&capt=<?php echo $capt; ?>&go=FROMALERT&from=resumen-mobile.php&go1=FROMALERT";
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
                $xfield[0] = $get['highlight'];
                $xfind     = "/".$get['hfind']."/";
                $ofield    = $xfield[0];
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
                if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_alterno))) {
                    $xfield[$nn] = 'tel_1_alterno';
                    $nn          = $nn + 1;
                }
                if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_alterno))) {
                    $xfield[$nn] = 'tel_2_alterno';
                    $nn          = $nn + 1;
                }
                if (($ofield == 'TELS') && (preg_match($xfind, $tel_3_alterno))) {
                    $xfield[$nn] = 'tel_3_alterno';
                    $nn          = $nn + 1;
                }
                if (($ofield == 'TELS') && (preg_match($xfind, $tel_4_alterno))) {
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
                if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_laboral))) {
                    $xfield[$nn] = 'tel_1_laboral';
                    $nn          = $nn + 1;
                }
                if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_laboral))) {
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
                while ($xfield[$n] != '') {
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
            window.location="resumen-mobile.php?capt=<?php echo $capt; ?>&go='LOGOUT'";
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
        <script type="text/javascript" src="depuracionv.js"></script>
        <SCRIPT TYPE="text/JavaScript" SRC="CalendarPopup.js"></SCRIPT>
        <SCRIPT type="text/javascript">
$(document).ready(function() {
    $('#buttonbox a').button();
    $("div[data-role='collapsible'] *").click(function() {
        $('html, body').animate({
            scrollTop: $(this).offset().top
        }, 200);
    });
});
        </script>
    </head>
    <body id="todos" data-theme="a"
          onLoad="alerttxt = new String('');
                  openSearch();">
        <div data-role="page" id="home"  data-title="Visitas para <?php echo $capt; ?>">
            <div data-role="header">
                <a href="#buttonbox">Menu</a>
<?php if (!empty($cliente)) { ?>
                    <span onmouseover='this.style.visibility = "hidden";'>
                        <img style="position:absolute;top:0;right:0" height=50 alt="client logo" src='<?php
    echo
    $cliente;
    ?>.jpg'></span>
<?php } ?>

            </div>
            <div data-role="panel" id="buttonbox">
                <form class="buttons" name="ultima" method="get" action=
                      "resumen-mobile.php" id="ultima">
                    <input type="hidden" name="capt" value="<?php echo $capt ?>">
                    <input type="hidden" name="find" value="<?php echo $id_cuenta ?>">
                    <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
                    <input type="submit" name="go" value="ULTIMA">
                </form>
                <a href="#buscar" data-rel="popup">BUSCAR</a>
                <?php if ($noplay == 0) { ?>
                    <form class="buttons" name="migo" method="get" action=
                          "migo<?php
                if (($mytipo == 'admin') && (substr($CR, 0, 4) != 'SELF')) {
                    echo 'admin';
                }
                ?>.php" id="migo">
                        <input type="hidden" name="find" value="<?php echo $tcapt ?>">
                        <input type="hidden" name="capt" value="<?php echo $capt ?>">
                        <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
                        <input type="submit" name="go" value="CUENTAS"></form>
<?php } ?>
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
                <form class="buttons" name="pagos" method="get" action="pagos.php" id="pagos" target="_blank">
                    <input type="hidden" name="capt" value="<?php
                    if (isset($capt)) {
                        echo $capt;
                    }
?>">
                    <input type="hidden" name="id_cuenta" value="<?php
                           if (isset($id_cuenta)) {
                               echo $id_cuenta;
                           }
                           ?>">
                    <input type="submit" name="go" value="PAGOS"></form>
                           <?php if ($mytipo == 'admin') { ?>
                    <form class="buttons" name="folios" method="get" action="folios.php" id="folios" target="_blank">
                        <input type="hidden" name="capt" value="<?php
                        if (isset($capt)) {
                            echo $capt;
                        }
                        ?>">
                        <input type="hidden" name="CUENTA" value="<?php
                    if (isset($numero_de_cuenta)) {
                        echo $numero_de_cuenta;
                    }
                    ?>">
                        <input type="hidden" name="CLIENTE" value="<?php
                                                                                                                          if (isset($cliente)) {
                                                                                                                              echo $cliente;
                                                                                                                          }
                                                                                                                          ?>">
                        <?php
                        $FC = $cliente;
                        if ($FC == 'Sales Finance') {
                            $FC = 'Credito Si';
                        }
                        ?>
                        <input type="hidden" name="FC" value="<?php
                        if (isset($FC)) {
                            echo $FC;
                        }
                        ?>">
                        <input type="hidden" name="mytipo" value="admin">
                        <input type="submit" name="go" value="FOLIOS"></form>
                    <?php
                    }
                    $CTA = $numero_de_credito;
                    ?>
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
                <form class="buttons" name="logout" method="get" action=
                      "resumen-mobile.php" id="logout">
                    <input type="hidden" name="capt" value="<?php
                                        if (isset($capt)) {
                                            echo $capt;
                                        }
                                        ?>">
                    <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
                    <input type="submit" name="go" value="LOGOUT"></form>

                <form class="buttons" name="trouble" method="get" action="trouble.php" id="trouble" target="_blank">
                    <input type="hidden" name="capt" value="<?php
                                    if (isset($capt)) {
                                        echo $capt;
                                    }
                                    ?>">
                    <input type="submit" name="go" value="ERROR">
                </form>
            </div>
            <div data-role="content">
                <br>
                <form action="resumen-mobile.php" method="post" name="resumenform" id=
                      "resumenform">
                    <div data-role="collapsible" id="GENERAL">
                        <h1>Datos Generales</h1>
                        <table>
                            <tr>
                                <td>
                                    <span class='formcapa' id='deudor'>Deudor</span><input type='text' size=40 style='width:12cm' name=nombre_deudor id="nombre_deudor" readonly='readonly' value='<?php
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
if (!empty($domicilio_deudor_2)) {
    echo "\n o \n".$domicilio_deudor_2."\n".$colonia_deudor_2."\n".$ciudad_deudor_2.", ".$estado_deudor_2.'  '.$cp_deudor_2;
}
?>
                                    </textarea><br>
                                                                   <?php if (!empty($direccion_nueva)) { ?>
                                        <span class='formcapa'>Direcci&oacute;n nueva</span><input type='text' name=direccion_nueva readonly='readonly' value='<?php echo $direccion_nueva; ?>'><br>
                        <?php
                                                                 }
                                                                 if (substr($cliente,
                                                                         0, 9) == "INFONAVIT") {
                                                                     ?>
                                        <span class='formcapa'>NSS</span><input type='text' name=nss readonly='readonly' value='<?php
                            if (isset($nss)) {
                                echo $nss;
                            }
                            ?>'><br>
                        <?php
                        }
                        if (substr($cliente, 0, 8) == "JURIDICO") {
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
                            </tr>
                        </table>
                    </div>
                    <div data-role="collapsible" id="TELEFONOS">
                        <h1>TEL&Eacute;FONOS</h1>
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
                    <div data-role="collapsible" id="REFERENCIAS">
                        <h1>REFERENCIAS</h1>
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
                                                                     if ($cliente
                                                                         == 'UR') {
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

                    <div data-role="collapsible" id="LABORAL">
                        <h1>LABORAL</h1>
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
                        -->
                        <span class='formcap'>NRPP</span><input type='text' name=estado_laboral readonly='readonly' value='<?php
                if (isset($nrpp)) {
                    echo $nrpp;
                }
                ?>'><br>
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
                    <div data-role="collapsible" id="CONTABLES">
                        <h1>CONTABLES</h1>
                        <table>
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
                                <td>Saldo total sin gastos</td>
                                <td><input type='text' name=saldo_descuento_1 readonly='readonly' value='<?php echo '$'.number_format($saldo_descuento_1); ?>'></td>
                                <td>Gastos de Cobranza</td>
                                <td><input type='text' name=monto_adeudado readonly='readonly' value='<?php echo '$'.number_format($saldo_total
                                       - $saldo_descuento_1); ?>'></td>
                                <td>% descuento</td>
                                <td><input type='text' name=descuento readonly='readonly' value='<?php echo number_format(100
                                       - ($saldo_descuento_2 / ($saldo_descuento_1
                                       + 0.001)) * 100)."%";
                                   ?>'></td>
                            </tr>
                            <tr>
                                <td>Saldo vencido</td>
                                <td><input type='text' name=saldo_vencido readonly='readonly' value='<?php echo '$'.number_format($saldo_vencido); ?>'></td>
                                <td>Saldo descuento</td>
                                <td><input type='text' name=saldo_descuento_2 readonly='readonly' value='<?php echo '$'.number_format($saldo_descuento_2); ?>'></td>
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
                                <td>Productos</td>
                                <td><input type='text' name=producto readonly='readonly' value='<?php
                                   if (!empty($prods)) {
                                       echo $prods;
                                   } else {
                                       echo htmlentities($producto);
                                   }
                                   ?>'></td>
                            </tr>
                            <tr>
                                <td>Rango Mora</td>
                                <td><input type='text' name=subproducto readonly='readonly' value='<?php
                                   if (isset($subproducto)) {
                                       echo htmlentities($subproducto);
                                   }
                                   ?>'><br>
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
                                   ?>'><br>
                            </tr>
                        </table>
                    </div>
                    <div data-role="collapsible" id="MISCELANEA">
                        <h1>MISCELANEA</h1>
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
<?php if ($id_cuenta == 0) { ?>
                    <div id='calm'>
                        <!--<form class="buttons" name="segq" method="get" action=
                        "resumen-mobile.php" id="segq">
                        -->
                        <p>Termino de queue <?php echo $cr; ?>
                        </p>
                    </div>
                    </form>
<?php } ?>
                <div data-role="popup" id="buscar">
                    <h1>Buscar</h1>
                    <form name="search" method="get" action=
                          "buscar.php" id="search">Buscar a: <input type=
                                                              "text" name="find" id="find"> en <select name="field">
                            <option value="numero_de_cuenta">Cuenta</option>
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
$querycl  = "SELECT cliente FROM clientes;";
$resultcl = mysqli_query($con, $querycl);
while ($answercl = mysqli_fetch_array($resultcl)) {
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
                        <input type="hidden" name="from" value="resumen-mobile.php">
                        <input type="submit" name="go1" value="BUSCAR">
                        <input type="button" name="cancel" onclick="cancelbox('searchbox')"
                               value="Cancel">
                    </form>
                </div>
                <div data-role="collapsible" id="VISITA">
                    <h1>CAPTURA VISITA</h1>
                    <form action="resumen-mobile.php" method="get" id="capturaform"
                          onSubmit="return validate_form2(this, event,<?php echo $saldo_descuento_2
+ 0; ?>,<?php
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
                            <input type="hidden" name="error" value="1" >
                            <input type="hidden" name="C_HRFI" value="<?php
if (isset($CT)) {
    echo $CT;
}
?>" >
                            <input type="hidden" name="AUTO" value="" >
                            <input type="hidden" name="find" value="<?php
if (isset($find)) {
    echo $find;
}
?>" >
                            <input type="hidden" name="field" value="<?php
if (isset($field)) {
    echo $field;
}
?>" >
                            <input type="hidden" name="capt" value="<?php
if (isset($capt)) {
    echo $capt;
}
?>" >
                            <input type="hidden" name="camp" value="<?php
if (isset($camp)) {
    echo $camp;
}
?>" >
                            <input type="hidden" name="neworder" value="<?php
if (isset($neworder)) {
    echo $neworder;
}
?>" >
                            <input type="hidden" name="C_CVGE" value="<?php
if (isset($C_CVGE)) {
    echo $C_CVGE;
}
?>" >
                            <input type="hidden" name="C_CVBA" value="<?php
if (isset($cliente)) {
    echo $cliente;
}
?>" >
                            <input type="hidden" name="C_ATTE" value="" >
                            <input type="hidden" name="C_CONT" value="<?php
if (isset($id_cuenta)) {
    echo $id_cuenta;
}
?>" >
                            <input type="hidden" name="C_CONTAN" value="<?php
if (isset($status_aarsa)) {
    echo $status_aarsa;
}
?>" >
                            <input type="hidden" name="CUENTA" id="CUENTA2" value="<?php
if (isset($numero_de_cuenta)) {
    echo $numero_de_cuenta;
}
?>" >
                            <input type="hidden" name="C_EJE" value="<?php
if (isset($ejecutivo_asignado_call_center)) {
    echo $ejecutivo_asignado_call_center;
}
?>" >
                            <input type="hidden" name="oldgo" value="<?php echo mysqli_real_escape_string($con,
    $get['go']); ?>" >
                        </div>
                        <div data-role="collapsible" id="dompart">
                            <h1>DICTAMEN DOMICILIO PARTICULAR</h1>
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
                            </select>
                        </div>
                        <div data-role="collapsible" id="visitdata">
                            <h1>DATOS DE LA GESTION</h1>
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
                            <SCRIPT type="text/javascript">
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
$queryAccionV  = "SELECT accion FROM acciones where visitas=1";
$resultAccionV = mysqli_query($con, $queryAccionV);
while ($answer        = mysqli_fetch_array($resultAccionV)) {
    ?>
                                    <option style='width: 12cm;' value="<?php echo $answer[0]; ?>"><?php echo $answer[0]; ?></option>
    <?php
}
?>
                            </select><br>
                            <span class="formcap">Status:</span>
                            <select name="C_CVST" style="width: 8cm;"  onblur="statusChange(this.form);">
                                <option value="" selected="selected"> </option>
<?php
$queryDictamenV  = "SELECT dictamen FROM dictamenes where visitas=1 order by dictamen";
$resultDictamenV = mysqli_query($con, $queryDictamenV);
while ($answer          = mysqli_fetch_array($resultDictamenV)) {
    ?>
                                    <option style='width: 12cm;' value="<?php echo $answer[0]; ?>"><?php echo $answer[0]; ?></option>
    <?php
}
?>
                            </select><br>
                            <span class="formcap">Motivadores:</span>
                            <select name="MOTIV" style="width: 8cm;">
                                <option style='width: 12cm;' value=" ">
<?php
$queryMotivV  = "SELECT motiv FROM motivadores where visitas=1";
$resultMotivV = mysqli_query($con, $queryMotivV);
while ($answer       = mysqli_fetch_array($resultMotivV)) {
    ?>
                                    <option style='width: 12cm;' value="<?php echo $answer[0]; ?>"><?php echo $answer[0]; ?></option>
    <?php
}
?>
                            </select><br>
                            <table>
                                <tr>
                                    <td> <span class="formcap">Fecha promesa</span>
                                        <SCRIPT type="text/javascript">
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
                                        <SCRIPT type="text/javascript">
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
$query  = "SELECT usuaria,completo FROM nombres where completo<>''
and (tipo='visitador' or tipo='admin')";
$result = mysqli_query($con, $query);
while ($answer = mysqli_fetch_array($result)) {
    ?>
                                    <option value="<?php echo $answer[0]; ?>"><?php echo htmlentities($answer[1]); ?></option>
<?php }
?>
                            </select>
                            <br>
                            <span class="formcap">ENTRE CALLE</span><input type="text" name="C_CALLE1"> Y <input type="text" name="C_CALLE2">
                        </div>
                        <div data-role="collapsible" id="nuevoboxt2">
                            <h1>ACTUALIZACIONES</h1>
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

                <div data-role="collapsible" id="HISTORIA">
                    <h1>HISTORIA</h1>
                    <table id="history" data-role="table" data-mode="columntoggle">
                        <thead>
                            <tr>
<?php
$fieldnames = array("Status", "Fecha/Hora", "Gestor", "Telefono", "Gestion", "Gestion");
$fieldsize  = array("status", "timestamp", "chico", "telefono", "gestion", "hidebox");
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
                        </thead>
<?php
if ($id_cuenta > 0) {
    $querysub = "SELECT c_cvst,concat(d_fech,' ',c_hrin),c_cvge,c_tele,left(c_obse1,50),c_obse1,auto,c_cniv FROM historia 
WHERE historia.C_CONT=".$id_cuenta." and c_cvst <> 'Milt'  
ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
    $rowsub   = mysqli_query($con, $querysub);
    if (!(empty($rowsub))) {
        ?>
                                <tbody class="scrollContent">
        <?php
        $j      = 0;
        $c      = 0;
        while ($answer = mysqli_fetch_array($rowsub)) {
            $auto      = $answer[6];
            $visit     = $answer[7];
            $gestor    = utf8_encode($answer[2]);
            $gestion   = utf8_encode($answer[5]);
            $timestamp = utf8_encode($answer[1]);
            $stat      = utf8_encode($answer[0]);
            ?>
                                        <tr<?php echo highhist($stat, $visit); ?>><?php
            for ($k = 0; $k < 5; $k++) {
                $ank0 = utf8_encode($answer[$k]);
                if (is_null($ank0)) {
                    $ank0 = "&nbsp;";
                }
                $ank    = str_replace('00:00:00', '', $ank0);
                $jscode = '';
                if ($fieldsize[$k] == "gestion") {
                    $jscode1 = " onClick='alert(";
                    $jscode2 = ")'";
                    $jscode  = $jscode1.'"'.ereg_replace("[\n\r]", " ",
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
                    echo htmlentities($ank, ENT_QUOTES, "UTF-8");
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
            </form>
        </div>
    <?php
}
?>
</div>
</div>
</body>
</html> 
