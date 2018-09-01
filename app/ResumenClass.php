<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use PDO;

/**
 * Description of ResumenClass
 *
 * @author gmbs
 */
class ResumenClass extends BaseClass
{

    /**
     *
     * @var string
     */
    private $badNoQuery = <<<SQL
        select if(tel_1 in (select * from deadlines), 'badno','') as tel_1,
if(tel_2 in (select * from deadlines), 'badno','') as tel_2,
if(tel_3 in (select * from deadlines), 'badno','') as tel_3,
if(tel_4 in (select * from deadlines), 'badno','') as tel_4,
if(tel_1_alterno in (select * from deadlines), 'badno','') as tel_1_alterno,
if(tel_2_alterno in (select * from deadlines), 'badno','') as tel_2_alterno,
if(tel_3_alterno in (select * from deadlines), 'badno','') as tel_3_alterno,
if(tel_4_alterno in (select * from deadlines), 'badno','') as tel_4_alterno,
if(tel_1_laboral in (select * from deadlines), 'badno','') as tel_1_laboral,
if(tel_2_laboral in (select * from deadlines), 'badno','') as tel_2_laboral,
if(tel_1_verif in (select * from deadlines), 'badno','') as tel_1_verif,
if(tel_2_verif in (select * from deadlines), 'badno','') as tel_2_verif,
if(tel_3_verif in (select * from deadlines), 'badno','') as tel_3_verif,
if(tel_4_verif in (select * from deadlines), 'badno','') as tel_4_verif
FROM resumen
where id_cuenta=:id_cuenta LIMIT 1
SQL;

    /**
     *
     * @param string $stat
     * @param string $visit
     * @return string
     */
    public function highhist($stat, $visit)
    {
        $highstr = '';
        $red = array(
            'PROMESA DE PAGO TOTAL',
            'PROMESA DE PAGO PARCIAL',
            'CLIENTE NEGOCIANDO',
            'PAGO MENSUAL',
            'ADJUDICACION',
            'AUDIENCIA DE PRUEBAS',
            'DACION ENTREGADA A INFONAVIT',
            'DEMANDA ADMITIDA',
            'ELABORACION DE DEMANDA',
            'EMPLAZAMIENTO EFECTIVO',
            'FIRMO PN PARA ENTREGA',
            'INICIO DE EJECUCION',
            'PROMESA DE DACION EN PAGO',
            'PROMESA DE EVPN',
            'SENTENCIA',
            'NO OFRECER SOLUCION',
            'DACION EN PAGO',
            'FIRMO CONVENIO JUDICIAL',
            'FIRMO CONVENIO',
            'CUENTA DEMANDADA'
        );
        if (in_array($stat, $red)) {
            $highstr = " class='deudor'";
        }
        if ($stat == 'VALIDACION') {
            $highstr = " class='validacion'";
        }
        if (!empty($visit)) {
            $highstr = " class='visit'";
        }
        return $highstr;
    }


    /**
     *
     * @param string $capt
     * @return int
     */
    public function lastGestion($capt)
    {
        $queryult = "SELECT c_cont FROM historia WHERE c_cvge = :capt
                     AND c_cont <> 0 
                     ORDER BY d_fech DESC, c_hrfi DESC LIMIT 1";
        $stu = $this->pdo->prepare($queryult);
        $stu->bindParam(':capt', $capt);
        $stu->execute();
        $result = $stu->fetch(\PDO::FETCH_ASSOC);
        $find = $result['c_cont'];
        return $find;
    }

    /**
     * @param $mytipo
     * @return string[]
     * @throws \Exception
     */
    public function getDict($mytipo)
    {

        switch ($mytipo) {
            case 'callcenter':
                $query = "SELECT dictamen,v_cc,judicial "
                    . "FROM dictamenes "
                    . "where callcenter=1 "
                    . "order by dictamen";
                break;
            case 'visitador':
                $query = "SELECT dictamen,v_cc,judicial "
                    . "FROM dictamenes "
                    . "where visitas=1 "
                    . "order by dictamen";
                break;

            case 'admin':
                $query = "SELECT dictamen,v_cc,judicial "
                    . "FROM dictamenes "
                    . "order by dictamen";
                break;
            default:
                throw new \UnexpectedValueException('Tipo de usuario no es correcto.');
        }
        $result = $this->pdo->query($query);
        $all = $result->fetchAll();
        $output = array_column($all, 0);
        return $output;
    }

