<?php
date_default_timezone_set('America/Monterrey');
include('usuario_hdr_i.php');
$query = "truncate cobra4.deadlines;
insert into cobra4.deadlines select distinct right(c_tele,8) as c_tele
from cobra4.historia 
where c_cvst in ('TERCERO NO CONOCE DEUDOR','TEL NO EXISTE O SUSPENDIDO','TEL NO EXISTE') and c_tele>0
and c_msge is null;
insert into cobra4.deadlines select distinct right(c_tele,8) as c_tele
from cobra4.historia 
where c_cvst in ('TEL SUSPENDIDO') and c_tele>0
and c_msge is null;
update robot.calllist,cobra4.resumen
set turno=1000
where status_aarsa = 'PAGANDO CONVENIO' 
 and id=id_cuenta;
update robot.calllist,cobra4.resumen
set turno=1000
where status_aarsa  like 'PAGO TOTA%'
 and id=id_cuenta;
update robot.calllist,cobra4.resumen
set turno=1000
where status_aarsa = 'CONFIRMA PROMESA'
 and id=id_cuenta;
update robot.calllist,cobra4.resumen
set turno=1000
where status_aarsa like 'PRO%DE%'
 and id=id_cuenta;
update robot.calllist,cobra4.resumen
set turno=1000
where status_aarsa ='ENTREGA DE MERCANCIA'
 and id=numero_de_cuenta;
update robot.calllist,cobra4.deadlines
set turno=1000
where right(tel,8) = c_tele;
update robot.calllist,cobra4.resumen
set turno=1000
where status_de_credito like '%o' and id=id_cuenta
and turno<1000;
delete from robot.calllist where turno>=1000;
delete from robot.calllist where tel like '04%';
";
$result = mysqli_multi_query($con,$query);
mysqli_close($con);
header('Location: robocon.php?capt='.$capt);
?>
