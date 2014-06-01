<?php

$con = '';
include('admin_hdr_i.php');
set_time_limit(300);
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Type: text/plain; charset=windows-1252');
header("Content-Disposition: attachment; filename='Reporte_600.txt'");
$querymain = "SELECT numero_de_cuenta,
            DATE_FORMAT(d_fech,'%m%d%Y') as 'dFech',codigo,
DATE_FORMAT(d_prom1,'%m%d%Y') as 'dProm1',n_prom1,
DATE_FORMAT(d_prom2,'%m%d%Y') as 'dProm2',n_prom2,
DATE_FORMAT(d_prom3,'%m%d%Y') as 'dProm3',n_prom3,
DATE_FORMAT(d_prom4,'%m%d%Y') as 'dProm4',n_prom4,
(d_prom1>=curdate()-interval 1 day)
+(d_prom2>=curdate()-interval 1 day)
+(d_prom3>=curdate()-interval 1 day)
+(d_prom4>=curdate()-interval 1 day)
as cProm, 
DATE_FORMAT(d_fech,'%m%d%Y') as 'dFechA',
DATE_FORMAT(d_prom1+interval 1 day,'%m%d%Y') as 'dProm1A',
DATE_FORMAT(d_prom2+interval 1 day,'%m%d%Y') as 'dProm2A',
DATE_FORMAT(d_prom3+interval 1 day,'%m%d%Y') as 'dProm3A',
DATE_FORMAT(d_prom4+interval 1 day,'%m%d%Y') as 'dProm4A',
DATE_FORMAT(curdate(),'%m%d%Y') as 'dNow'
from resumen 
join historia h1 on c_cont=id_cuenta
left join cyberact on accion=c_accion 
where d_fech>last_day(curdate() - interval 5 week)
and cliente regexp 'Credito Si' 
and c_cvst like 'PRO%DE%' and n_prom>0 
and not exists (select auto from historia h2 where h2.c_cont=id_cuenta and h2.n_prom>0 and h2.d_fech=h1.d_fech and h2.c_hrfi>h1.c_hrfi)
order by d_fech,c_hrin
;";
$result = $con->query($querymain) or die($con->error);

$k = 0;
//        $oldcta = 0;
while ($answer = $result->fetch_assoc()) {
    $j = 1;
    $k++;
    if ($answer['cProm'] > 1) {
        $cod = 'PS';
        $cn = str_pad($answer['cProm'], 3, "0", STR_PAD_LEFT);
    } else {
        $cod = 'LH';
        $cn = '001';
    }
    $fecha = array('00000000', '00000000', '00000000', '00000000');
    $fecha[0] = $answer['dFech'];
    $fecha[1] = $answer['dProm1'];
    if ($answer['dFech'] < $answer['dNow']) {
        $fecha[0] = $answer['dFechA'];
    }
    if ($answer['dProm1'] < $answer['dNow']) {
        $fecha[1] = $answer['dProm1A'];
    }
    $monto = $answer['n_prom1'];
    if (($answer['cProm'] == 1) && ($answer['n_prom2'] > 0)) {
        $fecha[0] = $answer['dProm1'];
        $fecha[1] = $answer['dProm2'];
        if ($answer['dProm1'] < $answer['dNow']) {
            $fecha[0] = $answer['dProm1A'];
        }
        if ($answer['dProm2'] < $answer['dNow']) {
            $fecha[1] = $answer['dProm2A'];
        }
        if ($answer['dProm3'] < $answer['dNow']) {
            $fecha[2] = $answer['dProm3A'];
        }
        if ($answer['dProm4'] < $answer['dNow']) {
            $fecha[3] = $answer['dProm4A'];
        }
        $monto = $answer['n_prom1'];
    }
    for ($ii = 1; $ii < 4; $ii++) {
        if ($fecha[$ii] == '00000000') {
            $fecha[$ii] = $answer['dProm' . $ii . 'A'];
        }
    }
    echo "600,2,'" . str_pad($answer['numero_de_cuenta'], 25, " ", STR_PAD_RIGHT) . "','" .
    "MUÑOZ   ','" . $cod . "','PP','" . str_pad($fecha[0], 8, "0", STR_PAD_LEFT) . "','" .
    $cn . "','" . str_pad($j, 3, "0", STR_PAD_LEFT) . "','" .
    str_pad($fecha[1], 8, "0", STR_PAD_LEFT) . "','" .
    str_pad(round($monto * 100), 15, "0", STR_PAD_LEFT) . "'\r\n";
    if ($answer['cProm'] > 1) {
//                $j++;
        for ($jj = 2; $jj <= $answer['cProm']; $jj++) {
            echo "600,2,'" . str_pad($answer['numero_de_cuenta'], 25, " ", STR_PAD_RIGHT) . "','" .
            "MUÑOZ   ','" . $cod . "','PP','" . str_pad($fecha[$jj - 1], 8, "0", STR_PAD_LEFT) . "','" .
            $cn . "','" . str_pad($jj, 3, "0", STR_PAD_LEFT) . "','" .
            str_pad($fecha[$jj], 8, "0", STR_PAD_LEFT) . "','" .
            str_pad(round($answer['n_prom' . $jj] * 100), 15, "0", STR_PAD_LEFT) . "'\r\n";
        }
    }
}