    /**
     * @return string[]
     * @throws \Exception
     */
    public function getDictV()
    {
        $mytipo = 'visitador';
        $result = $this->getDict($mytipo);
        return $result;
    }

    /**
     *
     * @return string[]
     */
    public function getMotiv()
    {
        $query = "SELECT motiv FROM motivadores order by motiv";
        $result = $this->pdo->query($query);
        $all = $result->fetchAll();
        $output = array_column($all, 0);
        return $output;
    }

    /**
     *
     * @return string[]
     */
    public function getMotivV()
    {
        $query = "SELECT motiv FROM motivadores where visitas = 1 order by motiv";
        $result = $this->pdo->query($query);
        $all = $result->fetchAll();
        $output = array_column($all, 0);
        return $output;
    }

    /**
     *
     * @return string[]
     */
    public function getCnp()
    {
        $query = "SELECT status FROM cnp";
        $result = $this->pdo->query($query);
        $all = $result->fetchAll();
        $output = array_column($all, 0);
        return $output;
    }

    /**
     *
     * @return string[]
     */
    public function getAccion()
    {
        $query = "SELECT accion FROM acciones where callcenter=1";
        $result = $this->pdo->query($query);
        $all = $result->fetchAll();
        $output = array_column($all, 0);
        return $output;
    }

    /**
     *
     * @return string[]
     */
    public function getAccionV()
    {
        $query = "SELECT accion FROM acciones where visitas=1";
        $result = $this->pdo->query($query);
        $all = $result->fetchAll();
        $output = array_column($all, 0);
        return $output;
    }

    /**
     *
     * @param int $id_cuenta
     * @return array
     */
    public function getBadNo($id_cuenta)
    {
        $stbn = $this->pdo->prepare($this->badNoQuery);
        $stbn->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $stbn->execute();
        $answerbadno = $stbn->fetch();
        return $answerbadno;
    }

    /**
     *
     * @param int $id_cuenta
     * @return array
     */
    public function getHistory($id_cuenta)
    {
        $querysub = "SELECT c_cvst,concat(d_fech,' ',c_hrin) as fecha,
                    c_cvge,c_tele,left(c_obse1,50) as short,c_obse1,
                    auto,c_cniv 
                    FROM historia 
                    WHERE c_cont=:id_cuenta 
                    AND c_cont > 0  
                    ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
        $sts = $this->pdo->prepare($querysub);
        $sts->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $sts->execute();
        $rowsub = $sts->fetchAll();
        return $rowsub;
    }

    /**
     *
     * @return array
     */
    public function getGestorList()
    {
        $query = "SELECT iniciales FROM nombres 
    ORDER BY usuaria";
        $result = $this->pdo->query($query);
        $all = $result->fetchAll();
        $output = array_column($all, 0);
        return $output;
    }

