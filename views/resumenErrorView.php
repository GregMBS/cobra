<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
    <HTML>
        <HEAD>
            <TITLE>Error de capturar gestion</TITLE>
        </HEAD>
        <BODY>
            <h2><?php echo $flagmsg; ?></h2>
            <a href="resumen.php?capt=<?php 
            echo $capt;
            ?>&field=id_cuenta&find=<?php echo $C_CONT; ?>">Regresa para arreglarlo</a>
        </BODY>
    </HTML>
