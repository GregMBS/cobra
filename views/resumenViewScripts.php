<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/ju/jqc-1.12.4/dt-1.10.13/datatables.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" type="text/javascript"></script>
<script src="/js/datepicker_mx.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/resumen.js"></script>
<script type="text/javascript" src="/js/depuracion.js"></script>
<script type="text/javascript" src="/js/depuracionv.js"></script>
<script type="text/JavaScript">
    var flag = '<?php echo $flag; ?>';
    var flagmsg = '<?php echo $flagmsg; ?>';
    var cuenta = '<?php echo $CUENTA; ?>';
    var tl = '<?php echo $tl; ?>';
    function openSearch() {
        if (flag !== '0') {
            alert(flagmsg+"\nBuscar para checar que gestion de cuenta "+
                cuenta            
                +" está guardado corectamente.");
        }
        setInterval('clock("'+tl+'")',1000);
<?php
if (!empty($nota['notalertt'])) {
    ?>
            var goalert = confirm("Tiene alerta pendiente <?php echo $nota['notalertt']; ?> para cuenta <?php echo $nota['cuenta']; ?> Quiere verlo?");
            if(goalert==true)
            {
            window.location="resumen.php?find=<?php echo $nota['cuenta']; ?>&field=numero_de_cuenta&capt=<?php echo $capt; ?>&go=FROMALERT&from=resumen.php&go1=FROMALERT";
            }
    <?php
}
if ((preg_match('/-/', $status_de_credito))) {
    ?>
            alert("Esta cuenta está <?php echo $status_de_credito ?>");
    <?php
}
if ($lockflag == 0) {
    $nn = 0;
    $highlight = filter_input(INPUT_GET, 'highlight', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $hfind = filter_input(INPUT_GET, 'hfind', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (empty($highlight)) {
        $xfield[0] = '';
        $xfind = '';
    } else {
        $xfield[0] = $highlight;
        $xfind = "/" . $hfind . "/";
    }
    $ofield = $xfield[0];
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1))) {
        $xfield[$nn] = 'tel_1';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2))) {
        $xfield[$nn] = 'tel_2';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_3))) {
        $xfield[$nn] = 'tel_3';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_4))) {
        $xfield[$nn] = 'tel_4';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_alterno))) {
        $xfield[$nn] = 'tel_1_alterno';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_alterno))) {
        $xfield[$nn] = 'tel_2_alterno';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_3_alterno))) {
        $xfield[$nn] = 'tel_3_alterno';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_4_alterno))) {
        $xfield[$nn] = 'tel_4_alterno';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_verif))) {
        $xfield[$nn] = 'tel_1_verif';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_verif))) {
        $xfield[$nn] = 'tel_2_verif';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_3_verif))) {
        $xfield[$nn] = 'tel_3_verif';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_4_verif))) {
        $xfield[$nn] = 'tel_4_verif';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_laboral))) {
        $xfield[$nn] = 'tel_1_laboral';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_laboral))) {
        $xfield[$nn] = 'tel_2_laboral';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_ref_1))) {
        $xfield[$nn] = 'tel_1_ref_1';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_ref_1))) {
        $xfield[$nn] = 'tel_2_ref_1';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_ref_2))) {
        $xfield[$nn] = 'tel_1_ref_2';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_ref_2))) {
        $xfield[$nn] = 'tel_2_ref_2';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_ref_3))) {
        $xfield[$nn] = 'tel_1_ref_3';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_ref_3))) {
        $xfield[$nn] = 'tel_2_ref_3';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_1_ref_4))) {
        $xfield[$nn] = 'tel_1_ref_4';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $tel_2_ref_4))) {
        $xfield[$nn] = 'tel_2_ref_4';
        $nn = $nn + 1;
    }
    if (($ofield == 'TELS') && (preg_match($xfind, $telefonos_marcados))) {
        $xfield[$nn] = 'telefonos_marcados';
        $nn = $nn + 1;
    }
    if (($ofield == 'REFS') && (preg_match($xfind, $nombre_deudor_alterno))) {
        $xfield[$nn] = 'nombre_deudor_alterno';
        $nn = $nn + 1;
    }
    if (($ofield == 'REFS') && (preg_match($xfind, $nombre_referencia_1))) {
        $xfield[$nn] = 'nombre_referencia_1';
        $nn = $nn + 1;
    }
    if (($ofield == 'REFS') && (preg_match($xfind, $nombre_referencia_2))) {
        $xfield[$nn] = 'nombre_referencia_2';
        $nn = $nn + 1;
    }
    if (($ofield == 'REFS') && (preg_match($xfind, $nombre_referencia_3))) {
        $xfield[$nn] = 'nombre_referencia_3';
        $nn = $nn + 1;
    }
    if (($ofield == 'REFS') && (preg_match($xfind, $nombre_referencia_4))) {
        $xfield[$nn] = 'nombre_referencia_4';
        $nn = $nn + 1;
    }
    if ($ofield == 'ROBOT') {
        $xfield[$nn] = 'historybody';
        $nn = $nn + 1;
    }
    $n = 0;
    while (!empty($xfield[$n])) {
        if ($xfield[$n] != '') {
            ?>
                            document.getElementById("<?php echo $xfield[$n] ?>").style.backgroundColor="yellow";
                            document.getElementById("<?php echo $xfield[$n] ?>").style.fontWeight="bold";
                            document.getElementById("<?php echo $xfield[$n] ?>").parentNode.style.display="block";
            <?php
        }
        $n++;
    }
}
if ($lockflag == 1) {
    ?>
            alert("ERROR RA4 - Esta record está en uso de <?php echo $locker ?>");
<?php } ?>
    }
    function logout()
    {
    window.location="resumen.php?capt=<?php echo $capt; ?>&go='LOGOUT'";
    }
</script>
