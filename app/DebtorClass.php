<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use PDO;

/**
 * Description of DebtorClass
 *
 * @author gmbs
 */
class DebtorClass extends BaseClass
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
    public function highlight($stat, $visit)
    {
        $highlight = '';
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
            $highlight = " class='deudor'";
        }
        if ($stat == 'VALIDACION') {
            $highlight = " class='validacion'";
        }
        if (!empty($visit)) {
            $highlight = " class='visit'";
        }
        return $highlight;
    }


    /**
     *
     * @param string $capt
     * @return int
     */
    public function lastCall($capt)
    {
        $query = "SELECT c_cont FROM historia WHERE c_cvge = :capt
                     AND c_cont <> 0 
                     ORDER BY d_fech DESC, c_hrfi DESC LIMIT 1";
        $stu = $this->pdo->prepare($query);
        $stu->bindValue(':capt', $capt);
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
    public function getStatus($mytipo)
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
    public function getStatusVisit()
    {
        $mytipo = 'visitador';
        $result = $this->getStatus($mytipo);
        return $result;
    }

    /**
     *
     * @return string[]
     */
    public function getMotivation()
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
    public function getMotivationVisit()
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
    public function getExcuse()
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
    public function getAction()
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
    public function getActionVisit()
    {
        $query = "SELECT accion FROM acciones where visitas=1";
        $result = $this->pdo->query($query);
        $all = $result->fetchAll();
        $output = array_column($all, 0);
        return $output;
    }

    /**
     *
     * @param int $id
     * @return array
     */
    public function getBadTel($id)
    {
        $stb = $this->pdo->prepare($this->badNoQuery);
        $stb->bindValue(':id_cuenta', $id, \PDO::PARAM_INT);
        $stb->execute();
        $answerBadNo = $stb->fetch(PDO::FETCH_ASSOC);
        return $answerBadNo;
    }

    /**
     *
     * @param int $id
     * @return array
     */
    public function getHistory($id)
    {
        $query = "SELECT c_cvst,concat(d_fech,' ',c_hrin) as fecha,
                    c_cvge,c_tele,left(c_obse1,50) as short,c_obse1,
                    auto,c_cniv 
                    FROM historia 
                    WHERE c_cont=:id
                    AND c_cont > 0  
                    ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
        $sts = $this->pdo->prepare($query);
        $sts->bindValue(':id', $id, \PDO::PARAM_INT);
        $sts->execute();
        $row = $sts->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    /**
     *
     * @return array
     */
    public function getAgentList()
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
    public function getVisitorList()
    {
        $query = <<<SQL
(SELECT iniciales,completo FROM nombres 
    where completo<>'' 
and tipo IN ('visitador','admin'))
UNION
(SELECT iniciales,completo FROM users 
    where completo<>'' 
and tipo IN ('visitador','admin'))
ORDER BY iniciales
SQL;
        $result = $this->pdo->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     *
     * @return array
     */
    public function getClientList()
    {
        $clients = Client::all()->toArray();
        $names = array_column($clients, 'cliente');
        return $names;
    }

    /**
     *
     * @param string $capt
     * @return int
     */
    public function countCallsByAgent($capt)
    {
        $today = date('Y-m-d');
        /** @var Builder $query */
        $query = History::whereCCvge($capt)->whereDFech($today);
        $query = $query->where('c_cont', '<>', 0);
        $count = $query->count();
        return $count;
    }

    /**
     *
     * @param int $id
     * @return string
     */
    public function getTimeLock($id)
    {
        $tl = date('r');
        $rc = new Debtor();

        /**
         * @var Builder $query
         */
        $query = $rc->whereIdCuenta($id);
        $debtor = $query->first();
        $time = $debtor->timelock;
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
        /** @var Builder $oldUserBuilder */
        $oldUserBuilder = new OldUser();
        /** @var Builder $oldUserQuery */
        $oldUserQuery = $oldUserBuilder->where('iniciales', '=', $capt);
        $oldUser = $oldUserQuery->get();
        /** @var Builder $userBuilder */
        $userBuilder = new User();
        $user = $userBuilder->where('iniciales', '=', $capt)->get();
        $result = $oldUser->merge($user);
        return $result->first()->toArray();
    }

    /**
     *
     * @param int $id
     * @return array
     */
    public function getPromiseData($id)
    {
        /** @var Builder $history */
        $history = History::whereCCont($id);
        /** @var Model $promise */
        $promise = $history->where('n_prom', '>', 0)
            ->where('c_cvst', 'LIKE', 'PROMESA DE%')
            ->orderByDesc('d_fech')
            ->orderByDesc('c_hrin')
            ->first();
        $array = array(
            'N_PROM_OLD' => $promise->N_PROM,
            'N_PROM1_OLD' => $promise->N_PROM1,
            'N_PROM2_OLD' => $promise->N_PROM2,
            'N_PROM3_OLD' => $promise->N_PROM3,
            'N_PROM4_OLD' => $promise->N_PROM4,
            'D_PROM_OLD' => $promise->D_PROM,
            'D_PROM1_OLD' => $promise->D_PROM1,
            'D_PROM2_OLD' => $promise->D_PROM2,
            'D_PROM3_OLD' => $promise->D_PROM3,
            'D_PROM4_OLD' => $promise->D_PROM4
        );
        return $array;
    }

    /**
     *
     * @param int $id
     * @return array
     */
    public function listVisits($id)
    {
        $query = "SELECT c_cvst, concat(d_fech,' ',c_hrin) as fh,
	if(c_visit is null,c_cvge,c_visit) as gestor,
	left(c_obse1,50) as short, c_obse1, auto
	FROM historia
WHERE (historia.C_CONT=:id) AND (c_visit <> '')
ORDER BY historia.D_FECH DESC, historia.C_HRIN DESC";
        $sts = $this->pdo->prepare($query);
        $sts->bindValue(':id', $id, \PDO::PARAM_INT);
        $sts->execute();
        $row = $sts->fetchAll(\PDO::FETCH_ASSOC);
        return $row;
    }

    /**
     *
     * @param int $id
     * @return int
     */
    public function countCallsByAccount($id)
    {
        /** @var Builder $history */
        $history = History::whereCCont($id);
        $calls = $history->where('c_cont', '>', 0)
            ->count();
        return $calls;
    }

    /**
     *
     * @param int $id
     * @return int
     */
    public function countPromisesByAccount($id)
    {
        /** @var Builder $history */
        $history = History::whereCCont($id);
        $promises = $history->where('n_prom', '>', 0)
            ->count();
        return $promises;
    }

    /**
     *
     * @param int $id
     * @return int
     */
    public function countPaymentsByAccount($id)
    {
        /** @var Builder $builder */
        $builder = Payment::whereIdCuenta($id);
        $payments = $builder->count();
        return $payments;
    }

    /**
     *
     * @param int $id
     * @return string
     */
    public function getAccountNumberFromId($id = 0)
    {
        $accountNumber = '';
        if ($id > 0) {
            $rc = new Debtor();
            /** @var Builder $query */
            $query = $rc->whereIdCuenta($id);
            $debtor = $query->first();
            $accountNumber = $debtor->numero_de_cuenta;
        }
        return $accountNumber;
    }

}
