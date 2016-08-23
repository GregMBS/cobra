<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pc		 = new PdoClass();
$pdo		 = $pc->dbConnectAdmin();
$capt		 = filter_input(INPUT_GET, 'capt');
$queryAct	 = "select pagos.cliente as cli, status_de_credito as sdc,
	sum(monto) as sm, sum(monto*confirmado) as smc
from pagos join resumen using (id_cuenta)
where fecha>last_day(curdate()-interval 1 month)
and status_de_credito not like '%vo'
group by cli, sdc with rollup";
$resultAct	 = $pdo->query($queryAct);
$queryActGest	 = "select gestor,cliente,
sum(monto) as sm, sum(monto*confirmado) as smc
from pagos
where fecha>last_day(curdate()-interval 1 month)
group by gestor,cliente";
$resultActGest	 = $pdo->query($queryActGest);
$queryActDet	 = "select cuenta, fecha, monto, cliente, gestor, confirmado
from pagos
where fecha>last_day(curdate()-interval 1 month)
order by cliente,gestor,fecha";
$resultActDet	 = $pdo->query($queryActDet);
$queryAnt	 = "select pagos.cliente as cli, status_de_credito as sdc,
	sum(monto) as sm, sum(monto*confirmado) as smc
from pagos join resumen using (id_cuenta)
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
and status_de_credito not like '%vo'
group by cli, sdc with rollup";
$resultAnt	 = $pdo->query($queryAnt);
$queryAntGest	 = "select gestor,cliente,
sum(monto) as sm, sum(monto*confirmado) as smc
from pagos
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
group by gestor,cliente";
$resultAntGest	 = $pdo->query($queryAntGest);
$queryAntDet	 = "select cuenta, fecha, monto, cliente, gestor, confirmado
from pagos
where fecha<=last_day(curdate()-interval 1 month)
and fecha>last_day(curdate()-interval 2 month)
order by cliente,gestor,fecha";
$resultAntDet	 = $pdo->query($queryAntDet);
require_once 'views/pagosumView.php';