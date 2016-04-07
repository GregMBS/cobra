<?php 
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
     $local=$_SERVER['REMOTE_ADDR'];
if (isset($_REQUEST['go'])) {
$go=mysql_real_escape_string($_REQUEST['go']);
}
if (!empty($go)) {
	 $capt=trim(mysql_real_escape_string(strtolower($_REQUEST['capt'])));
$tcapt=$capt;
	 $pw=mysql_real_escape_string($_REQUEST['pwd']);
	 $go=mysql_real_escape_string($_REQUEST['go']);
	 $host  = $_SERVER['HTTP_HOST'];
	 $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$queryg = "SELECT iniciales,enlace,tipo FROM nombres JOIN grupos ON grupo=tipo WHERE passw=sha('".$pw."') and lower(iniciales)=lower('".$capt."') limit 1;";
		$resultg = mysql_query($queryg) or die("ERROR IM1 - ".mysql_error());
		$mynombre='';
		$enlace='index.php';
		$field='';
		$tipo='';
		$enlace='';
		if ($answerg = mysql_fetch_row($resultg)) {
			$mynombre=$answerg[0];
			$enlace=$answerg[1];
			$tipo=$answerg[2];
			if ($tipo=="callcenter") {$field="ejecutivo_asignado_call_center";};
			if ($tipo=="visitador") {$field="ejecutivo_asignado_domiciliario";};
			if ($tipo=="admin") {$field="ejecutivo_asignado_call_center";};
			$cpw=$mynombre.sha1($pw).date('U');
			if ($mynombre=="gmbs") {
			setcookie('auth',$cpw,time()+60*60*24);
			} else {
			setcookie('auth',$cpw,time()+60*60*11);
			}			
			$queryc="update nombres set ticket ='".$cpw."' where iniciales='".$capt."' and tipo='".$tipo."';";
		$resultc = mysql_query($queryc) or die("ERROR IM2 - ".mysql_error());
			$queryq="update nombres n ,queuelist qu 
			set n.camp=qu.camp 
			where iniciales=gestor and status_aarsa='Inicial' and tipo = 'callcenter'
and gestor='".$capt."';";
		$resultq = mysql_query($queryq) or die("ERROR IM3 - ".mysql_error());
			$queryu="delete from userlog where gestor='".$capt."' or usuario='".$local."';";
		$resultu = mysql_query($queryu) or die("ERROR IM4 - ".mysql_error());
			$queryl="insert into userlog (usuario,tipo,fechahora,gestor) values ('".$local."','login',now(),'".$capt."');";
		$resultl = mysql_query($queryl) or die("ERROR IM5 - ".mysql_error());

			$querypl="insert into permalog (usuario,tipo,fechahora,gestor) values ('".$local."','login',now(),'".$capt."');";
		$resultpl = mysql_query($querypl) or die("ERROR IM6 - ".mysql_error());

			}
$echeck=0;
                if (($enlace!='') && ($echeck==0)) {
$queryins="INSERT INTO historia (C_CVGE,C_CVBA,C_CONT,CUENTA,C_CVST,D_FECH,C_HRIN,C_HRFI) 
    VALUES ('".$capt."','',0,0,'login',curdate(),curtime(),curtime());";
mysql_query($queryins);

		$page="Location: ".$enlace."?find=".$tcapt."&field=".$field."&i=0&capt=".$capt."&go=ABINICIO";
	        header($page);
		}
	 }
 ?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>COBRA</title>
<?php 
$useragent = $_SERVER["HTTP_USER_AGENT"];
$msg='COBRA';
if (preg_match("/msie.[4|5|6|7]/i",$_SERVER["HTTP_USER_AGENT"])) {
$msg='Internet Explorer<8 no sirve bien ahora. Usa Firefox o Google Chrome.';
?>
<style type="text/css">
			 body {text-align: center; background-color: #00a0f0; width: 50em; color:#000000;}
			div.forma {margin-left:4.5cm; font-weight: bold;}
			 div.logo {text-align:center; font-weight: bold;}
			 fieldset {width: 21em; background-color: #c0c0c0c0;}
</style>
<?php
} 
else {
?>
<style type="text/css">
			 body {text-align: center; background-color: #ffffff; width: 50em; color:#000000;}
			div.forma {margin-left:5.5cm; font-weight: bold;}
			 div.logo {text-align:center; font-weight: bold;}
			 fieldset {width: 21em; background-color: #c0c0c0;}
</style>
<?php } ?>
</head>
<body>
<!--[if lt IE 7]> 
<div style=' clear: both; height: 59px; padding:0 0 0 15px; position: relative;'> 
<a href="http://windows.microsoft.com/es-MX/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0012_spanish_LATAM.jpg" border="0" height="42" width="820" alt="Est&aacute; usando un version vancido de Internet Explorer, que COBRA no permite. Actualizalo ahora." />
</a>
</div> 
<![endif]-->
<h1><?php echo $msg; ?></h1>
<em>versi&oacute;n configurado para Cobranza Integral</em>
<div class="forma">
<form action="index.php" method="post" autocomplete="off">
<fieldset>
<div class="username">
<span class="formcap">Usuario:</span><input type="password" name="capt" value="" onchange="this.value=this.value.replace(/ /g, '');" /><br>
</div>
<span class="formcap">Contrase&ntilde;a:</span><input type="password" name="pwd" value=""/><br>
<!--
<span class="formcap">Extension:</span><input type="text" name="ext" value=""/><br>
-->
</div>
<input type="submit" name="go" value="Empezar" />
</fieldset>
</form>
</div>
<!--
<p><a href="http://www.whatismyip.com/">Direcci&oacute;n IP</a></p>
-->
<p>&nbsp;</p>
<a href="licencia.txt">
<cite>&#169;Gregory Miles Blumenthal Scharf 2013</cite>
</a>
</body>
</html>
<?php
mysql_close();

