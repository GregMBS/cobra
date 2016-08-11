<?php
$user  = "root";
$pwd   = "DeathSta1";
$dsn   = 'mysql:dbname=cobrajdlr;host=localhost';
$pdo   = new PDO($dsn, $user, $pwd);
$local = $_SERVER['REMOTE_ADDR'];
$go    = filter_input(INPUT_POST, 'go');
$capt  = filter_input(INPUT_POST, 'capt');
$pw    = filter_input(INPUT_POST, 'pwd');
if (!empty($go)) {
    $mynombre = '';
    $field    = '';
    $tipo     = '';
    $enlace   = '';
    $queryg   = "SELECT iniciales, enlace, tipo "
        ."FROM nombres JOIN grupos ON grupo=tipo "
        ."WHERE passw = sha(:pw) "
        ."AND LOWER(iniciales) = LOWER(:capt) "
        ."LIMIT 1";
    $stg      = $pdo->prepare($queryg);
    $stg->bindParam(':pw', $pw);
    $stg->bindParam(':capt', $capt);
    $stg->execute();
    $resultg  = $stg->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resultg as $answerg) {
        $mynombre = $answerg['iniciales'];
        $enlace   = $answerg['enlace'];
        $tipo     = $answerg['tipo'];
        if ($tipo == "callcenter") {
            $field = "ejecutivo_asignado_call_center";
        }
        if ($tipo == "visitador") {
            $field = "ejecutivo_asignado_domiciliario";
        }
        if ($tipo == "admin") {
            $field = "ejecutivo_asignado_call_center";
        }
        $cpw = $mynombre.sha1($pw).date('U');
        if ($mynombre == "gmbs") {
            setcookie('auth', $cpw, time() + 60 * 60 * 24);
        } else {
            setcookie('auth', $cpw, time() + 60 * 60 * 11);
        }
        $queryc = "update nombres "
            ."set ticket = :cpw "
            ."where iniciales = :capt "
            ."and tipo = :tipo";
        $stc    = $pdo->prepare($queryc);
        $stc->bindParam(':cpw', $cpw);
        $stc->bindParam(':capt', $capt);
        $stc->bindParam(':tipo', $tipo);
        $stc->execute();
        $queryq = "update nombres n,queuelist qu
			set n.camp = qu.camp
			where iniciales = gestor
			and status_aarsa = 'Inicial'
			and tipo = 'callcenter'
			and gestor = :capt";
        $stq    = $pdo->prepare($queryq);
        $stq->bindParam(':capt', $capt);
        $stq->execute();
        $queryu = "delete from userlog "
            ."where gestor = :capt "
            ."or usuario = :local";
        $stdu   = $pdo->prepare($queryu);
        $stdu->bindParam(':capt', $capt);
        $stdu->bindParam(':local', $local);
        $stdu->execute();
        $queryl = "insert into userlog (usuario,tipo,fechahora,gestor) "
            ."values (:local, 'login', now(), :capt)";
        $stlu   = $pdo->prepare($queryl);
        $stlu->bindParam(':capt', $capt);
        $stlu->bindParam(':local', $local);
        $stlu->execute();

        $querypl = "insert into permalog "
            ."(usuario,tipo,fechahora,gestor) "
            ."values (:local, 'login', now(), :capt)";
        $stlp    = $pdo->prepare($querypl);
        $stlp->bindParam(':capt', $capt);
        $stlp->bindParam(':local', $local);
        $stlp->execute();
    }
    $echeck = 0;
    if (($enlace != '') && ($echeck == 0)) {
        $queryins = "INSERT INTO historia
			(C_CVGE,C_CVBA,C_CONT,CUENTA,C_CVST,D_FECH,C_HRIN,C_HRFI)
			VALUES (:capt, '', 0, 0, 'login', curdate(), curtime(), curtime())";
        $stih     = $pdo->prepare($queryins);
        $stih->bindParam(':capt', $capt);
        $stih->execute();

        $page = "Location: $enlace?find=$capt&field=$field&i=0&capt=$capt&go=ABINICIO";
        header($page);
    }
}
?> 

<!DOCTYPE html>
<html>
    <head>
        <title>CobraMas</title>
        <?php
        $msg = 'CobraMas';
        ?>
        <style type="text/css">
            body {text-align: center; background-color: #ffffff; width: 50em; color:#000000;}
            div.forma {margin-left:5.5cm; font-weight: bold;}
            div.logo {text-align:center; font-weight: bold;}
            fieldset {width: 21em; background-color: #c0c0c0;}
        </style>
    </head>
    <body>
        <h1><?php echo $msg; ?></h1>
        <em>versi&oacute;n configurado para Servicios Automáticos en Linea SA</em>
        <div class="forma">
            <form action="index.php" method="post" autocomplete="off">
                <fieldset>
                    <div class="username">
                        <span class="formcap">Usuario:</span><input type="password" name="capt" value="" onchange="this.value = this.value.replace(/ /g, '');" /><br>
                    </div>
                    <div class="contrasena">
                        <span class="formcap">Contrase&ntilde;a:</span><input type="password" name="pwd" value=""/><br>
                    </div>
                    <input type="submit" name="go" value="Empezar" />
                </fieldset>
            </form>
        </div>
        <!--
                <p><a href="http://icanhazip.com/">Direcci&oacute;n IP</a></p>
        -->
        <p>&nbsp;</p>
        <a href="licencia.txt">
            <cite>&#169;Gregory Miles Blumenthal Scharf 2016</cite>
        </a>
    </body>
</html>