    /**
     *
     * @return array
     */
    public function getVisitadorList()
    {
        $queryGestorV = "SELECT usuaria,completo FROM nombres 
    where completo<>'' 
and tipo IN ('visitador','admin')";
        $resultGestorV = $this->pdo->query($queryGestorV);
        return $resultGestorV->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @return array
     */
    public function getClientList()
    {
        $query = "SELECT cliente FROM clientes;";
        $result = $this->pdo->query($query);
        $all = $result->fetchAll();
        $output = array_column($all, 0);
        return $output;
    }

    /**
     *
     * @param string $capt
     * @return int
     */
    public function getNumGests($capt)
    {
        $cng = 0;
        $query = "SELECT count(1) as cng FROM historia 
WHERE c_cvge=:capt 
AND d_fech=curdate()
AND c_cont <> 0
";
        $stn = $this->pdo->prepare($query);
        $stn->bindParam(':capt', $capt);
        $stn->execute();
        $result = $stn->fetch();
        if ($result['cng'] > 0) {
            $cng = $result['cng'];
        }
        return $cng;
    }

    /**
     *
     * @param int $id_cuenta
     * @return string
     */
    public function getTimelock($id_cuenta)
    {
        $tl = date('r');
        $querytlock = "SELECT date_format(timelock,'%a, %d %b %Y %T') as tl
            FROM resumen 
            WHERE id_cuenta = :id_cuenta";
        $sts = $this->pdo->prepare($querytlock);
        $sts->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $sts->execute();
        $result = $sts->fetch(\PDO::FETCH_ASSOC);
        if ($result['tl']) {
            $tl = $result['tl'];
        }
        return $tl;
    }

    /**
     *
     * @param string $capt
     * @return array
     */
    public function getUserData($capt)
    {
        $queryg = "SELECT usuaria,tipo,camp FROM nombres WHERE iniciales = :capt LIMIT 1";
        $stg = $this->pdo->prepare($queryg);
        $stg->bindParam(':capt', $capt);
        $stg->execute();
        $result = $stg->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param int $id_cuenta
     * @return array
     */
    public function getPromData($id_cuenta)
    {
        $queryprom = <<<SQL
select N_PROM as N_PROM_OLD, D_PROM as D_PROM_OLD,
    N_PROM1 as N_PROM1_OLD, D_PROM1 as D_PROM1_OLD,
    N_PROM2 as N_PROM2_OLD, D_PROM2 as D_PROM2_OLD,
    N_PROM3 as N_PROM3_OLD, D_PROM3 as D_PROM3_OLD,
    n_prom4 as N_PROM4_OLD, d_prom4 as D_PROM4_OLD
from historia 
where c_cont = :id_cuenta 
and n_prom>0 
and c_cvst like 'PROMESA DE%'
order by d_fech desc, c_hrin desc limit 1
SQL;
        $stp = $this->pdo->prepare($queryprom);
        $stp->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $stp->execute();
        $result = $stp->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @param int $ID_CUENTA
     * @return array
     */
    public function listVisits($ID_CUENTA)
    {
        $querysub = "SELECT c_cvst, concat(d_fech,' ',c_hrin) as fh,
	if(c_visit is null,c_cvge,c_visit) as gestor,
	left(c_obse1,50) as short, c_obse1, auto
	FROM historia
WHERE (historia.C_CONT=:id_cuenta) AND (c_visit <> '')
ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
        $sts = $this->pdo->prepare($querysub);
        $sts->bindParam(':id_cuenta', $ID_CUENTA, \PDO::PARAM_INT);
        $sts->execute();
        $rowsub = $sts->fetchAll(\PDO::FETCH_ASSOC);
        return $rowsub;
    }

    /**
     *
     * @param int $id_cuenta
     * @return int
     */
    public function countGestiones($id_cuenta)
    {
        $query = "SELECT COUNT(1) as gest FROM historia 
                WHERE c_cont = :id_cuenta
                AND c_cont > 0";
        $stg = $this->pdo->prepare($query);
        $stg->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stg->execute();
        $result = $stg->fetch(PDO::FETCH_ASSOC);
        $count = $result['gest'];
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }

    /**
     *
     * @param int $id_cuenta
     * @return int
     */
    public function countPromesas($id_cuenta)
    {
        $query = "SELECT COUNT(1) as prom FROM historia 
                WHERE c_cont = :id_cuenta 
                AND n_prom > 0";
        $stg = $this->pdo->prepare($query);
        $stg->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stg->execute();
        $result = $stg->fetch(PDO::FETCH_ASSOC);
        $count = $result['prom'];
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }

    /**
     *
     * @param int $id_cuenta
     * @return int
     */
    public function countPagos($id_cuenta)
    {
        $query = "SELECT COUNT(1) as pag FROM pagos 
                WHERE id_cuenta = :id_cuenta";
        $stg = $this->pdo->prepare($query);
        $stg->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
        $stg->execute();
        $result = $stg->fetch(PDO::FETCH_ASSOC);
        $count = $result['pag'];
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }

    /**
     *
     * @param int $id_cuenta
     * @return string
     */
    public function getCuentaFromId($id_cuenta = 0)
    {
        $cuenta = '';
        if ($id_cuenta > 0) {
            $query = "SELECT numero_de_cuenta FROM resumen 
                    WHERE id_cuenta = :id_cuenta";
            $stq = $this->pdo->prepare($query);
            $stq->bindParam(':id_cuenta', $id_cuenta);
            $stq->execute();
            $result = $stq->fetch(\PDO::FETCH_ASSOC);
            $cuenta = $result['numero_de_cuenta'];
        }
        return $cuenta;
    }

}
