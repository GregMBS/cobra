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
        $query = "SELECT * FROM motivadores order by motiv";
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
        $answerBadNo = $stbn->fetch(PDO::FETCH_ASSOC);
        return $answerBadNo;
    }

    /**
     *
     * @param int $id_cuenta
     * @return array
     */
    public function getHistory($id_cuenta)
    {
        $query = "SELECT c_cvst,concat(d_fech,' ',c_hrin) as fecha,
                    c_cvge,c_tele,left(c_obse1,50) as short,c_obse1,
                    auto,c_cniv 
                    FROM historia 
                    WHERE c_cont=:id_cuenta 
                    AND c_cont > 0  
                    ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
        $sts = $this->pdo->prepare($query);
        $sts->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $sts->execute();
        $row = $sts->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    /**
     *
     * @return array
     */
    public function getGestorList()
    {
        $query = <<<SQL
(SELECT iniciales FROM nombres)
        UNION
        (SELECT iniciales FROM users)
    ORDER BY iniciales
SQL;
        $result = $this->pdo->query($query);
        $all = $result->fetchAll(PDO::FETCH_NUM);
        $output = array_column($all, 0);
        return $output;
    }

    /**
     *
     * @return array
     */
    public function getVisitadorList()
    {
        $queryGestorV = <<<SQL
(SELECT iniciales,completo FROM nombres 
    where completo<>'' 
and tipo IN ('visitador','admin'))
UNION
(SELECT iniciales,completo FROM users 
    where completo<>'' 
and tipo IN ('visitador','admin'))
ORDER BY iniciales
SQL;
        $resultGestorV = $this->pdo->query($queryGestorV);
        return $resultGestorV->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @return array
     */
    public function getClientList()
    {
        $clientes = Cliente::get()->toArray();
        $names = array_column($clientes, 'cliente');
        return $names;
    }

    /**
     *
     * @param string $capt
     * @return int
     */
    public function getNumGests($capt)
    {
        $today = date('Y-m-d');
        $count = Historia::whereCCvge($capt)->whereDFech($today)->where('c_cont', '<>', 0)->count();
        return $count;
    }

    /**
     *
     * @param int $id_cuenta
     * @return string
     */
    public function getTimelock($id_cuenta)
    {
        $tl = date('r');

        /**
         * @var Resumen $query
         */
        $query = Resumen::whereIdCuenta($id_cuenta);
        $resumen = $query->first();
        $time = $resumen->timelock;
        if ($time) {
            $tl = date('r', strtotime($time));
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
        $nombre = Nombre::where('iniciales','=' , $capt)->get();
        $user = User::where('iniciales','=' , $capt)->get();
        $result = $nombre->merge($user);
        return $result->first()->toArray();
    }

    /**
     *
     * @param int $id_cuenta
     * @return array
     */
    public function getPromData($id_cuenta)
    {
       $promesa = Historia::whereCCont($id_cuenta)
            ->where('n_prom', '>', 0)
            ->where('c_cvst', 'LIKE', 'PROMESA DE%')
            ->orderByDesc('d_fech')
            ->orderByDesc('c_hrin')
            ->first();
        $array = array(
                'N_PROM_OLD' => $promesa->N_PROM,
                'N_PROM1_OLD' => $promesa->N_PROM1,
                'N_PROM2_OLD' => $promesa->N_PROM2,
                'N_PROM3_OLD' => $promesa->N_PROM3,
                'N_PROM4_OLD' => $promesa->N_PROM4,
                'D_PROM_OLD' => $promesa->D_PROM,
                'D_PROM1_OLD' => $promesa->D_PROM1,
                'D_PROM2_OLD' => $promesa->D_PROM2,
                'D_PROM3_OLD' => $promesa->D_PROM3,
                'D_PROM4_OLD' => $promesa->D_PROM4
            );
        return $array;
    }

    /**
     *
     * @param int $id_cuenta
     * @return array
     */
    public function listVisits($id_cuenta)
    {
        $query = "SELECT c_cvst, concat(d_fech,' ',c_hrin) as fh,
	if(c_visit is null,c_cvge,c_visit) as gestor,
	left(c_obse1,50) as short, c_obse1, auto
	FROM historia
WHERE (historia.C_CONT=:id_cuenta) AND (c_visit <> '')
ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
        $sts = $this->pdo->prepare($query);
        $sts->bindParam(':id_cuenta', $id_cuenta, \PDO::PARAM_INT);
        $sts->execute();
        $row = $sts->fetchAll(\PDO::FETCH_ASSOC);
        return $row;
    }

    /**
     *
     * @param int $id_cuenta
     * @return int
     */
    public function countGestiones($id_cuenta)
    {
        $gestiones = Historia::whereCCont($id_cuenta)
            ->where('c_cont', '>', 0)
            ->count();
        return $gestiones;
    }

    /**
     *
     * @param int $id_cuenta
     * @return int
     */
    public function countPromesas($id_cuenta)
    {
        $promesas = Historia::whereCCont($id_cuenta)
            ->where('n_prom', '>', 0)
            ->count();
        return $promesas;
    }

    /**
     *
     * @param int $id_cuenta
     * @return int
     */
    public function countPagos($id_cuenta)
    {
        $pagos = Pago::whereIdCuenta($id_cuenta)->count();
        return $pagos;
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
            /**
             * @var Resumen $query
             */
            $query = Resumen::whereIdCuenta($id_cuenta);
            $resumen = $query->first();
            $cuenta = $resumen->numero_de_cuenta;
        }
        return $cuenta;
    }

}
