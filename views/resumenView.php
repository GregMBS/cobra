<?php
/**
 * @var string[] $clientes
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Resumen</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="/css/resumen.css">
    <style type="text/css">
        <?php if(isset($notalert)){
if ($notalert > 0) { ?>
        #notas input {
            background-color: #ff0000;
        }

        <?php
        }
        }
        if ((preg_match('/-/', $row->status_de_credito)) && ($mytipo <> 'admin')) {
            ?>
        #GuardButt {
            display: none;
        }

        <?php } ?>
        <?php if ($mytipo == 'visitador') { ?>
        #dataBox, #clock {
            display: none;
        }

        <?php } ?>
    </style>
    <script type="text/javascript" src="../js/external/dom-drag.js"></script>
    <script src="/js/resumen.js"></script>
    <script type="text/javascript" src="../js/depuracion.js?rand=1"></script>
    <script type="text/javascript" src="../js/depuracionv.js"></script>
</head>
<body id="todos">
<div id="buttonBox">
    <?php if (($go == 'FromUltima') || ($go == 'FromBuscar')) { ?>
        <form class="buttons" name="seg" method="get" action="../resumen.php" id="segId">
            <input type="hidden" name="capt" value="<?php echo $capt ?>">
            <input type="hidden" name="find" value="<?php echo $id_cuenta ?>">
            <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
            <input type="submit" name="go" value="REINTRO QUEUE"></form>
    <?php } ?>
    <form class="buttons" name="ultima" method="get" action=
    "../resumen.php" id="ultima">
        <input type="hidden" name="capt" value="<?php echo $capt ?>">
        <input type="submit" name="go" value="ULTIMA"></form>
    <form class="buttons" name="buscar" action="../resumen.php" id="buscar">
        <button type="button" value="buscar" onclick="showSearch();">BUSCAR</button>
    </form>
    <form class="buttons" name="migo" method="get" action="/migo.php" id="migo">
        <input type="hidden" name="find" value="<?php echo $capt ?>">
        <input type="hidden" name="capt" value="<?php echo $capt ?>">
        <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
        <input type="submit" name="go" value="CUENTAS"></form>
    <form class="buttons" name="visitList" method="get" action=
    "../realVisitList.php" id="visitList" target="_blank">
        <input type="hidden" name="capt" value="<?php echo $capt ?>">
        <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
        <input type="hidden" name="ejecutivo_asignado_call_center"
               value="<?php echo $row->ejecutivo_asignado_call_center ?>">
        <input type="submit" name="go" value="VISITAS"></form>
    <form class="buttons" name="rotas" method="get" action=
    "../rotas.php" id="rotas">
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
        <form class="buttons" name="pagos" method="get" action="../pagos.php" id="pagos" target="_blank">
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
    <?php $CTA = $row->numero_de_credito; ?>
    <form class="buttons" name="notasLink" method="get" action="../notas.php" id="notas" target="_blank"><input
                type="hidden"
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
    "../queuesg.php" id="queuesg">
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
    "../resumen.php" id="logout">
        <input type="hidden" name="capt" value="<?php
        if (isset($capt)) {
            echo $capt;
        }
        ?>">
        <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
        <input type="submit" name="go" value="LOGOUT"></form>
    <?php if (!empty($camp)) {
        if ($camp == 0) { ?>
            <form action="../resumen.php" method="get">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <input type="hidden" name="id_cuenta" value="<?php echo $id_cuenta ?>">
                <label>
                    <select name="clientefilt" onChange="this.form.submit()">
                        <option value="" <?php if (!empty($clientefilt)) {
                            ?>
                            selected="selected"
                        <?php } ?>>todos
                        </option>
                        <?php
                        foreach ($resultFilter as $filter) {
                            ?>
                            <option value="<?php echo $filter['cliente']; ?>" <?php
                            if (($cliente == $filter['cliente']) && ($sdc == $filter['sdc']) && ($currentQueue == $filter['queue'])) {
                                ?>
                                selected='selected'
                                <?php
                            }
                            ?>><?php echo $filter['cliente'] . ' ' . $filter['sdc'] . ' ' . $filter['queue']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </label>
            </form>
            <?php
        } else {
            if (empty($cliente)) {
                $cliente = '';
            }
            if (empty($sdc)) {
                $sdc = '';
            }
            ?>
            <button><?php echo $cliente . ' ' . $sdc . ' ' . $currentQueue; ?></BUTTON>
            <?php
        }
    }
    if ($mytipo == 'admin') {
        ?>
        <form action="../reports.php" method="get">
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
    <?php }
    include 'privacidadInclude.php';
    ?>

</div>
<div class="clearbox">
    <UL class='tabs'>
        <LI><A onClick="paging('TELEFONOS')">TELEFONOS</A></LI>
        <LI><A onClick="paging('REFERENCIAS')">REFERENCIAS</A></LI>
        <LI><A onClick="paging('LABORAL')">LABORAL</A></LI>
        <LI><A onClick="paging('CONTABLES')">CONTABLES</A></LI>
        <LI><A onClick="paging('MISCELÁNEA')">MISCELÁNEA</A></LI>
        <LI><A onClick="paging('VISITA')">CAPTURA VISITA</A></LI>
        <LI><A onClick="paging('HISTORIA')">HISTORIA</A></LI>
    </UL>
</div>
<form action="../resumen.php" method="post" name="resumenform" id="resumenform">
    <div id="GENERAL">
        <table>
            <tr>
                <td>
                    <label for="nombre_deudor">Deudor</label>
                    <input type='text' size=80 style='width:12cm'
                           name=nombre_deudor id="nombre_deudor"
                           readonly='readonly' value='<?php
                    if (isset($nombre_deudor)) {
                        echo htmlentities($nombre_deudor);
                    }
                    ?>'><br>
                </td>
                <td>
                    <label for="domicilio_deudor" class='formCapa' id='domicilio'>Domicilio</label>
                    <textarea name='domicilio_deudor' id='domicilio_deudor' readonly='readonly' rows=4 cols=20>
                                    <?php echo $domicilio_deudor . "\n" . $colonia_deudor . "\n" . $ciudad_deudor . ", " . $estado_deudor . '  ' . $cp_deudor; ?>
                                    <?php
                                    if (isset($domicilio_deudor_2)) {
                                        echo "\n o \n" . $domicilio_deudor_2;
                                    }
                                    ?>
                                </textarea><br>
                    <?php if (!empty($direccion_nueva)) { ?>
                        <label class='formCapa'>Direcci&oacute;n nueva</label>
                        <span class="fakeInput"><?php echo $direccion_nueva; ?></span>
                        <br>
                        <?php
                    }
                    if (substr($cliente, 0, 9) == "INFONAVIT") {
                        ?>
                        <label class='formCapa'>NSS</label>
                        <span class="fakeInput"><?php echo $nss; ?></span>
                        <br>
                        <?php
                    }
                    if (!empty($avapar)) {
                        ?>
                        <span class='formCapa'>Referencia OXXO</span>
                        <span class="fakeInput"><?php
                            echo $avapar;
                            ?></span><br>
                    <?php } ?>
                </td>
            <tr>
                <td>
                    <span class='formCapa'>Gestor - call center</span>
                    <span class="fakeInput"><?php
                        if (isset($ejecutivo_asignado_call_center)) {
                            echo $ejecutivo_asignado_call_center;
                        }
                        ?></span><br>
                    <span class='formCapa'>Numero de cuenta</span>
                    <span class="fakeInput"><?php
                        if (isset($numero_de_cuenta)) {
                            echo $numero_de_cuenta;
                        }
                        ?></span><br>
                    <span class='formCapa'>Status de cuenta</span>
                    <span class="fakeInput"><?php
                        if (isset($status_aarsa)) {
                            echo $status_aarsa;
                        }
                        ?></span><br>
                    <?php echo $gestiones; ?> gestiones<br>
                    <?php echo $promesas; ?> promesas<br>
                    <?php echo $pagos; ?> pagos<br>
                </td>
                <td>
                    <div id='clock'>
                        <input type="hidden" name="timer" id="timer" readonly="readonly" value="0">
                        <label>:
                            <input type="text" name="timerm" id="timerm" readonly="readonly" value="0" size="3">
                        </label>
                        <label>:
                            <input type="text" name="timers" id="timers" readonly="readonly" value="0" size="3">
                        </label><br>
                        <?php
                        $campoColor = " style='background-color:red; color:white;'";
                        $numGests = $resultNumGests['cng'] or 0;
                        $numProms = $resultNumProm['cnp'] or 0;

                        if ($numGests > 20) {
                            $campoColor = " style='background-color:yellow; color:black;'";
                        }
                        if ($numGests > 40) {
                            $campoColor = " style='background-color:green; color:white;'";
                        }
                        ?>
                        <input type="text"<?php echo $campoColor; ?> name="numgest" id="numGest" readonly="readonly"
                               value="<?php echo $numGests; ?>"><label for="numGest"> gestiones</label>
                        <input type="text" name="numProm" id="numProm" readonly="readonly"
                               value="<?php echo $numProms . ' promesas'; ?>"><label for="numProm"> promesas</label>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="TELEFONOS">
        <span class='formCap'>Tel Casa</span><span class="fakeInput"><?php
            if (isset($tel_1)) {
                echo $tel_1;
            }
            ?></span><br>
        <span class='formCap'>Tel Cel</span><span class="fakeInput"><?php
            if (isset($tel_2)) {
                echo $tel_2;
            }
            ?></span><br>
        <span class='formCap'>Tel 3</span><span class="fakeInput"><?php
            if (isset($tel_3)) {
                echo $tel_3;
            }
            ?></span><br>
        <span class='formCap'>Tel 4</span><span class='fakeInput'><?php
            if (isset($tel_4)) {
                echo $tel_4;
            }
            ?></span><br>
        <span class='formCap'>E-mail</span><span class='fakeInput'><?php
            if (isset($email_deudor)) {
                echo $email_deudor;
            }
            ?></span><br>
    </div>
    <div id="REFERENCIAS">
        <?php if (isset($nombre_deudor_alterno)) { ?>
            <span class='formCaps'>Recadero</span>
            <span><?php
                echo htmlentities($nombre_deudor_alterno);
                ?></span>
            <?php
        }
        if (isset($domicilio_deudor_alterno)) {
            ?>
            <br><span class='formCaps'>Dirección Recadero</span>
            <span class="fakeInput"><?php
                echo $domicilio_deudor_alterno . "\n" .
                    $colonia_deudor_alterno . "\n" .
                    $ciudad_deudor_alterno . "\n" .
                    $estado_deudor_alterno;
                ?>
                        </span>
            <?php
        }
        if (isset($domicilio_deudor_alterno_2a)) {
            ?>
            <span class="fakeInput"><?php
                echo $domicilio_deudor_alterno_2a . "\n" .
                    $colonia_deudor_alterno_2a . "\n" .
                    $ciudad_deudor_alterno_2a . "\n" .
                    $estado_deudor_alterno_2a;
                ?>
                        </span>
            <?php
        }
        if (isset($parentesco_aval)) {
            ?>
            <span class="fakeInput"><?php
                echo $parentesco_aval;
                ?></span><br>
        <?php } ?>
        <br>
        <?php if (isset($tel_1_alterno)) { ?>
            <span class='formCaps'>Tel Casa</span>
            <span class="fakeInput"><?php
                echo $tel_1_alterno;
                ?></span><br>
            <?php
        }
        if (isset($tel_2_alterno)) {
            ?>
            <span class='formCaps'>Tel Cel</span>
            <span class="fakeInput"><?php
                echo $tel_2_alterno;
                ?></span><br>
            <?php
        }
        if (isset($tel_3_alterno)) {
            ?>
            <span class='formCaps'>Tel 3</span>
            <span class="fakeInput"><?php
                echo $tel_3_alterno;
                ?></span><br>
            <?php
        }
        if (isset($tel_4_alterno)) {
            ?>
            <span class='formCaps'>Tel 4</span>
            <span class="fakeInput"><?php
                echo $tel_4_alterno;
                ?></span><br>
            <?php
        }
        if ($cliente == 'UR') {
            ?>
            <span class='formCap'>Madre</span>
        <?php } else { ?>
            <span class='formCaps'>Ref 1</span>
            <?php
        }
        if (isset($nombre_referencia_1)) {
            ?>
            <span class="fakeInput"><?php
                echo htmlentities($nombre_referencia_1);
                ?></span>
            <?php
        }
        if (isset($referencias_1)) {
            ?>
            <span class="fakeInput"><?php
                echo $referencias_1;
                ?></span><br>
        <?php } ?>
        <br>
        <?php if (isset($tel_1_ref_1)) { ?>
            <span class='formCaps'>Tel Casa</span>
            <span class="fakeInput"><?php
                echo $tel_1_ref_1;
                ?></span><br>
            <?php
        }
        if (isset($tel_2_ref_1)) {
            ?>
            <span class=' formCaps'>Tel Cel</span>
            <span class="fakeInput"><?php
                echo $tel_2_ref_1;
                ?></span><br>
            <?php
        }
        ?>
        <span class='formCaps'>Ref 2</span>
        <?php if (isset($nombre_referencia_2)) { ?>
            <span class="fakeInput"><?php
                echo htmlentities($nombre_referencia_2);
                ?></span>
            <?php
        }
        if (isset($referencias_2)) {
            ?>
            <span class="fakeInput"><?php
                echo $referencias_2;
                ?></span><br>
        <?php } ?>
        <br>
        <?php if (isset($tel_1_ref_2)) { ?>
            <span class='formCaps'>Tel Casa</span>
            <span class="fakeInput"><?php
                echo $tel_1_ref_2;
                ?></span><br>
            <?php
        }
        if (isset($tel_2_ref_2)) {
            ?>
            <span class=' formCaps'>Tel Cel</span>
            <span class="fakeInput"><?php
                echo $tel_2_ref_2;
                ?></span><br>
            <?php
        }
        if ($cliente == 'UR') {
            ?>
            <span class=' formCap'>Tutor</span>
        <?php } else { ?>
            <span class='formCaps'>Ref 3</span>
            <?php
        }
        if (isset($nombre_referencia_3)) {
            ?>
            <span class="fakeInput"><?php
                echo htmlentities($nombre_referencia_3);
                ?></span>
            <?php
        }
        if (isset($referencias_3)) {
            ?>
            <span class="fakeInput"><?php
                echo $referencias_3;
                ?></span><br>
        <?php } ?>
        <br>
        <?php if (isset($tel_1_ref_3)) { ?>
            <span class='formCaps'>Tel Casa</span>
            <span class="fakeInput"><?php
                echo $tel_1_ref_3;
                ?></span><br>
            <?php
        }
        if (isset($tel_2_ref_3)) {
            ?>
            <span class=' formCaps'>Tel Cel</span>
            <span class="fakeInput"><?php
                echo $tel_2_ref_3;
                ?></span><br>
            <?php
        }
        if (isset($nombre_referencia_4)) {
            ?>
            <span class=' formCaps'>Ref 4</span>
            <span class="fakeInput"><?php
                echo htmlentities($nombre_referencia_4);
                ?></span>
            <?php
        }
        if (isset($referencias_4)) {
            ?>
            <span class="fakeInput"><?php
                echo $referencias_4;
                ?></span><br>
        <?php } ?>
        <br>
        <?php if (isset($tel_1_ref_4)) { ?>
            <span class='formCaps'>Tel Casa</span>
            <span class="fakeInput"><?php
                echo $tel_1_ref_4;
                ?></span><br>
            <?php
        }
        if (isset($tel_2_ref_4)) {
            ?>
            <span class=' formCaps'>Tel Cel</span>
            <span class="fakeInput"><?php
                echo $tel_2_ref_4;
                ?></span><br>
        <?php } ?>
    </div>

    <div id="LABORAL">
        <span class=' formCap'>Empresa</span>
        <span class="fakeInput"><?php
            if (isset($empresa)) {
                echo $empresa;
            }
            ?></span><br>
        <span class=' formCap'>Domicilio</span><span class='fakeInput'><?php
            if (isset($domicilio_laboral)) {
                echo $domicilio_laboral;
            }
            ?></span><br>
        <span class='formCap'>Colonia</span><span class='fakeInput'><?php
            if (isset($colonia_laboral)) {
                echo $colonia_laboral;
            }
            ?></span><br>
        <span class='formCap'>Ciudad Estado</span>
        <span class="fakeInput"><?php
            if (isset($ciudad_laboral)) {
                echo $ciudad_laboral;
            }
            ?></span><br>
        <br>
        <span class=' formCap'>Tel 1</span>
        <span class="fakeInput"><?php
            if (isset($tel_1_laboral)) {
                echo $tel_1_laboral;
            }
            ?></span><br>
        <span class=' formCap'>Tel 2</span>
        <span class="fakeInput"><?php
            if (isset($tel_2_laboral)) {
                echo $tel_2_laboral;
            }
            ?></span><br>
    </div>
    <br>

    <div id="CONTABLES">
        <table>
            <tr>
                <td>Numero de credito</td>
                <td><span class="fakeInput"><?php
                        if (isset($numero_de_credito)) {
                            echo $numero_de_credito;
                        }
                        ?></span></td>
                <td>ID cuenta</td>
                <td><span class="fakeInput"><?php
                        if (isset($id_cuenta)) {
                            echo $id_cuenta;
                        }
                        ?></span></td>
                <?php if (!empty($folio)) { ?>
                <td>Ultimo folio</td>
                <td><span class="fakeInput"><?php echo $folio; ?>'/>
        <?php } ?></span></td>
            </tr>
            <tr>
                <td>Fecha de asignacion</td>
                <td><span class="fakeInput"><?php
                        if (isset($fecha_de_asignacion)) {
                            echo $fecha_de_asignacion;
                        }
                        ?></span></td>
                <td>Fecha de actualizacion</td>
                <td><span class="fakeInput"><?php
                        if (isset($fecha_de_actualizacion)) {
                            echo $fecha_de_actualizacion;
                        }
                        ?></span></td>
                <td>RFC deudor</td>
                <td><span class="fakeInput"><?php
                        if (isset($rfc_deudor)) {
                            echo $rfc_deudor;
                        }
                        ?></span></td>
            </tr>
            <tr>
                <td>Fecha de retiro</td>
                <td><span class="fakeInput"><?php
                        if (isset($fecha_de_deasignacion)) {
                            echo $fecha_de_deasignacion;
                        }
                        ?></span></td>
                <td>Saldo cuota</td>
                <td><span class="fakeInput"><?php
                        if (isset($saldo_cuota)) {
                            echo '$' . number_format($saldo_cuota);
                        }
                        ?></span></td>
            </tr>
            <tr>
                <td>Saldo total</td>
                <td><span class="fakeInput"><?php
                        if (isset($saldo_total)) {
                            echo '$' . number_format($saldo_total);
                        }
                        ?></span></td>
                <?php
                if ($saldo_descuento_1 > 0) {
                    ?>
                    <td>Saldo total sin gastos</td>
                    <td><span class="fakeInput"><?php echo '$' . number_format($saldo_descuento_1); ?></span></td>
                    <?php
                }
                if ($gastos_de_cobranza > 0) {
                    ?>
                    <td>Gastos de Cobranza</td>
                    <td><span class="fakeInput"><?php
                            echo '$' . number_format($gastos_de_cobranza);
                            ?></span></td>
                    <?php
                }

                if ($monto_adeudado > 0) {
                    ?>
                    <td>Monto en Contenci&oacute;n</td>
                    <td><span class="fakeInput"><?php
                            echo '$' . number_format($monto_adeudado);
                            ?></span></td>
                    <?php
                }
                ?>
                <td>% descuento</td>
                <td><span class="fakeInput"><?php
                        if ($saldo_descuento_1 > 0) {
                            echo number_format(100 - ($saldo_descuento_2
                                        / $saldo_descuento_1) * 100) . "%";
                        } else {
                            echo number_format(100 - ($saldo_descuento_2
                                        / ($saldo_total + 0.01)) * 100) . "%";
                        }
                        ?></span></td>
                <td>Frecuencia</td>
                <td><span class="fakeInput"><?php
                        if (isset($frecuencia)) {
                            echo $frecuencia;
                        }
                        ?></span>
                <td>Reestructura</td>
                <td><span class="fakeInput"><?php
                        if (isset($contrato)) {
                            echo $contrato;
                        }
                        ?></span>
                </td>
            </tr>
            <tr>
                <td>Saldo vencido</td>
                <td><span class="fakeInput"><?php echo '$' . number_format($saldo_vencido); ?></span></td>
                <td>Saldo descuento</td>
                <td><span class="fakeInput"><?php echo '$' . number_format($saldo_descuento_2); ?></span></td>
                <td>Productos</td>
                <td><span class="fakeInput"><?php
                        if (!empty($prods)) {
                            echo $prods;
                        } else {
                            echo htmlentities($producto);
                        }
                        ?></span></td>
                <?php
                if (isset($subproducto)) {
                    ?>
                    <td>Grupo</td>
                    <td><span class="fakeInput"><?php
                            echo htmlentities($subproducto);
                            ?></span></td>
                    <?php
                }
                ?>
            </tr>
            <tr>
                <td>Fecha - ultimo pago</td>
                <td><span class="fakeInput"><?php
                        if (isset($fecha_de_ultimo_pago)) {
                            echo $fecha_de_ultimo_pago;
                        }
                        ?></span></td>
                <td>Monto ultimo pago</td>
                <td><span class="fakeInput"><?php
                        if (isset($monto_ultimo_pago)) {
                            echo '$' . number_format($monto_ultimo_pago);
                        }
                        ?></span></td>
                <?php
                if (isset($cuenta_concentradora_1)) {
                    ?>
                    <td>VIN</td>
                    <td><span class="fakeInput"><?php
                            echo htmlentities($cuenta_concentradora_1);
                            ?></span></td>
                    <?php
                }

                if (isset($nrpp)) {
                    ?>
                    <td>Plaza</td>
                    <td><span class="fakeInput"><?php
                            echo htmlentities($nrpp);
                            ?></span></td>
                    <?php
                }

                if (isset($fecha_convenio)) {
                    ?>
                    <td>Facha convenio</td>
                    <td><span class="fakeInput"><?php
                            echo htmlentities($fecha_convenio);
                            ?></span></td>
                    <?php
                }
                ?>
            </tr>
            <tr>
                <td>Segmento</td>
                <td><span class="fakeInput"><?php
                        if (isset($status_de_credito)) {
                            echo $status_de_credito;
                        }
                        ?></span></td>
                <td>Meses vencidos</td>
                <td><span class="fakeInput"><?php
                        if (isset($pagos_vencidos)) {
                            echo $pagos_vencidos;
                        }
                        ?></span>
                <td>D&iacute;as vencidos</td>
                <td><span class="fakeInput"><?php
                        if (isset($dias_vencidos)) {
                            echo $dias_vencidos;
                        }
                        ?></span><br>
            </tr>
        </table>
    </div>
    <div id="MISCELANEA">
        <span class='formCap'>Telefonos marcados</span>
        <span class="fakeInput"><?php
            if (isset($telefonos_marcados)) {
                echo $telefonos_marcados;
            }
            ?></span><br>
        <span class='formCap'>Tel 1 verificado</span>
        <span class="fakeInput"><?php
            if (isset($tel_1_verif)) {
                echo $tel_1_verif;
            }
            ?></span><br>
        <span class='formCap'>Tel 2 verificado</span>
        <span class="fakeInput"><?php
            if (isset($tel_2_verif)) {
                echo $tel_2_verif;
            }
            ?></span><br>
        <span class='formCap'>Tel 3 verificado</span>
        <span class="fakeInput"><?php
            if (isset($tel_3_verif)) {
                echo $tel_3_verif;
            }
            ?></span><br>
        <span class='formCap'>Tel 4 verificado</span>
        <span class="fakeInput"><?php
            if (isset($tel_4_verif)) {
                echo $tel_4_verif;
            }
            ?></span><br>
        <span class='formCap'>Tel de ult. contacto</span>
        <span class="fakeInput"><?php
            if (isset($telefono_de_ultimo_contacto)) {
                echo $telefono_de_ultimo_contacto;
            }
            ?></span><br>
        <span class='formCap'>Ultimo status</span>
        <span class="fakeInput"><?php
            if (isset($ultimo_status_de_la_gestion)) {
                echo $ultimo_status_de_la_gestion;
            }
            ?></span><br>
    </div>

</form>
<div id="SearchBox">
    <h2>Buscar</h2>
    <form name="search" method="get" action="../buscar.php" id="search">
        <label>Buscar a: <input type=
                                "text" name="find" id="find"></label>
        <label>en <select name="field">
                <option value="numero_de_cuenta">Cuenta</option>
                <option value="numero_de_credito"># del Grupo</option>
                <option value="nombre_deudor">Nombre</option>
                <option value="domicilio_deudor">Direcci&oacute;n</option>
                <option value="TELS">Telefonos</option>
                <option value="ROBOT">Telefonos marcados</option>
                <option value="REFS">Aval/Referencias</option>
                <option value="id_cuenta">Expediente</option>
            </select></label><br>
        <label>Client = <select name="cliente">
                <option value=" ">Todos</option>
                <?php
                foreach ($clientes as $answerCliente) {
                    ?>
                    <option value="<?php echo $answerCliente; ?>"><?php echo $answerCliente; ?>
                    </option>
                <?php } ?>
            </select></label><br>
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
        <input type="hidden" name="from" value="resumen.php">
        <input type="submit" name="go" value="BUSCAR">
        <input type="button" name="cancel" onclick="cancelbox('SearchBox')"
               value="Cancel">
    </form>
</div>
<div class="togglebox" id="VISITA">
    <form action="../resumen.php" method="get" id="capturaForm">
        <?php
        require __DIR__ . '/resumenHiddenFields.php';
        ?>
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
                <td><label><input type="checkbox" name="domown" value="propio" id="propio"> Propio</label></td>
                <td><label><input type="checkbox" name="domown" value="rentado" id="rentado"> Rentado</label></td>
                <td><label><input type="checkbox" name="domown" value="abandonado" id="abandonado"> Abandonado</label>
                </td>
                <td><label><input type="checkbox" name="domown" value="deshabilitado" id="deshabilitado"> Deshabilitado</label>
                </td>
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
        <label class="formCap">Color:
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
                <option value="Metálica">Metálica</option>
                <option value="Morada">Morada</option>
                <option value="Naranja">Naranja</option>
                <option value="Negra">Negra</option>
                <option value="Roja">Roja</option>
                <option value="Rosa">Rosa</option>
                <option value="Verde">Verde</option>
            </select></label><br>
        <label class="formCap">Puerta:
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
                <option value="Metálica">Metálica</option>
                <option value="Morada">Morada</option>
                <option value="Naranja">Naranja</option>
                <option value="Negra">Negra</option>
                <option value="Roja">Roja</option>
                <option value="Rosa">Rosa</option>
                <option value="Verde">Verde</option>
            </select></label><br>
        <label class="formCap">Reja/Barandal:
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
            </select></label><br>
        <label class="formCap">Patio/Jard&iacute;n:
            <select name="C_CPAT">
                <option value="no">No especifica</option>
                <option value="si">S&iacute;</option>
                <option value="no">No</option>
            </select></label><br>
        <label class="formCap">Pisos:
            <select name="C_CNIV">
                <option value="planta baja">planta baja</option>
                <option value="planta alta">planta alta</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value=">3">>3</option>
            </select></label><br>
        <p>DATOS DE LA GESTION</p>
        <label class="formCap">Hora:
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
            </select></label><label>:
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
            </select></label>
        <br>
        <label class="formCap">Fecha:
            <INPUT TYPE="date" NAME="C_VD" ID="C_VD" VALUE="<?php echo $CD ?>" SIZE=15></label>
        <br>
        <label class="formCap" id="pcap">Parentesco/Cargo
            <select name="C_CARG">
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
            </select></label><br>
        <label class="formCap">Gestion
            <textarea rows="2" cols="40" name="C_OBSE1" id='C_OBSE12' onkeypress="tooLong('C_OBSE12')"></textarea>
        </label><br>
        <label class="formCap">Acci&oacute;n:
            <select name="ACCION" style="width: 8cm;">
                <?php
                foreach ($resultAccionV as $answerAccionV) {
                    ?>
                    <option style='width: 12cm;'
                            value="<?php echo $answerAccionV['accion']; ?>"><?php echo $answerAccionV['accion']; ?></option>
                    <?php
                }
                ?>
            </select></label><br>
        <label class="formCap">Status:
            <select name="C_CVST" style="width: 8cm;">
                <option value="" selected="selected"></option>
                <?php
                foreach ($resultDictamenV as $answerDictamenV) {
                    ?>
                    <option style='width: 12cm;'
                            value="<?php echo $answerDictamenV['dictamen']; ?>"><?php echo $answerDictamenV['dictamen']; ?></option>
                    <?php
                }
                ?>
            </select></label><br>
        <label class="formCap">Motivadores:
            <select name="MOTIV" style="width: 8cm;">
                <option style='width: 12cm;' value=" ">
                    <?php
                    foreach ($resultMotivV

                    as $answerMotivV) {
                    ?>
                <option style='width: 12cm;'
                        value="<?php echo $answerMotivV['motiv']; ?>"><?php echo $answerMotivV['motiv']; ?></option>
                <?php
                }
                ?>
            </select></label><br>
        <table>
            <tr>
                <td><label for="D_PROMv" class="formCap">Fecha promesa
                        <INPUT TYPE="date" NAME="D_PROM" ID="D_PROMv" VALUE="" SIZE=15></label>
                    <br>
                    <label class="formCap">Cantidad de pago prometido
                        $<input type="text" name="N_PROM" id="N_PROMv" value=""></label><br>
                </td>
                <td id='pagocaptv'><label for="D_PAGOv" class="formCap">Fecha ya pag&oacute;
                        <INPUT TYPE="date" NAME="D_PAGO" ID="D_PAGOv" VALUE="" SIZE=15></label>
                    <br>
                    <label class="formCap">Cantidad de ya pag&oacute;
                        $<input type="text" name="N_PAGO" id="N_PAGOv" value=""></label><br>
                </td>
            </tr>
        </table>
        <label class="formCap">Comentario de promesa
            <input type="text" name="C_PROM" value=""></label><br>
        <label class="formCap">Frecuencia de pago prometido
            <select name="C_FREQ">
                <option value="" selected="selected">&nbsp;</option>
                <option value="único">Único</option>
                <option value="semanales">Semanales</option>
                <option value="quincenales">Quincenales</option>
                <option value="mensuales">Mensuales</option>
                <option value="otro">Otro (en Gestion comentas)</option>
            </select></label>
        <br>
        <label for="C_VISIT" class="formCap">Visitador:</label>
        <select name="C_VISIT" id="C_VISIT">
            <option value=''></option>
            <?php
            foreach ($resultGestorV as $answerGestorV) {
                ?>
                <option value="<?php echo $answerGestorV['iniciales']; ?>"><?php echo htmlentities($answerGestorV['completo']); ?></option>
            <?php }
            ?>
        </select>
        <br>
        <label class="formCap">ENTRE CALLE <input type="text" name="C_CALLE1"></label>
        <label> Y <input type="text" name="C_CALLE2"></label>
        <br>
        <div class="togglebox" id="nuevoboxt2">
            <span class="formCap">Actualizaci&oacute;n de datos</span><br>
            <label class="formCap">Tel.<input type="text" name="C_NTEL" value=""></label><br>
            <label class="formCap">Tel 2.<input type="text" size=50 name="C_OBSE2" value=""></label><br>
            <label class="formCap">Direcci&oacute;n<input type="text" size=50 name="C_NDIR" value=""></label><br>
        </div>
        <input type="hidden" name="go" value="CAPTURADO">
        <input type="submit" name="CAPTURADO" value="CAPTURADO">
    </form>
</div>
<!--</div>-->

<div id="HISTORIA">
    <table class="special" id="historyhead">
        <tr>
            <?php
            $fieldnames = array("Status", "Fecha/Hora", "Gestor", "Telefono", "Gestion", "Gestion");
            $fieldsize = array("status", "timestamp", "chico", "telefono", "gestion", "hideBox");
            for ($j = 0; $j < 5; $j++) {
                $fieldname = $fieldnames[$j];
                ?>
                <th<?php echo ' class="' . $fieldsize[$j] . '"'; ?>><?php
                    if (isset($fieldname)) {
                        echo $fieldname;
                    }
                    ?></th> <?php
            }
            ?></tr>
    </table>
    <?php
    if (!empty($rowSub)) {
        ?>
        <div id='tableContainer' class='tableContainer'>
            <table class="special" id='historybody'>
                <tbody class="scrollContent">
                <?php
                $j = 0;
                $c = 0;
                foreach ($rowSub as $answer) {
                    $auto = $answer['auto'];
                    $visit = $answer['c_cniv'];
                    $gestor = utf8_encode($answer['c_cvge']);
                    $gestion = utf8_encode($answer['c_obse1']);
                    $timestamp = utf8_encode($answer['fecha']);
                    $stat = utf8_encode($answer['c_cvst']);
                    ?>
                    <tr class="<?php echo $rc->highlight($stat, $visit); ?>"><?php
                        for ($k = 0; $k < 5; $k++) {
                            $anku = utf8_encode($answer[$k]);
                            if (is_null($anku)) {
                                $anku = "&nbsp;";
                            }
                            $ank = str_replace('00:00:00',
                                '', $anku);
                            $jsCode = '';
                            if ($fieldsize[$k] == "gestion") {
                                $jsCode1 = " onClick='alert(";
                                $jsCode2 = ")'";
                                $jsCode = $jsCode1 . '"' . preg_replace("[\n\r]",
                                        " ",
                                        $timestamp . ': ' . $gestion) . '"' . $jsCode2;
                            }
                            ?>
                            <td<?php
                            if ($c == 1) {
                                echo " style='background-color:#dddddd'";
                            }
                            echo ' class="' . $fieldsize[$k] . '"' . $jsCode;
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
    <form action="../resumen.php" method="get" id="gestionForm">
        <table id="dataBox">
            <?php
            if ($mytipo == 'admin' || $mytipo == 'supervisor') {
                ?>
                <tr>
                    <td><label for="C_CVGE">Gestor</label></td>
                    <td><select name="C_CVGE" id="C_CVGE">
                            <option value="<?php echo $capt; ?>"><?php echo $capt; ?></option>
                            <?php
                            foreach ($resultGestor as $answerGestor) {
                                ?>
                                <option value="<?php echo $answerGestor['iniciales']; ?>"><?php echo $answerGestor['iniciales']; ?></option>
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
                <td><label for="AUTH">Autorizaci&oacute;n </label></td>
                <td><input type="password" name="AUTH" id="AUTH" value=""></td>
            </tr>
            <tr>
                <td><label for="C_TELE">Telefono</label></td>
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
                        <option <?php echo $resultBN->t1; ?>value='<?php echo $tel_1 ?>'>TEL Casa
                            - <?php echo $tel_1 ?></option><?php } ?>
                        <?php if (isset($tel_1_laboral)) { ?>
                        <option <?php echo $resultBN->t1l; ?>value='<?php echo $tel_1_laboral; ?>'>TEL LABORAL 1
                            - <?php echo $empresa . ' - ' . $tel_1_laboral; ?></option><?php } ?>
                        <?php if (isset($tel_1_ref_1)) { ?>
                        <option <?php echo $resultBN->t1r1; ?>value='<?php echo $tel_1_ref_1; ?>'>TEL 1 REF 1
                            - <?php echo $nombre_referencia_1 . ' - ' . $tel_1_ref_1; ?></option><?php } ?>
                        <?php if (isset($tel_1_ref_2)) { ?>
                        <option <?php echo $resultBN->t1r2; ?>value='<?php echo $tel_1_ref_2; ?>'>TEL 1 REF 2
                            - <?php echo $nombre_referencia_2 . ' - ' . $tel_1_ref_2; ?></option><?php } ?>
                        <?php if (isset($tel_1_ref_3)) { ?>
                        <option <?php echo $resultBN->t1r3; ?>value='<?php echo $tel_1_ref_3; ?>'>TEL 1 REF 3
                            - <?php echo $nombre_referencia_3 . ' - ' . $tel_1_ref_3; ?></option><?php } ?>
                        <?php if (isset($tel_1_ref_4)) { ?>
                        <option <?php echo $resultBN->t1r4; ?>value='<?php echo $tel_1_ref_4; ?>'>TEL 1 REF 4
                            - <?php echo $nombre_referencia_4 . ' - ' . $tel_1_ref_4; ?></option><?php } ?>
                        <?php if (isset($tel_1_verif)) { ?>
                        <option class='verif' <?php echo $resultBN->t1v; ?>value='<?php echo $tel_1_verif; ?>'>TEL 1 VERIF
                            - <?php echo $tel_1_verif; ?></option><?php } ?>
                        <?php if (isset($tel_2)) { ?>
                        <option <?php echo $resultBN->t2; ?>value='<?php echo $tel_2; ?>'>CELULAR
                            - <?php echo $tel_2; ?></option><?php } ?>
                        <?php if (isset($tel_2_laboral)) { ?>
                        <option <?php echo $resultBN->t2l; ?>value='<?php echo $tel_2_laboral; ?>'>TEL LABORAL 2
                            - <?php echo $empresa . ' - ' . $tel_2_laboral; ?></option><?php } ?>
                        <?php if (isset($tel_2_ref_1)) { ?>
                        <option <?php echo $resultBN->t2r1; ?>value='<?php echo $tel_2_ref_1; ?>'>TEL 2 REF 1
                            - <?php echo $nombre_referencia_1 . ' - ' . $tel_2_ref_1; ?></option><?php } ?>
                        <?php if (isset($tel_2_ref_2)) { ?>
                        <option <?php echo $resultBN->t2r2; ?>value='<?php echo $tel_2_ref_2; ?>'>TEL 2 REF 2
                            - <?php echo $nombre_referencia_2 . ' - ' . $tel_2_ref_2; ?></option><?php } ?>
                        <?php if (isset($tel_2_ref_3)) { ?>
                        <option <?php echo $resultBN->t2r3; ?>value='<?php echo $tel_2_ref_3; ?>'>TEL 2 REF 3
                            - <?php echo $nombre_referencia_3 . ' - ' . $tel_2_ref_3; ?></option><?php } ?>
                        <?php if (isset($tel_2_ref_4)) { ?>
                        <option <?php echo $resultBN->t2r4; ?>value='<?php echo $tel_2_ref_4; ?>'>TEL 2 REF 4
                            - <?php echo $nombre_referencia_4 . ' - ' . $tel_2_ref_4; ?></option><?php } ?>
                        <?php if (isset($tel_2_verif)) { ?>
                        <option class='verif' <?php echo $resultBN->t2v; ?>value='<?php echo $tel_2_verif; ?>'>TEL 2 VERIF
                            - <?php echo $tel_2_verif; ?></option><?php } ?>
                        <?php if (isset($tel_3)) { ?>
                        <option <?php echo $resultBN->t3; ?>value='<?php echo $tel_3; ?>'>TEL 3
                            - <?php echo $tel_3; ?></option><?php } ?>
                        <?php if (isset($tel_3_verif)) { ?>
                        <option class='verif' <?php echo $resultBN->t3v; ?>value='<?php echo $tel_3_verif; ?>'>TEL 3 VERIF
                            - <?php echo $tel_3_verif; ?></option><?php } ?>
                        <?php if (isset($tel_4)) { ?>
                        <option <?php echo $resultBN->t4; ?>value='<?php echo $tel_4; ?>'>TEL 4
                            - <?php echo $tel_4; ?></option><?php } ?>
                        <?php if (isset($tel_4_verif)) { ?>
                        <option class='verif' <?php echo $resultBN->t4v; ?>value='<?php echo $tel_4_verif; ?>'>TEL 4 VERIF
                            - <?php echo $tel_4_verif; ?></option><?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td id="pcap2"><label for="C_CARG">Parentesco/Cargo</label></td>
                <td><select name="C_CARG" id="C_CARG">
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
                <td><label for="C_OBSE1">Gestion</label></td>
                <td><textarea rows="4" cols="50" name="C_OBSE1" id='C_OBSE1'
                              onkeypress="tooLong('C_OBSE1')" onkeyup="valid(this, 'special')"
                              onmouseover='this.focus();'
                              onblur="valid(this, 'special')" onmousedown='this.focus();'></textarea></td>
                <td colspan=2><label>Accion
                        <select name="ACCION" id="ACCION">
                            <?php
                            foreach ($resultAccion as $answerAccion) {
                                ?>
                                <option value="<?php echo $answerAccion['accion']; ?>" style="font-size:120%;"><?php
                                    if (isset($answerAccion['accion'])) {
                                        echo $answerAccion['accion'];
                                    }
                                    ?></option>
                                <?php
                            }
                            ?>
                        </select></label>
                    <br>
                    <label>Status
                        <select name="C_CVST" id="C_CVST">
                            <option value=''></option>
                            <?php
                            foreach ($resultDictamen as $answerDictamen) {
                                ?>
                                <option value="<?php
                                if (isset($answerDictamen['dictamen'])) {
                                    echo htmlentities($answerDictamen['dictamen']);
                                }
                                ?>"
                                        style="font-size:120%;">
                                    <?php
                                    if (isset($answerDictamen['dictamen'])) {
                                        echo htmlentities($answerDictamen['dictamen']);
                                    }
                                    ?>
                                </option>
                            <?php } ?>
                        </select></label><br>
                    <label>Causa no pago
                        <select name="C_CNP" id="C_CNP">
                            <?php
                            foreach ($resultCnp as $answerCnp) {
                                ?>
                                <option value="<?php echo $answerCnp['status']; ?>" style="font-size:120%;"><?php
                                    if (isset($answerCnp['status'])) {
                                        echo htmlentities($answerCnp['status']);
                                    }
                                    ?></option>
                                <?php
                            }
                            ?>
                        </select></label>

                </td>
            </tr>
            <tr>
                <td><label for="C_MOTIV">Motivadores</label></td>
                <td><select id="C_MOTIV" name="C_MOTIV">
                        <option value=" ">
                            <?php
                            foreach ($resultMotiv

                            as $answerMotiv) {
                            ?>
                        <option value="<?php echo $answerMotiv['motiv']; ?>"><?php echo $answerMotiv['motiv']; ?></option>
                        <?php
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><label>Se necesita localizar <input type="checkbox" name="LOCALIZAR" id="localizar" <?php
                        if (!empty($localizar)) {
                            echo 'selected="selected"';
                        }
                        ?>></label></td>
                <td colspan=2><label>Localizable <select name='CUANDO'>
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
                        </select></label></td>
            </tr>
            <tr>
                <td><label for="N_PROM1">Cant. de promesa único o 1o</label></td>
                <td>$<input type="text" name="N_PROM1" id="N_PROM1" value="0" size="8"
                            onchange="npromChange(this.form);"
                            onmouseover='this.focus();'></td>
                <td><span class="fakeInput">$<?php
                        if (isset($N_PROM1_OLD)) {
                            echo $N_PROM1_OLD;
                        }
                        ?></span></td>
            </tr>
            <tr>
                <td><label for="D_PROM1">Fecha promesa único o 1o</label></td>
                <td><input type="date" name="D_PROM1" id="D_PROM1" value="" size=15
                           min="<?php echo date('Y-m-d'); ?>>"
                           max="<?php echo date('Y-m-d', strtotime("+2 weeks")); ?>"></td>
                <td><span class="fakeInput"><?php
                        if (isset($D_PROM1_OLD)) {
                            echo $D_PROM1_OLD;
                        }
                        ?></span></td>
            </tr>
            <tr>
                <td><label for="N_PROM2">Cant. de promesa 2o</label></td>
                <td>$<input type="text" name="N_PROM2" id="N_PROM2" value="0" onchange="npromChange(this.form);"
                            onmouseover='this.focus();'></td>
                <td><span class="fakeInput">$<?php
                    if (isset($N_PROM2_OLD)) {
                        echo $N_PROM2_OLD;
                    }
                    ?></span><br>
            </tr>
            <tr>
                <td><label for="D_PROM2">Fecha promesa 2o</label></td>
                <td><INPUT TYPE="date" NAME="D_PROM2" ID="D_PROM2" VALUE="" SIZE=15
                           min="<?php echo date('Y-m-d'); ?>>"
                           max="<?php echo date('Y-m-d', strtotime("+2 months")); ?>">
                </td>
                <td><span class="fakeInput"><?php
                           if (isset($D_PROM2_OLD)) {
                               echo $D_PROM2_OLD;
                           }
                        ?></span></td>
            </tr>
            <tr>
                <td><label for="N_PROM3">Cant. de promesa 3o</label></td>
                <td>$<input type="text" name="N_PROM3" id="N_PROM3" value="0" onchange="npromChange(this.form);"
                            onmouseover='this.focus();'></td>
                <td><span class="fakeInput">$<?php
                    if (isset($N_PROM3_OLD)) {
                        echo $N_PROM3_OLD;
                    }
                    ?></span><br>
            </tr>
            <tr>
                <td><label for="D_PROM3">Fecha promesa 3o</label></td>
                <td><INPUT TYPE="date" NAME="D_PROM3" ID="D_PROM3" VALUE="" SIZE=15
                           min="<?php echo date('Y-m-d'); ?>>"
                           max="<?php echo date('Y-m-d', strtotime("+2 months")); ?>">
                </td>
                <td><span class="fakeInput"><?php
                           if (isset($D_PROM3_OLD)) {
                               echo $D_PROM3_OLD;
                           }
                        ?></span></td>
            </tr>
            <tr>
                <td><label for="N_PROM4">Cant. de promesa 4o</label></td>
                <td>$<input type="text" name="N_PROM4" id="N_PROM4" value="0" onchange="npromChange(this.form);"
                            onmouseover='this.focus();'></td>
                <td><span class="fakeInput">$<?php
                    if (isset($N_PROM4_OLD)) {
                        echo $N_PROM4_OLD;
                    }
                        ?></span><br>
            </tr>
            <tr>
                <td><label for="D_PROM4">Fecha promesa 4o</label></td>
                <td><INPUT TYPE="date" NAME="D_PROM4" ID="D_PROM4" VALUE="" SIZE=15
                           min="<?php echo date('Y-m-d'); ?>>"
                           max="<?php echo date('Y-m-d', strtotime("+2 months")); ?>">
                </td>
                <td><span class="fakeInput"><?php
                           if (isset($D_PROM4_OLD)) {
                               echo $D_PROM4_OLD;
                           }
                        ?></span></td>
            </tr>
            <tr>
                <td><label for="C_PROM">Frecuencia de promesa</label></td>
                <td><select name="C_PROM" id="C_PROM">
                        <option selected="selected" value="">&nbsp;</option>
                        <option value="único">Único</option>
                        <option value="dos pagos">Dos pagos</option>
                        <option value="semanales">Semanales</option>
                        <option value="quincenales">Quincenales</option>
                        <option value="mensuales">Mensuales</option>
                        <option value="otro">Otro (en Gestion comentas)</option>
                    </select></td>
            </tr>
            <tr>
                <td><label for="N_PROM">Cant. de promesa total</label></td>
                <td><input type="text" name="N_PROM" id="N_PROM" readonly="readonly" style="background-color:#c0c0c0;"
                           value=""></td>
                <td>Cant. prometido anterior</td>
                <td><span class="fakeInput"><?php
                    if (isset($N_PROM_OLD)) {
                        echo floor($N_PROM_OLD);
                    }
                        ?></span></td>
            </tr>
            <tr id="pagocapt">
                <td><label for="N_PAGO">Monto Pag&oacute;</label></td>
                <td>$<input type="text" name="N_PAGO" id="N_PAGO" value="0" onmouseover='this.focus();'></td>
            </tr>
            <tr id="pagocapt2">
                <td><label for="D_PAGOi">Fecha Pag&oacute;</label></td>
                <td><INPUT TYPE="date" NAME="D_PAGO" ID="D_PAGOi" VALUE="" SIZE=15
                           min="<?php echo date('Y-m-d'); ?>>">
                </td>
            </tr>
            <tr>
                <td colspan=2>Actualización de Datos</td>
            </tr>
            <tr>
                <td><label for="C_NTEL">Tel.</label></td>
                <td><input type="text" name="C_NTEL" id="C_NTEL" value="" onmouseover='this.focus();'
                           onChange="addToTels(4, this)"></td>
            </tr>
            <tr>
                <td><label for="C_OBSE2">Tel 2.</label></td>
                <td><input type="text" size=50 name="C_OBSE2" id="C_OBSE2" value="" onmouseover='this.focus();'
                           onChange="addToTels(5, this)"></td>
            </tr>
            <tr>
                <td><label for="C_NDIR">Dirección</label></td>
                <td><input type="text" size=50 name="C_NDIR" id="C_NDIR" value="" onmouseover='this.focus();'></td>
            </tr>
            <tr>
                <td><label for="C_EMAIL">E-mail</label></td>
                <td><input type="text" name="C_EMAIL" id="C_EMAIL" value="" onmouseover='this.focus();'></td>
            </tr>
        </table>
        <input type="submit" name="go" id="GuardButt" value="GUARDAR" ondblclick="return false;">
        <button type="button" value="RESET" onclick="document.getElementById('GuardButt').disabled = false">RESET</button>
        <br>
        <div class="noshow">
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
        </div>
        <?php
        require __DIR__ . '/resumenHiddenFields.php';
        ?>
    </form>
</div>
<SCRIPT TYPE="text/JavaScript">
    openSearch('<?php echo $tl; ?>');
    <?php
    $pagingBase = "paging('HISTORIA', %u, '%s', '%s');";
    $pagingString = sprintf($pagingBase, $flag, $flagmsg, $row->numero_de_cuenta);
    echo $pagingString;
    ?>
    document.getElementById("capturaForm").addEventListener("submit", function (event) {
        return validate_form2(this, event,<?php
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
    });
    document.getElementById("gestionForm").addEventListener("submit", function (event) {
        let result = validate_form(this, event,<?php
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
        if (result) {
            alert('Guardado');
        } else {
            alert('No guardado');
        }
        return result;
    });
</SCRIPT>
</body>
</html>
