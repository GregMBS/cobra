<?php
require_once 'pdoConnect.php';
$pdoc = new pdoConnect();
$pdo = $pdoc->dbConnectNobody();
$capt	 = filter_input(INPUT_GET, 'capt');
$queryl	 = "delete from userlog where gestor = :capt";
$sdl	 = $pdo->prepare($queryl);
$sdl->bindParam(':capt', $capt);
$sdl->execute();
?>
<!DOCTYPE html>
<html>
    <head>
	<title>Breaks del Hoy</title>
	<meta http-equiv="refresh" content="60"/>

	<style type="text/css">
	    body {font-family: arial, helvetica, sans-serif; font-size: 24pt; background-color: #00a0f0;}
	    table {border: 1pt solid #000000;background-color: #ffffff;border-collapse: collapse;
		   margin-left:auto;margin-right:auto;}
	    tr:hover {background-color: #ffff00;}
	    th,td {border: 1pt solid #000000;background-color: #ffffff;}
	    th,.heavy {font-weight:bold;}
	    .light {text-align:right;}
	    .rightnow {background-color:#ffff00;}
	    .late {background-color:#ffff00; font-weight:bold; text-decoration:blink;}
	    .verylate {background-color:#ff0000; font-weight:bold; text-decoration:blink;}
	</style>
    </head>
    <body>
	<button onclick="window.location = 'index.php'">LOGIN</button><br>
	<table summary="Breaks">
	    <thead>
		<tr>
		    <th>Gestor</th>
		    <th>Tipo</th>
		    <th>de</th>
		    <th>a</th>
		    <th>Minutes</th>
		</tr>
	    </thead>
	    <tbody>
		<?php
		$ot	 = '';
		$og	 = '';
		$queryp	 = "select auto,c_cvge,c_cvst,c_hrin,
time_to_sec(now())-time_to_sec(concat_ws(' ',d_fech,c_hrin)) as 'diff'
from historia 
where c_cont=0 
and d_fech=curdate() 
and c_cvst<>'login' 
and c_cvst<>'salir' 
and c_cvge=:capt 
order by c_cvge,c_cvst,c_hrin";
		$sdp	 = $pdo->prepare($queryp);
		$sdp->bindParam(':capt', $capt);
		$sdp->execute();
		$resultp = $sdp->fetchAll();
		foreach ($resultp as $answerp) {
			$AUTO		 = $answerp['auto'];
			$GESTOR		 = $answerp['c_cvge'];
			$TIPO		 = $answerp['c_cvst'];
			$TIEMPO		 = $answerp['c_hrin'];
			$DIFF		 = $answerp['diff'];
			$formatstr	 = ' class="late"';
			$NTP		 = date('H:i:s');
			$queryq		 = "select time_to_sec(min(c_hrin))-time_to_sec(:tiempo) as 'diff',
min(c_hrin) as 'minhr'
from historia 
where c_cvge=:gestor and d_fech=curdate()
and c_hrin>:tiempo;";
			$sdq		 = $pdo->prepare($queryq);
			$sdq->bindParam(':tiempo', $TIEMPO);
			$sdq->bindParam(':gestor', $GESTOR);
			$sdq->execute();
			$resultq	 = $sdq->fetchAll();
			foreach ($resultq as $answerq) {
				if (!empty($answerq['diff'])) {
					$DIFF		 = $answerq['diff'];
					$NTP		 = $answerq['minhr'];
					$formatstr	 = '';
				}
			}
			?>
			<tr<?php echo $formatstr; ?>>
			    <td><?php echo $GESTOR; ?></td>
			    <td><?php echo $TIPO; ?></td>
			    <td><?php echo $TIEMPO; ?></td>
			    <td><?php echo $NTP; ?></td>
			    <td><?php echo round($DIFF / 60); ?></td>
			</tr>
			<?php
		}
		?>
	    </tbody>
	</table>
    </body>
</html>
